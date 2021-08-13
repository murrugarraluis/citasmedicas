<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$role01 = Role::create(['name' => 'Administrativo']);
		$role02 = Role::create(['name' => 'Hospital']);
		$role03 = Role::create(['name' => 'Doctor']);
		$role04 = Role::create(['name' => 'Paciente']);

		Permission::create(['name'=>'hospital'])->assignRole($role01);

		Permission::create(['name'=>'covidteam'])->assignRole($role02);
		Permission::create(['name'=>'doctor'])->assignRole($role02);

		Permission::create(['name'=>'appointment'])->assignRole($role03);
	}
}
