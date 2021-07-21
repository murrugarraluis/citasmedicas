<?php

namespace Database\Seeders;


use App\Models\Hospital;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // CREACION DE ROLES
        Role::factory()->create(['name' => 'Administrativo']);
        Role::factory()->create(['name' => 'Hospital']);
        Role::factory()->create(['name' => 'Doctor']);
        Role::factory()->create(['name' => 'Paciente']);

        // CREACION DE USUARIOS
        $admin = User::factory()->create([
            'DNI' => '75579609',
            'name' => 'Luis Angel',
            'lastname' => 'Murrugarra Astolingon',
            'gender' => 'Masculino',
            'email' => 'admin@app.com',
            'password' => bcrypt('123456'),
        ]);
        $doctorHospital = User::factory()->create([
            'DNI' => '48896780',
            'name' => 'Ricardo Miguel',
            'lastname' => 'Sanchez Nuñez',
            'gender' => 'Masculino',
            'email' => 'hospital@app.com',
            'password' => bcrypt('123456'),
        ]);
        $doctor = User::factory()->create([
            'DNI' => '38773404',
            'name' => 'Jose Carlos',
            'lastname' => 'Lezama Vazques',
            'gender' => 'Masculino',
            'email' => 'doctorl@app.com',
            'password' => bcrypt('123456'),
        ]);
        $paciente = User::factory()->create([
            'DNI' => '96722339',
            'name' => 'Javier Antonio',
            'lastname' => 'Acosta Saucedo',
            'gender' => 'Masculino',
            'email' => 'paciente@app.com',
            'password' => bcrypt('123456'),
        ]);

        //CREAR HISTORIA MEDICA A USUARIO PACIENTE
        $paciente->medicalhistory()->create();

        // DERIVAR USUARIO A TABLA DOCTOR
        $doctor->doctor()->create(['speciality' => 'Medicina General', 'phone' => '123-567']);

        // ASIGNAR ROLES A USUARIOS
        $admin->roles()->attach(1);
        $doctorHospital->roles()->attach([2, 4]);
        $doctor->roles()->attach([3, 4]);
        $paciente->roles()->attach(4);

        // CREACION DE HOSPITAL
        $hospital = Hospital::factory()->create([
            'name' => 'Tomas Lafora',
            'district' => 'Guadalupe',
            'provincie' => 'Pacasmayo',
            'departament' => 'La Libertad'
        ]);

        // CREACION DE TEAMS EN HOSPITAL 1
        $hospital->covidteams()->create(['name' => 'Equipo 01 Lafora Guadalupe']);
        $hospital->covidteams()->create(['name' => 'Equipo 02 Lafora Guadalupe']);

        // ASIGNAR DOCTOR A UN HOSPITAL Y UN TEAM
        $doctor->doctor->hospitals()->attach(1);
        $doctor->doctor->covidteams()->attach(1);

        // CREACION DE CITA
        $appointment = $paciente->appointments()->create(['date' => '17/08/2021', 'status' => 'Atendido',]);
        // ASIGNAR DOCTOR A CITA
        $appointment->doctor()->associate(1);
        $appointment->save();


        // CREAR FICHA DE ATENCION DE LA CITA
        $attentionsheet = $appointment->attentionsheet()->create();
        // ASIGNAR FICHA A SU HISTORIA MEDICA
        $attentionsheet->medicalhistory()->associate(1);
        $attentionsheet->save();
    }
}
