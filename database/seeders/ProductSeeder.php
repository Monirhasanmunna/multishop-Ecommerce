<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Unit;
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
        Product::updateOrcreate([
            'category_id'   => Category::where('slug','electronic')->first()->id,
            'subcategory_id'      => SubCategory::where('slug','camera')->first()->id,
            'unit_id'     => Unit::where('slug','kg')->first()->id,
            'name'  => 'canon',
            'price'  => 70000,
            'offer_price'  => 65000,
            'quantity'  => 100,
        ]);
    }
}
