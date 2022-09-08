<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //dashbard module create
        $dashboardModule = Module::updateOrcreate([
            'name'  => 'Admin Dashboard'
        ]);

         //dashbard module permission
        Permission::updateOrCreate([
            'module_id' => $dashboardModule->id,
            'name'      => 'Access Dashboard',
            'slug'      => 'app.dashboard'
        ]);

         //role module create
        $roleModule = Module::updateOrcreate([
            'name'  => 'Role Management'
        ]);

         //dashbard module permissions create
        Permission::updateOrCreate([
            'module_id' => $roleModule->id,
            'name'      => 'Access Role',
            'slug'      => 'app.role.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $roleModule->id,
            'name'      => 'Create Role',
            'slug'      => 'app.role.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $roleModule->id,
            'name'      => 'Edit Role',
            'slug'      => 'app.role.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $roleModule->id,
            'name'      => 'Delete Role',
            'slug'      => 'app.role.delete'
        ]);

        //user module create
        $usersModule = Module::updateOrCreate([
            'name'=>'User Management'
        ]);
        
        //user module permissions create
        Permission::updateOrCreate([

            'module_id' => $usersModule->id,
            'name' => 'Access User',
            'slug' => 'app.user.index'

        ]);


        Permission::updateOrCreate([

            'module_id' => $usersModule->id,
            'name' => 'Create User',
            'slug' => 'app.user.create'

        ]);


        Permission::updateOrCreate([

            'module_id' => $usersModule->id,
            'name' => 'Edit User',
            'slug' => 'app.user.edit'

        ]);


        Permission::updateOrCreate([

            'module_id' => $usersModule->id,
            'name' => 'Delete User',
            'slug' => 'app.user.delete'

        ]);

         //Category module create
         $categoryModule = Module::updateOrCreate([
            'name'=>'Category Management'
        ]);
        
        //category module permissions create
        Permission::updateOrCreate([

            'module_id' => $categoryModule->id,
            'name' => 'Access Category',
            'slug' => 'app.category.index'

        ]);


        Permission::updateOrCreate([

            'module_id' => $categoryModule->id,
            'name' => 'Create Category',
            'slug' => 'app.category.create'

        ]);


        Permission::updateOrCreate([

            'module_id' => $categoryModule->id,
            'name' => 'Edit Category',
            'slug' => 'app.category.edit'

        ]);


        Permission::updateOrCreate([

            'module_id' => $categoryModule->id,
            'name' => 'Delete Category',
            'slug' => 'app.category.delete'

        ]);

        //Sub category Module create
        $subCategory = Module::updateOrCreate([
            'name'=>'Sub Category Management'
        ]);
        
        //user module permissions create
        Permission::updateOrCreate([

            'module_id' => $subCategory->id,
            'name' => 'Access Sub Category',
            'slug' => 'app.subcategory.index'

        ]);


        Permission::updateOrCreate([

            'module_id' => $subCategory->id,
            'name' => 'Create Sub Category',
            'slug' => 'app.subcategory.create'

        ]);


        Permission::updateOrCreate([

            'module_id' => $subCategory->id,
            'name' => 'Edit Sub Category',
            'slug' => 'app.subcategory.edit'

        ]);


        Permission::updateOrCreate([

            'module_id' => $subCategory->id,
            'name' => 'Delete Sub Category',
            'slug' => 'app.subcategory.delete'

        ]);


        //Color Module create
        $colorModule = Module::updateOrCreate([
            'name'=>'Color Management'
        ]);
        
        //Color module permissions create
        Permission::updateOrCreate([

            'module_id' => $colorModule->id,
            'name' => 'Access Color',
            'slug' => 'app.color.index'

        ]);


        Permission::updateOrCreate([

            'module_id' => $colorModule->id,
            'name' => 'Create Color',
            'slug' => 'app.color.create'

        ]);


        Permission::updateOrCreate([

            'module_id' => $colorModule->id,
            'name' => 'Edit Color',
            'slug' => 'app.color.edit'

        ]);


        Permission::updateOrCreate([

            'module_id' => $colorModule->id,
            'name' => 'Delete Color',
            'slug' => 'app.color.delete'

        ]);
    }
}
