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

        $skills = [
            'Cs',
            'Cpp',
            'Javascript',
            'HTML',
            'Python',
            'Réseau',
            'Système',
            'PHP',
            'mySQL',
            'Base de données',
            'Git',
            'Linux',
            'React.js',
            'jQuery',
            'Test unitaire',
            'SEO',
            'Angular',
        ];

        $companies = [
            [
                'name' => 'Winformatic',
                'email' => 'winformatic@gmail.france',
                'line' => 'Développement',
                'trainee' => 3,
                'confidence' => 8,
            ],
            [
                'name' => 'IPVCOM',
                'email' => 'ipvcom@gmail.france',
                'line' => 'Réseau',
                'trainee' => 6,
                'confidence' => 7,
            ],
            [
                'name' => 'Phone&co',
                'email' => 'phone@gmail.france',
                'line' => 'Téléphonie',
                'trainee' => 4,
                'confidence' => 6,
            ],
            [
                'name' => 'Info com',
                'email' => 'infocom@gmail.france',
                'line' => 'Sécurité',
                'trainee' => 3,
                'confidence' => 10,
            ],
            [
                'name' => 'IAnd you',
                'email' => 'iandyou@gmail.france',
                'line' => 'Intelligence artificielle',
                'trainee' => 2,
                'confidence' => 6,
            ],
            [
                'name' => 'Apixit',
                'email' => 'apixit@gmail.france',
                'line' => 'Cyber-sécurité',
                'trainee' => 4,
                'confidence' => 5,
            ],
            [
                'name' => 'Accor',
                'email' => 'accor@gmail.france',
                'line' => 'Big data',
                'trainee' => 4,
                'confidence' => 7,
            ],
            [
                'name' => 'Calimaps',
                'email' => 'calimaps@gmail.france',
                'line' => 'Santé',
                'trainee' => 2,
                'confidence' => 4,
            ],
            [
                'name' => 'Arduino compagnie',
                'email' => 'arduino@gmail.france',
                'line' => 'Systèmes embarqués',
                'trainee' => 4,
                'confidence' => 10,
            ],
            [
                'name' => 'SNCF',
                'email' => 'sncf@gmail.france',
                'line' => 'Transport',
                'trainee' => 10,
                'confidence' => 9,
            ],
            [
                'name' => 'Banque postale',
                'email' => 'banquepostale@gmail.france',
                'line' => 'Finance',
                'trainee' => 5,
                'confidence' => 6,
            ],
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

        DB::table('rights')->insert([
            'SFx1' => 1,
            'SFx2' => 1,
            'SFx3' => 1,
            'SFx4' => 1,
            'SFx5' => 1,
            'SFx6' => 1,
            'SFx7' => 1,
            'SFx8' => 1,
            'SFx9' => 0,
            'SFx10' => 0,
            'SFx11' => 0,
            'SFx12' => 1,
            'SFx13' => 0,
            'SFx14' => 0,
            'SFx15' => 0,
            'SFx16' => 0,
            'SFx17' => 0,
            'SFx18' => 0,
            'SFx19' => 0,
            'SFx20' => 0,
            'SFx21' => 0,
            'SFx22' => 0,
            'SFx23' => 0,
            'SFx24' => 0,
            'SFx25' => 0,
            'SFx26' => 0,
            'SFx27' => 1,
            'SFx28' => 1,
            'SFx29' => 1,
            'SFx30' => 1,
            'SFx31' => 1,
            'SFx32' => 0,
            'SFx33' => 0,
            'SFx34' => 1,
            'SFx35' => 0,
        ]);

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
            'SFx13' => 0,
            'SFx14' => 0,
            'SFx15' => 0,
            'SFx16' => 0,
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
            'SFx27' => 0,
            'SFx28' => 0,
            'SFx29' => 0,
            'SFx30' => 0,
            'SFx31' => 0,
            'SFx32' => 1,
            'SFx33' => 1,
            'SFx34' => 0,
            'SFx35' => 0,
        ]);

        DB::table('users')->insert([
            'name' => 'TEST',
            'firstName' => 'test',
            'email' => 't@g.c',
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

        foreach($skills as $skill) {
            Skill::create(['name' => $skill, 'slug' => Str::slug($skill)]);
        }

        foreach($companies as $company) {
            Company::create(['name' => $company['name'], 'slug' => Str::slug($company['name']), 'email' => $company['email'], 'line' => $company['line'], 'trainee' => $company['trainee'], 'confidence' => $company['confidence']]);
        }

        Right::factory(20)->create();

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
