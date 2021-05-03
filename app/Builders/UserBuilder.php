<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
	public function withDistanceFromPostcode($maxDistance, $postcode) {
		return $this->join('postcodes', 'users.postcode_id', '=', 'postcodes.id')
			->selectRaw('users.id, 
				( 3959 * acos( cos( radians("' . $postcode->latitude . '") ) 
				* cos( radians( `latitude` ) ) 
				* cos( radians( `longitude` ) 
				- radians("' . $postcode->longitude . '") ) 
				+ sin( radians("' . $postcode->latitude . '") ) 
				* sin( radians( `latitude` ) ) ) ) 
				AS distance'
			)
			->havingRaw("distance < $maxDistance");
	}
}
