<?php

namespace App\Http\Controllers;

use App\Http\Requests\Advertisements\StoreAdvertisementRequest;
use App\Http\Requests\Advertisements\UpdateAdvertisementRequest;
use App\Http\Resources\AdvertisementResource;
use App\Models\Advertisement;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisements = Advertisement::inRandomOrder()->limit(10)->get();

		return AdvertisementResource::collection($advertisements);
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
