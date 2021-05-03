<?php

namespace App\Http\Resources;

use App\Helpers\DistanceHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class OwnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
			'name' => $this->name,
			'postcode' => $this->postcode->postcode,
			'town' => $this->postcode->town,
		];
    }
}
