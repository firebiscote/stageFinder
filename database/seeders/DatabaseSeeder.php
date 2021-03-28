<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Locality,
    Offer,
    Promotion,
    Center,
    User,
    Company,
    Rating,
    Right,
    Skill
};
use Illuminate\Support\Facades\{
    DB,
    Hash,
};
use Database\Factories\StudentFactory;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $localities = [
            'Bordeaux',
            'Paris',
            'Marseille',
            'Arbanats',
            'Tour',
            'Lille',
            'Lyon',
            'Begle',
            'Merignac',
        ];

        $promotions = [
            'A1',
            'A2',
            'A3',
            'A4',
            'A5',
        ];

        $centers = [
            'Bordeaux',
            'Tour',
            'Lille',
            'Nice',
            'Toulouse',
        ];

        DB::table('rights')->insert([
            'SFx1' => 1,
            'SFx2' => 1,
            'SFx3' => 1,
            'SFx4' => 1,
            'SFx5' => 1,
            'SFx6' => 1,
            'SFx7' => 1,
            'SFx8' => 1,
            'SFx9' => 1,
            'SFx10' => 1,
            'SFx11' => 1,
            'SFx12' => 1,
            'SFx13' => 1,
            'SFx14' => 1,
            'SFx15' => 1,
            'SFx16' => 1,
            'SFx17' => 1,
            'SFx18' => 1,
            'SFx19' => 1,
            'SFx20' => 1,
            'SFx21' => 1,
            'SFx22' => 1,
            'SFx23' => 1,
            'SFx24' => 1,
            'SFx25' => 1,
            'SFx26' => 1,
            'SFx27' => 1,
            'SFx28' => 1,
            'SFx29' => 1,
            'SFx30' => 1,
            'SFx31' => 1,
            'SFx32' => 1,
            'SFx33' => 1,
            'SFx34' => 1,
            'SFx35' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'Cavarroc',
            'firstName' => 'Maxime',
            'email' => 'm@g.c',
            'email_verified_at' => now(),
            'password' => Hash::make('p'),
            'role' => 'A',
            'remember_token' => Str::random(10),
            'center_id' => 1,
            'right_id' => 1,
        ]);

        $ids = range(1, 5);
        
        foreach($promotions as $promotion) {
            Promotion::create(['name' => $promotion, 'slug' => Str::slug($promotion)]);
        }

        foreach($localities as $locality) {
            Locality::create(['name' => $locality, 'slug' => Str::slug($locality)]);
        }

        foreach($centers as $center) {
            Center::create(['name' => $center, 'slug' => Str::slug($center)]);
        }

        Skill::factory(30)->create();

        Right::factory(20)->create();

        Company::factory(30)->create();

        User::factory()->count(50)->create()->each(function ($user) use ($ids) {
            shuffle($ids);
            $user->promotions()->attach(array_slice($ids, 0, 1));
        });

        Offer::factory()->count(40)->create()->each(function ($offer) use ($ids) {
            shuffle($ids);
            $offer->promotions()->attach(array_slice($ids, 0, rand(1,4)));
            shuffle($ids);
            $offer->skills()->attach(array_slice($ids, 0, rand(1,4)));
            shuffle($ids);
            $offer->users()->attach(array_slice($ids, 0, rand(1,4)));
        });

        Rating::factory(20)->create();
    }
}
