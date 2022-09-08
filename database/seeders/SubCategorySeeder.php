<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubCategory::updateOrcreate([
            'category_id'   => 1,
            'name'      => 'Camera',
            'slug'      => 'camera'
        ]);

        SubCategory::updateOrcreate([
            'category_id'   => 1,
            'name'      => 'Mobile',
            'slug'      => 'mobile'
        ]);

        SubCategory::updateOrcreate([
            'category_id'   => 2,
            'name'      => 'Fan',
            'slug'      => 'fan'
        ]);

        SubCategory::updateOrcreate([
            'category_id'   => 3,
            'name'      => 'Bat',
            'slug'      => 'bat'
        ]);
    }
}
