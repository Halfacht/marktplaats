<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\Bidding;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::inRandomOrder()->get();

        foreach ($users as $user) {
            Advertisement::factory()
                ->count(10)
                ->has(Bidding::factory()->count(3))
                ->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
