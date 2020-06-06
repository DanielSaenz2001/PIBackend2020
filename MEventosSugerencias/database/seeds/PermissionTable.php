<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;
class PermissionTable extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'Navegar Egresados',
            'slug' => 'users.index',
            'description' => 'Lista y navega todos los usuarios del sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalles Egresados',
            'slug' => 'users.show',
            'description' => 'Ver en detalle los datos de los usuarios del sistema',
        ]);
        Permission::create([
            'name' => 'Editar Egresados',
            'slug' => 'users.update',
            'description' => 'Editar los usuarios del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar Egresados',
            'slug' => 'users.destroy',
            'description' => 'Eliminar los usuarios del sistema',
        ]);
        // roles
        Permission::create([
            'name' => 'Navegar roles',
            'slug' => 'roles.index',
            'description' => 'Lista y navega todos los roles del sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalles roles',
            'slug' => 'roles.show',
            'description' => 'Ver en detalle los datos de los roles del sistema',
        ]);
        Permission::create([
            'name' => 'Editar roles',
            'slug' => 'roles.update',
            'description' => 'Editar los roles del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar roles',
            'slug' => 'roles.destroy',
            'description' => 'Eliminar los roles del sistema',
        ]);
        // eventos
        Permission::create([
            'name' => 'Navegar Eventos',
            'slug' => 'eventos.index',
            'description' => 'Lista y navega todos los eventos del sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalles Eventos',
            'slug' => 'eventos.show',
            'description' => 'Ver en detalle los datos de los eventos del sistema',
        ]);
        Permission::create([
            'name' => 'Editar Eventos',
            'slug' => 'eventos.update',
            'description' => 'Editar los eventos del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar Eventos',
            'slug' => 'eventos.destroy',
            'description' => 'Eliminar los eventos del sistema',
        ]);
        //Sugerencias
        Permission::create([
            'name' => 'Navegar Sugerencias',
            'slug' => 'comentario.index',
            'description' => 'Lista y navega todos las sugerencias del sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalles Sugerencias',
            'slug' => 'comentario.show',
            'description' => 'Ver en detalle los datos de las sugerencias del sistema',
        ]);
        Permission::create([
            'name' => 'Editar Sugerencias',
            'slug' => 'comentario.update',
            'description' => 'Editar las sugerencias del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar Sugerencias',
            'slug' => 'comentario.destroy',
            'description' => 'Eliminar las sugerencias del sistema',
        ]);
        //Documentos
        Permission::create([
            'name' => 'Navegar Documentos',
            'slug' => 'documento.index',
            'description' => 'Lista y navega todos los Documentos del sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalles Documentos',
            'slug' => 'documento.show',
            'description' => 'Ver en detalle los datos de los Documentos del sistema',
        ]);
        Permission::create([
            'name' => 'Editar Documentos',
            'slug' => 'documento.update',
            'description' => 'Editar los Documentos del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar Documentos',
            'slug' => 'documento.destroy',
            'description' => 'Eliminar los Documentos del sistema',
        ]);
        //explaborar
        Permission::create([
            'name' => 'Navegar Experiencia Laboral',
            'slug' => 'laboral.index',
            'description' => 'Lista y navega todos las Experiencia Laboral del sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalles Experiencia Laboral',
            'slug' => 'laboral.show',
            'description' => 'Ver en detalle las Experiencia Laboral datos de las  del sistema',
        ]);
        Permission::create([
            'name' => 'Editar Experiencia Laboral',
            'slug' => 'laboral.update',
            'description' => 'Editar las Experiencia Laboral  del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar Experiencia Laboral',
            'slug' => 'laboral.destroy',
            'description' => 'Eliminar las Experiencia Laboral  del sistema',
        ]);
    }
}
