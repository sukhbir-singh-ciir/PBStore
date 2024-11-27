<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class AuthorsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $authors = [
            [
                'name' => 'Bhai Vir Singh',
                'bio' => 'Bhai Vir Singh was a poet, scholar and theologian and is considered the father of modern Punjabi literature.',
                'image' => 'bhai_vir_singh.jpg',
            ],
            [
                'name' => 'Amrita Pritam',
                'bio' => 'Amrita Pritam was a Punjabi writer and poet, considered the first prominent woman Punjabi poet, novelist, and essayist.',
                'image' => 'amrita_pritam.jpg',
            ],
            [
                'name' => 'Shiv Kumar Batalvi',
                'bio' => 'Shiv Kumar Batalvi was a Punjabi language poet, who was most known for his romantic poetry.',
                'image' => 'shiv_kumar_batalvi.jpg',
            ],
            [
                'name' => 'Surjit Patar',
                'bio' => 'Surjit Patar is a Punjabi language poet, playwright and translator from India.',
                'image' => 'surjit_patar.jpg',
            ],
            [
                'name' => 'Nanak Singh',
                'bio' => 'Nanak Singh was a poet, songwriter and novelist in the Punjabi language. He is known as the father of the Punjabi novel.',
                'image' => 'nanak_singh.jpg',
            ],
        ];

        foreach ($authors as $author) {
            DB::table('authors')->insert([
                'name' => $author['name'],
                'bio' => $author['bio'],
                'image' => $author['image'],
                'image_path' => '/images/authors/' . $author['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Add 5 more random authors
        for ($i = 0; $i < 5; $i++) {
            DB::table('authors')->insert([
                'name' => $faker->name,
                'bio' => $faker->paragraph(3),
                'image' => null,
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}