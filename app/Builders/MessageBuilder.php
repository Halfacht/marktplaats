<?php

namespace App\Builders;

use App\Models\Message;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MessageBuilder extends Builder
{
	public function concerningUser($user_id) {
		return $this->where(function ($query) use ($user_id) {
			$query->where('receiver_id', '=', $user_id)
				->orWhere('sender_id', '=', $user_id);
		});
	}

	public function conversations() {
		$id = Auth::user()->id;

		return $this->selectRaw("CASE receiver_id WHEN '${id}' THEN sender_id ELSE receiver_id END AS user_id")
			->concerningUser($id)
			->groupBy('user_id')
			->having('user_id', '!=', $id)
			->with('user:id,name')
			->orderByRaw('MAX(id) DESC');
	}

	public function betweenAuthUserandUser($user_id) {
		$auth_id = Auth::user()->id;

		return $this->where(function ($query) use ($auth_id, $user_id) {
			$query->where('receiver_id', '=', $auth_id)
				->where('sender_id', '=', $user_id);
		})
			->orWhere(function ($query) use ($auth_id, $user_id) {
				$query->where('sender_id', '=', $auth_id)
					->where('receiver_id', '=', $user_id);
			});
	}
}
