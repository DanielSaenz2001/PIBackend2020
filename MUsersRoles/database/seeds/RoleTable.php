<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
class RoleTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrador',
            'slug' => 'admin',
            'special' => 'all-access',
        ]);
    }
}
