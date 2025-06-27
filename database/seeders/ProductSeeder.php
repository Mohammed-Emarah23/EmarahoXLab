<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([

            "name"=>"MacBook pro M1", 
            "desc"=>"Labtop with high performance",
            "quantity"=>"5",
            "price"=>100000,
            "image"=>"Product/macbook.jpg"

        ]);

         Product::create([

            "name"=>"iphone", 
            "desc"=>"iphone 5s",
            "quantity"=>"10",
            "price"=>4000,
            "image"=>"Product/iphone11.jpg"

        ]);
    }
}
