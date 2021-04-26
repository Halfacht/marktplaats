<?php

namespace Database\Seeders;

use App\Models\Postcode;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Alwin',
            'email' => 'alwin@mail.com',
            'password' => Hash::make('testtest'),
			'postcode_id' => Postcode::where('postcode', '9721')->first()->id,
        ]);

        User::factory()->count(10)->create();
    }
}
