<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostcodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		if(DB::table('postcodes')->count() == 0) {
			$file = file(storage_path('app/postcodes.csv'));
			$csv = array_map('str_getcsv', $file);

			array_walk($csv, function(&$a) use ($csv) {
				$a = array_combine($csv[0], $a);
				$a = [
					'postcode' => $a['postcode'],
					'town' => $a['woonplaats'],
					'latitude' => $a['latitude'],
					'longitude' => $a['longitude'],
				];
			});

			array_shift($csv); // remove column header

			DB::table('postcodes')->insert($csv);
		}
    }
}
