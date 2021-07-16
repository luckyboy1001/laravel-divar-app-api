<?php

namespace Database\Seeders;

use App\Models\Advertise;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = User::factory()
            ->count(3)
            ->create(['is_admin' => true]);


        $categories = Category::factory()->count(20)->create();

        $users = User::factory()
            ->has(
                Advertise::factory()->count(3)
                    ->state(function (array $attribute, User $user) use ($categories) {
                        return ['category_id' => $categories[random_int(1, count($categories) -1)]->id];
                    })
                , 'advertises'
            )
            ->count(50)
            ->create();
    }
}
