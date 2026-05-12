<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake();

        for ($i = 0; $i < 5; $i++) {
            Partner::create([
                'name' => $faker->company,
                'logo_url' => 'https://placehold.co/200x200?text=' . urlencode($faker->company),
            ]);
        }
    }
}
