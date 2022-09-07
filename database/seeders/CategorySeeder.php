<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::updateOrcreate([
            'name'      => 'Gadget',
            'slug'      => 'gadget'
        ]);

        Category::updateOrcreate([
            'name'      => 'Electronic',
            'slug'      => 'electronic'
        ]);

        Category::updateOrcreate([
            'name'      => 'Sports',
            'slug'      => 'sports'
        ]);

        Category::updateOrcreate([
            'name'      => 'Kid',
            'slug'      => 'kid'
        ]);
    }
}
