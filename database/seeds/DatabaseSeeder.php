<?php

use Illuminate\Database\Seeder;

//my uses:
use Illuminate\Support\Facades\Hash;
use App\User;
use App\DocumentType;
use App\DriverLicense;
use App\Position;
use App\Employee;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(DocumentTypeTableSeeder::class);
        $this->call(DriverLicenseTableSeeder::class);
        $this->call(PositionTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);
        $this->call(UnitTableSeeder::class);
    }
	
}

class UsersTableSeeder extends Seeder 
{

    public function run()
    {
        DB::table('users')->delete();

        User::create([
                    'name' => '46618582',
        			//'email' => 'henryespinozat@gmail.com',
        			'password' => Hash::make('46618582'), //to encrip password
        				]);
	}
}

class DocumentTypeTableSeeder extends Seeder 
{

    public function run()
    {
        DB::table('documentType')->delete();

        DocumentType::create([
                    'name' => 'DNI',
                    'description' => 'Documento de identidad del ciudadano peruano.', 
                        ]);

        DocumentType::create([
                    'name' => 'Pasaporte',
                    'description' => 'Documento de identidad de los extrajeros.', 
                        ]);
    }
}

class DriverLicenseTableSeeder extends Seeder 
{

    public function run()
    {
        DB::table('driverLicense')->delete();

        DriverLicense::create([
                    'name' => 'A-I',
                    'description' => 'Vehículos pequeños.', 
                        ]);

        DriverLicense::create([
                    'name' => 'A-II',
                    'description' => 'Vehículos medianos.', 
                        ]);

        DriverLicense::create([
                    'name' => 'A-III',
                    'description' => 'Vehículos pesados.', 
                        ]);
    }
}

class PositionTableSeeder extends Seeder 
{

    public function run()
    {
        DB::table('position')->delete();

        Position::create([
                    'name' => 'Administrador del sistema',
                    'description' => 'Responsable del sistema de información.', 
                        ]);

        Position::create([
                    'name' => 'Administrador',
                    'description' => 'Resposable del personal de la empresa.', 
                        ]);

        Position::create([
                    'name' => 'Chofer',
                    'description' => 'Encargado de enviar los pedidos.', 
                        ]);

        Position::create([
                    'name' => 'Cajero',
                    'description' => 'Encargado de recibir los pedidos.', 
                        ]);

        Position::create([
                    'name' => 'Almacenero',
                    'description' => 'Encargado del almacen.', 
                        ]);
    }
}

class EmployeeTableSeeder extends Seeder 
{

    public function run()
    {
        DB::table('employee')->delete();

        //first position: administrador del sistema
        $position = Position::orderBy('idPosition', 'asc')->first();

        //first documentType: DNI
        $documentType = DocumentType::orderBy('idDocumentType', 'asc')->first();

        //first user: el mismo usuario
        $user = User::orderBy('id', 'asc')->first();

        Employee::create([
                    'names' => 'Henry Antonio',
                    'fatherLastName' =>'Espinoza',
                    'motherLastName' =>'Torres',

                    'birthdate' => '1990-12-20 00:00:00',
                    'documentNumber' => '46618582',
                    'email' => 'henryespinozat@gmail.com',

                    'state'=> 'Activo',
                    'gender'=> 'Hombre',        
                    'phone'=> '930414373',

                    'entryDate'=> '2016-01-01 00:00:00',
                    'endDate'=> null,

                    'idPosition' => $position->idPosition,  
                    'idDocumentType'=> $documentType->idDocumentType,
                    'idDriverLicense'=> null,
                    'idUser'=> $user->id,
                        ]);
    }
}

class UnitTableSeeder extends Seeder 
{

    public function run()
    {
        DB::table('unit')->delete();

        Unit::create([
                    'name' => 'bolsa'
                        ]);
        Unit::create([
                    'name' => 'm3'
                        ]);
        Unit::create([
                    'name' => 'unidad'
                        ]);
        Unit::create([
                    'name' => 'varilla'
                        ]);
        Unit::create([
                    'name' => 'otro'
                        ]);
    }
}