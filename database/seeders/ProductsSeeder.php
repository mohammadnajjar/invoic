<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            "product_name" => 'cc',
            "description" => 'cc',
            "section_id" => 1,
        ]);
        Product::create([
            "product_name" => 'قرض طلابي',
            "description" => 'قرض طلابي',
            "section_id" => 2,
        ]);
        Product::create([
            "product_name" => 'قرض اسلامي',
            "description" => 'قرض اسلامي',
            "section_id" => 2,
        ]);
        Product::create([
            "product_name" => 'cc',
            "description" => 'cc',
            "section_id" => 3,
        ]);
        Product::create([
            "product_name" => 'cc',
            "description" => 'cc',
            "section_id" => 4,
        ]);

        Product::create([
            "product_name" => 'قرض طلابي',
            "description" => 'قرض طلابي',
            "section_id" => 5,
        ]);

    }
}
