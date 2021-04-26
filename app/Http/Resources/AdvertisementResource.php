<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OwnerResource;

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
			'owner' => new OwnerResource($this->owner),
			'category' => $this->category->name,
			'created_at' => $this->created_at,
		];
    }
}
