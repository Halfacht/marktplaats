<?php

namespace App\Http\Resources;

use App\Helpers\DistanceHelper;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OwnerResource;
use App\Http\Resources\BiddingResource;
use Illuminate\Support\Facades\Auth;

class AdvertisementResource extends JsonResource
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
			'id' => $this->id,
			'title' => $this->title,
			'content' => $this->content,
			'price' => $this->price,
			'sort_date' => $this->sort_date,
			'category' => $this->category->name,
			'category_id' => $this->category_id,
			'owner' => new OwnerResource($this->owner),
			'biddings' => BiddingResource::collection($this->whenLoaded('biddings')),
			'created_at' => $this->created_at,
			'distance' => $this->distance ?? (Auth::check() ? DistanceHelper::betweenPostcodes(Auth::user()->postcode, $this->owner->postcode) : null),
		];
    }
}
