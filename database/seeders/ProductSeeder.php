<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Penelusuran Benang Merah (A Study In Scarlet)',
                'slug' => 'penelusuan-benang-merah',
                'image' => 'https://cdn.gramedia.com/uploads/items/9786020631653_Penelusuran-Benang-Merah-A-Study-In-Scarlet.jpg',
                'description' => 'Penelusuran Benang Merah merupakan buku novel fiksi detektif karya Sir Arthur Conan Doyle yang memperkenalkan tokoh detektif konsultan rekaannya, Sherlock Holmes, serta sahabat sekaligus penulis kisah petualangannya, dr. Watson, yang kelak akan menjadi dua tokoh terkenal dalam dunia sastra.',
                'price' => 53000,
            ],
            [
                'name' => 'Empat Pemburu Harta (The Sign of Four)',
                'slug' => 'empat-pemburu-harga',
                'image' => 'https://cdn.gramedia.com/uploads/items/9786020632148_Empat-Pemburu-Harta-The-Sign-Of-Four.jpg',
                'description' => "Empat Pemburu Harta (judul asli dalam bahasa Inggris: The Sign of Four) adalah novel kedua karya Sir Arthur Conan Doyle yang menampilkan Sherlock Holmes, terbit pertama kali pada tahun 1890 di Lippincott's Monthly Magazine.",
                'price' => 70000,
            ],
            [
                'name' => 'Anjing Setan (The Hound of the Baskervilles)',
                'slug' => 'anjing-setan',
                'image' => 'https://cdn.gramedia.com/uploads/items/9786020632599_Anjing-Setan-The-Hound-Of-The-Baskervilles.jpg',
                'description' => 'Anjing Setan atau The Hound of the Baskervilles adalah yang ketiga dari empat cerita detektif yang dibintangi Sherlock Holmes oleh Sir Arthur Conan Doyle. Awalnya diterbitkan di majalah Strand dari Agustus 1901 hingga April 1902, ceritanya berlatar di Dartmoor, Devon, di Negara Barat Inggris, dan menceritakan kisah upaya pembunuhan yang terinspirasi oleh legenda anjing liar supernatural.',
                'price' => 75000,
            ],
            [
                'name' => 'Lembah Ketakutan (The Valley of Fear)',
                'slug' => 'lembah-ketakutan',
                'image' => 'https://cdn.gramedia.com/uploads/items/9786020632087_Lembah-Ketakutan-The-Valley-Of-Fear.jpg',
                'description' => 'Lembah Ketakutan adalah novel Sherlock Holmes keempat dan terakhir oleh Sir Arthur Conan Doyle. Karya ini didasarkan pada Molly Maguire dan agen Pinkerton James McParland. Kisah ini pertama kali muncul di majalah The Strand antara September 1914 dan Mei 1915. Edisi pertama buku ini memiliki hak cipta pada tahun 1914, Arthur I. Keller.',
                'price' => 78000,
            ],
        ];
        Product::insert($products);
    }
}
