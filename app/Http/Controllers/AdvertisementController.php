<?php

namespace App\Http\Controllers;

use App\Http\Requests\Advertisements\GetAdvertisementsRequest;
use App\Http\Requests\Advertisements\StoreAdvertisementRequest;
use App\Http\Requests\Advertisements\UpdateAdvertisementRequest;
use App\Http\Resources\AdvertisementResource;
use App\Models\Advertisement;
use App\Models\Postcode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
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
		$search = $request->query('search');
		$category_ids = $request->query('categories');
		$postcodeDigits = $request->query('fromPostcode');
		$maxDistance = $request->query('maxDistance');

		$users_within_range = null;

		
		if ($postcodeDigits && $maxDistance) {
			$postcode = Postcode::where('postcode', $postcodeDigits)->first();
		
			$users_within_range = User::withDistanceFromPostcode($maxDistance, $postcode)
				->has('advertisements')
				->get();
		}

        $paginator = Advertisement::orderByDesc('sort_date')
			->when($search, function($query, $search) {
				$query->where(function ($query) use ($search) {
					$query->where('title', 'like', "%${search}%")
						->orWhere('content', 'like', "${search}%");
				});
			})
			->when($category_ids, function ($query, $category_ids) {
				return $query->whereIn('category_id', $category_ids);
			})
			->when($users_within_range, function ($query, $users_within_range) {
				$query->whereIn('user_id', $users_within_range->pluck('id'));
				// For some reason this didn't work when I used a return statement, while the return statement works for category filter
			})
			->paginate($request->query('per_page'));
			
		// Merge distance into advertisements
		if ($users_within_range) {
			$paginator->getCollection()->transform(function ($advertisement) use ($users_within_range) {
				$advertisement->distance = round($users_within_range->firstWhere('id', $advertisement->user_id)->distance);
				return $advertisement;
			});
		}

		return AdvertisementResource::collection($paginator);
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
		$this->authorize('update', $advertisement);
		
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

	public function top(Advertisement $advertisement) {
		$this->authorize('top', $advertisement);

		$advertisement->update([
			'sort_date' => Carbon::now(),
		]);

		return response()->json(Response::HTTP_OK);
	}
}
