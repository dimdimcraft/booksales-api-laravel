<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'Authors';
    protected $fillable =[
        'name'
    ];

}
