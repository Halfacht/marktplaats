<?php

namespace App\Http\Controllers;

use App\Http\Requests\Advertisements\StoreAdvertisementRequest;
use App\Http\Requests\Advertisements\UpdateAdvertisementRequest;
use App\Http\Resources\AdvertisementCollectionResource;
use App\Http\Resources\AdvertisementResource;
use App\Models\Advertisement;
use App\Models\Postcode;
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
	 * @param Request $request
     * @return JSONResponse
     */
    public function index(Request $request)
    {
		$categoryString = $request->query('categories');
		$postcodeDigits = $request->query('postcode');
		$maxDistance = $request->query('distance');

        $advertisements = Advertisement::orderByDesc('sort_date')
			->when($categoryString, function ($query, $categoryString) {
				return $query->whereIn('category_id', explode(',', $categoryString));
			})
			->when($postcodeDigits && $maxDistance, function ($query) use ($postcodeDigits, $maxDistance) {
				$postcode = Postcode::where('postcode', 9721);
				return $query->selectRaw(
					'( 6371 * acos( cos( radians(?) ) * cos( radians( 
						(SELECT @latitude := FROM postcodes WHERE postcode = ?) 
					) ) 
					* cos( radians( 
						(SELECT longitude FROM postcodes WHERE postcode = ?)
					 ) - radians(?) ) 
					+ sin( radians(?) ) * sin( radians(  @latitude  ) ) ) ) AS distance',
					[$postcode->latitude, $postcodeDigits, $postcodeDigits, $postcode->longitude, $postcode->latitude]
				);
			})
			->paginate($request->query('per_page'));

			// $sql = "SELECT *, ( 3959 * acos( cos( radians(" . $lat . ") ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(" . $lng . ") ) + sin( radians(" . $lat . ") ) * sin( radians( lat ) ) ) ) AS distance FROM your_table HAVING distance < 5";

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
