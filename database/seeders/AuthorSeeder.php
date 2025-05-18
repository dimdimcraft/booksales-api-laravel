<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create(
            [
                'name' => 'F. Scott Fitzgerald',
            ],
        );

        Author::create(
            [
                'name' => 'J.K. Rowling',
            ],
        );

        Author::create(
            [
                'name' => 'Agatha Christie',
            ],
        );

        Author::create(
            [
                'name' => 'J.R.R. Tolkien',
            ],
        );

        Author::create(
            [
                'name' => 'George R.R. Martin',
            ],
        );
    }
}
