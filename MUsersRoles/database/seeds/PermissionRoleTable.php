<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionRoleTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'Ver Usuarios',
            'slug' => 'users.index',
            'description' => 'Ver Usuarios del Sistema Web',
        ]);
        Permission::create([
            'name' => 'Ver Detalles Usuarios',
            'slug' => 'users.show',
            'description' => 'Ver Detales Usuarios del Sistema Web',
        ]);

        Permission::create([
            'name' => 'Editar Usuarios',
            'slug' => 'users.edit',
            'description' => 'Editar Usuarios del Sistema Web',
        ]);
        Permission::create([
            'name' => 'Eliminar Usuarios',
            'slug' => 'users.destroy',
            'description' => 'Eliminar Usuarios del Sistema Web',
        ]);
        Permission::create([
            'name' => 'Ver Roles',
            'slug' => 'roles.index',
            'description' => 'Ver Roles del Sistema Web',
        ]);
        Permission::create([
            'name' => 'Ver Detalles Roles',
            'slug' => 'roles.show',
            'description' => 'Ver Detales Roles del Sistema Web',
        ]);
        Permission::create([
            'name' => 'Agregar Roles',
            'slug' => 'roles.create',
            'description' => 'Agregar Roles del Sistema Web',
        ]);
        Permission::create([
            'name' => 'Editar Roles',
            'slug' => 'roles.edit',
            'description' => 'Editar Roles del Sistema Web',
        ]);
        Permission::create([
            'name' => 'Eliminar Roles',
            'slug' => 'roles.destroy',
            'description' => 'Eliminar Roles del Sistema Web',
        ]);
    }
}
