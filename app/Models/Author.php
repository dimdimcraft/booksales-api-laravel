<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    private $genres = [
        ['id' => 1, 'name' => 'Fiksi'],
        ['id' => 2, 'name' => 'Non-Fiksi'],
        ['id' => 3, 'name' => 'Romantis'],
        ['id' => 4, 'name' => 'Petualangan'],
        ['id' => 5, 'name' => 'Misteri'],
    ];

    public function getAll()
    {
        return $this->genres;
    }

}
