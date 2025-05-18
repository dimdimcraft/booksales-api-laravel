<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create(
            [
                'title' => 'pulang',
                'description' => 'A novel written by American author F. Scott Fitzgerald.',
                'price' => 40000,
                'stok' => 15,
                'cover_photo' => 'pulang.jpg',
                'genres_id' => 1,
                'authors_id' => 1,
            ],
        );
        Book::create(
            [
               'title' => 'senja',
                'description' => 'An epic tale of adventure and self discovery.',
                'price' => 35000,
                'stok' => 10,
                'cover_photo' => 'senja.jpg',
                'genres_id' => 2,
                'authors_id' => 2,
            ],
        );

        Book::create(
            [
                'title' => 'hujan',
                'description' => 'A gripping thriller that keeps you on the edge of your seat.',
                'price' => 50000,
                'stok' => 20,
                'cover_photo' => 'hujan.jpg',
                'genres_id' => 3,
                'authors_id' => 3,
            ],
        );

        Book::create(
            [
                'title' => 'pagi',
                'description' => 'A heartwarming story of love and friendship.',
                'price' => 60000,
                'stok' => 25,
                'cover_photo' => 'pagi.jpg',
                'genres_id' => 1,
                'authors_id' => 4,
            ],
        );

        Book::create(
            [
                'title' => 'siang',
                'description' => 'A fantasy novel that takes you to another world.',
                'price' => 70000,
                'stok' => 30,
                'cover_photo' => 'siang.jpg',
                'genres_id' => 2,
                'authors_id' => 5,
            ],
        );
    }
}
