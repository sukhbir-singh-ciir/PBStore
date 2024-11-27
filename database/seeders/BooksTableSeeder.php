<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Satwant Kaur',
                'author_id' => 1,
                'description' => 'Satwant Kaur is a novel by Bhai Vir Singh.',
                'image' => 'satwant_kaur.jpg',
                'image_path' => '/images/books/satwant_kaur.jpg',
            ],
            [
                'title' => 'Pinjar',
                'author_id' => 2,
                'description' => 'Pinjar is a Punjabi novel written by Amrita Pritam.',
                'image' => 'pinjar.jpg',
                'image_path' => '/images/books/pinjar.jpg',
            ],
            [
                'title' => 'Loona',
                'author_id' => 3,
                'description' => 'Loona is a Punjabi novel written by Shiv Kumar Batalvi.',
                'image' => 'loona.jpg',
                'image_path' => '/images/books/loona.jpg',
            ],
            [
                'title' => 'Hanera',
                'author_id' => 4,
                'description' => 'Hanera is a Punjabi novel written by Surjit Patar.',
                'image' => 'hanera.jpg',
                'image_path' => '/images/books/hanera.jpg',
            ],
            [
                'title' => 'Adh Chanani Raat',
                'author_id' => 5,
                'description' => 'Adh Chanani Raat is a Punjabi novel written by Nanak Singh.',
                'image' => 'adh_chanani_raat.jpg',
                'image_path' => '/images/books/adh_chanani_raat.jpg',
            ],
        ];

        foreach ($books as $book) {
            DB::table('books')->insert([
                'title' => $book['title'],
                'author_id' => $book['author_id'],
                'genre_id' => rand(1, 5),
                'description' => $book['description'],
                'image' => $book['image'],
                'image_path' => $book['image_path'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
