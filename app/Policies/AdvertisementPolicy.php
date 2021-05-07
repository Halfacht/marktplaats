<?php

namespace App\Policies;

use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertisementPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

	public function update(User $user, Advertisement $advertisement)
	{
		return $user->id === $advertisement->user_id;
	}

	public function top(User $user, Advertisement $advertisement) 
	{
		return $user->id === $advertisement->user_id;
	}
}
