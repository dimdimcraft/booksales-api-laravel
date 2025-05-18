<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create(
            [
                'name' => 'Action',
                'description' => 'Genre Acrion adalah genre yang berisi cerita yang penuh dengan aksi dan petualangan. Cerita dalam genre ini biasanya melibatkan karakter yang berjuang untuk mencapai tujuan tertentu.'
            ]);
        Genre::create(  
            [
                'name' => 'Romance',
                'description' => 'Genre Romance adalah genre yang berisi cerita yang berfokus pada hubungan romantis antara karakter-karakter dalam cerita. Cerita dalam genre ini biasanya melibatkan konflik emosional dan hubungan yang rumit.'
            ]);
        Genre::Create(  
            [
                'name' => 'Fantasy',
                'description' => 'Genre Fantasy adalah genre yang berisi cerita yang melibatkan elemen-elemen fantastis, seperti sihir, makhluk mitos, dan dunia yang tidak nyata. Cerita dalam genre ini biasanya melibatkan petualangan di dunia yang berbeda dari dunia nyata.'
            ]);
        }
}
