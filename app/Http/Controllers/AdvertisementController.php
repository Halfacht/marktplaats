<?php

namespace App\Http\Controllers;

use App\Http\Requests\Advertisements\GetAdvertisementsRequest;
use App\Http\Requests\Advertisements\StoreAdvertisementRequest;
use App\Http\Requests\Advertisements\UpdateAdvertisementRequest;
use App\Http\Resources\AdvertisementCollectionResource;
use App\Http\Resources\AdvertisementResource;
use App\Models\Advertisement;
use App\Models\Postcode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertisementController extends Controller
{
public function __construct()
{
	$this->middleware('auth')->except('index', 'show');
}

    /**
     * Return a listing of the resource.
     *
	 * @param GetAdvertisementsRequest $request
     * @return JSONResponse
     */
    public function index(GetAdvertisementsRequest $request)
    {
		$categoryString = $request->query('categories');
		$postcodeDigits = $request->query('fromPostcode');
		$maxDistance = $request->query('maxDistance');

		$users_within_range = null;

		if ($postcodeDigits && $maxDistance) {
			$postcode = Postcode::where('postcode', $postcodeDigits)->first();
		
			$users_within_range = User::withDistanceFromPostcode($maxDistance, $postcode)
				->has('advertisements')
				->get();
		}

        $advertisements = Advertisement::orderByDesc('sort_date')
			->when($categoryString, function ($query, $categoryString) {
				return $query->whereIn('category_id', explode(',', $categoryString));
			})
			->when($users_within_range, function ($query) use ($users_within_range) {
				return $query->whereIn('user_id', $users_within_range->pluck('id'));
			})
			->paginate($request->query('per_page'));
		
		// Merge distance into advertisements
		if ($users_within_range) {
			$advertisements->each(function ($advertiement) use ($users_within_range) {
				$advertiement->distance = round($users_within_range->firstWhere('id', $advertiement->user_id)->distance);
			});
		}

		return new AdvertisementCollectionResource($advertisements);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreAdvertisementRequest  $request
     * @return JSONResponse
     */
    public function store(StoreAdvertisementRequest $request)
    {
        $validatedData = $request->validated();
		$validatedData['sort_date'] = Carbon::now();
		$validatedData['user_id'] = Auth::user()->id;

		$advertiement = Advertisement::create($validatedData);

		return response()->json([
			'message' => 'advertisement created succesfully',
			'advertisement' => new AdvertisementResource($advertiement),
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Advertisement  $advertisement
     * @return JSONResponse
     */
    public function show(Advertisement $advertisement)
    {
		$advertisement->load('biddings');

        return new AdvertisementResource($advertisement);
    }

	public function update(UpdateAdvertisementRequest $request, Advertisement $advertisement) {
		$advertisement->update($request->validated());

		$advertisement->refresh();

		return response()->json([
			'message' => 'advertisement updated succesfully',
			'advertisement' => new AdvertisementResource($advertisement),
		]);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  Advertisement  $advertisement
     * @return JSONResponse
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();

		return response()->json([
			'message' => 'deleting was successful'
		]);
    }
}
