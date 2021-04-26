<?php


namespace App\Helpers;


class DistanceHelper
{
	public static function betweenPostcodes($postcode1, $postcode2) {
		return self::between($postcode1->latitude, $postcode1->longitude, $postcode2->latitude, $postcode2->longitude);
	}

    public static function between($lat1, $lon1, $lat2, $lon2) {
        $p = 0.017453292519943295;    // Math.PI / 180
        $a = 0.5 - cos(($lat2 - $lat1) * $p) /2 +
            cos($lat1 * $p) * cos($lat2 * $p) *
            (1 - cos(($lon2 - $lon1) * $p)) /2;

        return round(12742 * asin(sqrt($a))); // 2 * R; R = 6371 km
    }
}
