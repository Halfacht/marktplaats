<?php

namespace App\Http\Controllers;

use App\Http\Requests\Advertisements\StoreBiddingRequest;
use App\Http\Resources\AdvertisementResource;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiddingController extends Controller
{
    public function store(StoreBiddingRequest $request, Advertisement $advertisement) 
	{
		$advertisement->biddings()->create([
			'amount' => $request->amount,
			'user_id' => Auth::user()->id,
		]);

		$advertisement->load('biddings');

		return response()->json([
			'message' => 'Placing bid was successful',
			'data' => [
				'advertisement' => new AdvertisementResource($advertisement),
			],
		]);
	}
}
