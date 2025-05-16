<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    private $books = [
        [
            'title' => 'pulang',
            'description' => 'A novel written by American author F. Scott Fitzgerald.',
            'price' => 40000,
            'stok' => 15,
            'cover_photo' => 'pulang.jpg',
            'genres_id' => 1,
            'authors_id' => 1
        ],
        [
            'title' => 'sampai jumpa',
            'description' => 'A novel written by American author gerrard',
            'price' => 25000,
            'stok' => 15,
            'cover_photo' => 'sampai-jumpa.jpg',
            'genres_id' => 1,
            'authors_id' => 1
        ],
        [
            'title' => 'selamat tinggal',
            'description' => 'A novel written by American author sanjaya',
            'price' => 90000,
            'stok' => 15,
            'cover_photo' => 'selamat-tinggal.jpg',
            'genres_id' => 1,
            'authors_id' => 1
        ]
    ];

    public function getBooks()
    {
        return $this->books;
    }
}
