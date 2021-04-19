<?php


namespace Helpers;


class DistanceHelper
{
    public static function between($lat1, $lon1, $lat2, $lon2) {
        $earthRadiusKm = 6371;

        $dLat = self::degreesToRadians($lat2-$lat1);
        $dLon = self::degreesToRadians($lon2-$lon1);

        $lat1 = self::degreesToRadians($lat1);
        $lat2 = self::degreesToRadians($lat2);

        $a = sin($dLat/2) * sin($dLat/2) +
            sin($dLon/2) * sin($dLon/2) * cos($lat1) * cos($lat2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return $earthRadiusKm * $c;
    }

    public static function degreesToRadians($degrees) {
        return $degrees * 0.0174532925199433;
    }
}
