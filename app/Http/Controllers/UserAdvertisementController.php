<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdvertisementResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAdvertisementController extends Controller
{
    public function index() {
		$advertisements = Auth::user()->advertisements()->orderByDesc('created_at')->get();

		return AdvertisementResource::collection($advertisements);
	}
}
