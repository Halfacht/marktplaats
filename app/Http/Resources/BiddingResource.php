<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BiddingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
			'name' => $this->user->name,
			'amount' => $this->amount,
			'date' => $this->created_at->format('j M \'y'),
			'created_at' => $this->created_at,
		];
    }
}
