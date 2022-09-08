<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Size::updateOrcreate([
            'name'      => 'L',
            'slug'      => 'l'
        ]);

        Size::updateOrcreate([
            'name'      => 'Xl',
            'slug'      => 'xl'
        ]);
    }
}
