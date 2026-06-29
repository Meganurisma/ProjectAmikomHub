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
        $partners = [
            [
                'name' => 'Google Indonesia',
                'logo_url' => 'https://placehold.co/200x200?text=Google',
            ],
            [
                'name' => 'Microsoft Azure',
                'logo_url' => 'https://placehold.co/200x200?text=Microsoft',
            ],
            [
                'name' => 'Amazon Web Services',
                'logo_url' => 'https://placehold.co/200x200?text=AWS',
            ],
            [
                'name' => 'GitHub',
                'logo_url' => 'https://placehold.co/200x200?text=GitHub',
            ],
            [
                'name' => 'Laravel Indonesia',
                'logo_url' => 'https://placehold.co/200x200?text=Laravel',
            ],
            [
                'name' => 'TechCorp Indonesia',
                'logo_url' => 'https://placehold.co/200x200?text=TechCorp',
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
