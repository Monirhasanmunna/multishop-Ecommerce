<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allPermission = Permission::all();

        Role::updateOrCreate([
            'name'  => 'Admin',
            'slug'  => 'admin',
            'deletable'=> false
        ])->permissions()->sync($allPermission->pluck('id'));

        Role::updateOrCreate([
            'name'  => 'Author',
            'slug'  => 'author',
            'deletable'=> false
        ]);

        Role::updateOrCreate([
            'name'  => 'User',
            'slug'  => 'user',
            'deletable'=> false
        ]);
    }
}
