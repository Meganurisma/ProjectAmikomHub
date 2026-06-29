<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Kategori Baru
        $category1 = \App\Models\Category::create([
            'name' => 'Teknologi',
            'slug' => 'teknologi',
        ]);

        $category2 = \App\Models\Category::create([
            'name' => 'Seni & Kreatif',
            'slug' => 'seni-kreatif',
        ]);

        $category3 = \App\Models\Category::create([
            'name' => 'Bisnis & Karir',
            'slug' => 'bisnis-karir',
        ]);

        // Event Baru
        \App\Models\Event::create([
            'category_id' => $category1->id,
            'title' => 'Cyber Security Talk',
            'description' => 'Belajar dasar keamanan siber dan cara melindungi data pribadi.',
            'date' => '2026-05-05 10:00:00',
            'location' => 'Ruang Seminar B',
            'price' => 40000,
            'stock' => 120,
            'poster_path' => 'posters/event-1.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category2->id,
            'title' => 'Photography Street Workshop',
            'description' => 'Workshop fotografi jalanan bersama fotografer profesional.',
            'date' => '2026-05-08 15:00:00',
            'location' => 'Area Kampus & Sekitar',
            'price' => 75000,
            'stock' => 60,
            'poster_path' => 'posters/event-2.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category3->id,
            'title' => 'Startup Pitching Day',
            'description' => 'Ajang presentasi ide bisnis di depan investor dan mentor.',
            'date' => '2026-05-12 13:00:00',
            'location' => 'Hall Utama',
            'price' => 100000,
            'stock' => 80,
            'poster_path' => 'posters/event-3.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category1->id,
            'title' => 'Mobile App Development Class',
            'description' => 'Pelatihan membuat aplikasi Android dari dasar hingga publish.',
            'date' => '2026-05-18 09:00:00',
            'location' => 'Lab Komputer 2',
            'price' => 90000,
            'stock' => 70,
            'poster_path' => 'posters/event-4.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category2->id,
            'title' => 'Music Festival Campus Vibes',
            'description' => 'Festival musik kampus dengan berbagai penampilan band lokal.',
            'date' => '2026-05-25 18:30:00',
            'location' => 'Lapangan Utama',
            'price' => 50000,
            'stock' => 200,
            'poster_path' => 'posters/event-5.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category3->id,
            'title' => 'Personal Branding Seminar',
            'description' => 'Pelajari cara membangun citra diri untuk dunia profesional.',
            'date' => '2026-06-03 11:00:00',
            'location' => 'Ruang Auditorium',
            'price' => 60000,
            'stock' => 100,
            'poster_path' => 'posters/event-6.png',
        ]);

        // Jalankan PartnerSeeder
        $this->call(PartnerSeeder::class);
    }
}