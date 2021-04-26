<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{

    /**
     * Handle an incoming authentication request.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->json([
            'message' => 'login successful',
            'user' => auth()->user(),
			'token' => $request->session()->get('_token'),
        ]);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

       return response()->json([
           'message' => 'logout successful'
       ]);
    }

	/**
	 * Checks if the user has an authenticated session
	 * 
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function checkAuth(Request $request) {
		return response()->json([
			'sessionHasToken' => $request->session()->has('_token'),
			'auth' => Auth::check(),
			'user' => Auth::user(),
		]);
	}
}
