<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //egresados
        Permission::create([
            'name' => 'Navegar Egresados',
            'slug' => 'users.index',
            'descripcion' => 'Lista y navega todos los usuarios del sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalles Egresados',
            'slug' => 'users.show',
            'descripcion' => 'Ver en detalle los datos de los usuarios del sistema',
        ]);
        Permission::create([
            'name' => 'Editar Egresados',
            'slug' => 'users.edit',
            'descripcion' => 'Editar los usuarios del sistema',
        ]);
        Permission::create([
            'name' => 'Navegar Egresados',
            'slug' => 'users.destroy',
            'descripcion' => 'Eliminar los usuarios del sistema',
        ]);
        // roles
        Permission::create([
            'name' => 'Navegar roles',
            'slug' => 'users.index',
            'descripcion' => 'Lista y navega todos los usuarios del sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalles roles',
            'slug' => 'users.show',
            'descripcion' => 'Ver en detalle los datos de los usuarios del sistema',
        ]);
        Permission::create([
            'name' => 'Editar roles',
            'slug' => 'users.edit',
            'descripcion' => 'Editar los usuarios del sistema',
        ]);
        Permission::create([
            'name' => 'Navegar roles',
            'slug' => 'users.destroy',
            'descripcion' => 'Eliminar los usuarios del sistema',
        ]);
    }
}
