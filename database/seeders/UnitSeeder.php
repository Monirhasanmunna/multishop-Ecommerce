<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::updateOrcreate([
            'name'      => 'Kg',
            'slug'      => 'kg'
        ]);

        Unit::updateOrcreate([
            'name'      => 'Liter',
            'slug'      => 'liter'
        ]);
    }
}
