<?php

use Illuminate\Database\Seeder;

//my uses:
use Illuminate\Support\Facades\Hash;
use App\User;
use App\DocumentType;
use App\DriverLicense;
use App\Position;
use App\Employee;
use App\Unit;
use App\Zone;
use App\Client;

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
        $this->call(ZoneTableSeeder::class);
        $this->call(ClientTableSeeder::class);
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
                    'type' => 'Person',
                        ]);

        DocumentType::create([
                    'name' => 'Pasaporte',
                    'description' => 'Documento de identidad de los extrajeros.',
                    'type' => 'Person',
                        ]);

        DocumentType::create([
                    'name' => 'RUC',
                    'description' => 'Documento único de una empresa.',
                    'type' => 'Company',
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
                    'gender'=> 'Masculino',        
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
        Unit::create([
                    'name' => 'kg'
                        ]);
        Unit::create([
                    'name' => 'envase'
                        ]);
        Unit::create([
                    'name' => 'm'
                        ]);
        Unit::create([
                    'name' => 'par'
                        ]);
        Unit::create([
                    'name' => 'rollo'
                        ]);
        Unit::create([
                    'name' => 'caja'
                        ]);
        Unit::create([
                    'name' => 'millar'
                        ]);
    }
}

class ZoneTableSeeder extends Seeder 
{

    public function run()
    {
        DB::table('zone')->delete();

        Zone::create([
                    'name' => '10 de octubre',
                    'shipping' => 0.0,
                    'state' => 'Activo'
                        ]);

        Zone::create([
                    'name' => 'Maria jesus',
                    'shipping' => 0.0,
                    'state' => 'Activo'
                        ]);

        Zone::create([
                    'name' => 'Nueva luz',
                    'shipping' => 0.0,
                    'state' => 'Activo'
                        ]);

        Zone::create([
                    'name' => 'Balcones verdes',
                    'shipping' => 0.0,
                    'state' => 'Activo'
                        ]);
        Zone::create([
                    'name' => 'Santa rosita sector 5',
                    'shipping' => 0.0,
                    'state' => 'Activo'
                        ]);
        Zone::create([
                    'name' => 'Planicie',
                    'shipping' => 0.0,
                    'state' => 'Activo'
                        ]);
        Zone::create([
                    'name' => 'Otro',
                    'shipping' => 0.0,
                    'state' => 'Activo'
                        ]);

    }
}

class ClientTableSeeder extends Seeder 
{

    public function run()
    {
        DB::table('client')->delete();
        
        //first documentType: DNI
        $documentType = DocumentType::orderBy('idDocumentType', 'asc')->first();

        Client::create([
                    'names' => 'Henry Antonio',
                    'fatherLastName' =>'Espinoza',
                    'motherLastName' =>'Torres',

                    'birthdate' => '1990-12-20 00:00:00',
                    'documentNumber' => '46618582',
                    'email' => 'henryespinozat@gmail.com',

                    'gender'=> 'Masculino',        
                    'phone'=> '930414373',
                    'registerDate'=> '2017-01-19 00:00:00',
                    
                    'businessName'=> null,
                    'idDocumentType'=> $documentType->idDocumentType
                        ]);
    }
}