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
use App\BillType;
use App\PaymentType;
use App\bankAccount;

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
        $this->call(BillTypeTableSeeder::class);

        //news
        $this->call(PaymentTypeTableSeeder::class);
        $this->call(BankAccountTableSeeder::class);
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
                    'name' => 'bolsa',
                    'legalCode' => 'BG'
                        ]);
        Unit::create([
                    'name' => 'botella',
                    'legalCode' => 'BO'
                        ]);
        Unit::create([
                    'name' => 'caja',
                    'legalCode' => 'BX'
                        ]);

        Unit::create([
                    'name' => 'hoja',
                    'legalCode' => 'LEF'
                        ]);
        Unit::create([
                    'name' => 'kg',
                    'legalCode' => 'KGM'
                        ]);
        Unit::create([
                    'name' => 'lata',
                    'legalCode' => 'CA'
                        ]);

        Unit::create([
                    'name' => 'm',
                    'legalCode' => 'MTR'
                        ]);
        Unit::create([
                    'name' => 'm3',
                    'legalCode' => 'MTQ'
                        ]);
        Unit::create([
                    'name' => 'millar',
                    'legalCode' => 'MLL'
                        ]);

        Unit::create([
                    'name' => 'rollo',
                    'legalCode' => 'PK'
                        ]);
        Unit::create([
                    'name' => 'par',
                    'legalCode' => 'PR'
                        ]);
        Unit::create([
                    'name' => 'unidad',
                    'legalCode' => 'NIU'
                        ]);

        Unit::create([
                    'name' => 'carretilla', // there is not code in SUNAT.
                    'legalCode' => 'NIU'
                        ]);
        Unit::create([
                    'name' => 'varilla', // there is not code in SUNAT.
                    'legalCode' => 'NIU'
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
                    'shipping' => 10.0,
                    'state' => 'Activo'
                        ]);

        Zone::create([
                    'name' => 'Nueva luz',
                    'shipping' => 10.0,
                    'state' => 'Activo'
                        ]);

        Zone::create([
                    'name' => 'Balcones verdes',
                    'shipping' => 10.0,
                    'state' => 'Activo'
                        ]);
        Zone::create([
                    'name' => 'Santa rosita sector 5',
                    'shipping' => 20.0,
                    'state' => 'Activo'
                        ]);
        Zone::create([
                    'name' => 'Planicie',
                    'shipping' => 10.0,
                    'state' => 'Activo'
                        ]);
        Zone::create([
                    'name' => 'Otro',
                    'shipping' => 0.0,
                    'state' => 'Activo'
                        ]);

        Zone::create([
                    'name' => 'San juan',
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

class BillTypeTableSeeder extends Seeder 
{

    public function run()
    {
        DB::table('billType')->delete();
        //NO BORRAR NINGUN PEDIDO ni cambiar el nombre (name). Puede traer problemas.
        BillType::create([
                    'name' => 'Proforma',
                    'description' => 'No SUNAT. Estimación del costo de lo que decea el cliente',
                    'state' => 'Activo',
                    'isSale' => false
                        ]);

        BillType::create([
                    'name' => 'Pedido',
                    'description' => 'Si SUNAT',
                    'state' => 'Activo',
                    'isSale' => true
                        ]);

        BillType::create([
                    'name' => 'Por recoger',
                    'description' => 'No SUNAT. Se guarda el dinero del cliente.',
                    'state' => 'Activo',
                    'isSale' => true
                        ]);

        BillType::create([
                    'name' => 'Credito',
                    'description' => 'Si SUNAT. Los productos se envían sin haber pagado',
                    'state' => 'Activo',
                    'isSale' => true
                        ]);

    }
}

class PaymentTypeTableSeeder extends Seeder 
{
    public function run()
    {
        DB::table('paymentType')->delete();
        PaymentType::create([
                    'name' => 'Efectivo',
                    'description' => 'Dinero dado en mano.',
                    'state' => 'Activo'
                        ]);

        PaymentType::create([
                    'name' => 'Deposito',
                    'description' => 'Dinero depositado en una cuenta bancaria',
                    'state' => 'Activo'
                        ]);

    }
}

class BankAccountTableSeeder extends Seeder 
{
    public function run()
    {
        DB::table('bankAccount')->delete();
        BankAccount::create([
                    'bankName' => 'BCP',
                    'accountNumber' => '1234567891',
                    'interbankAccountNumber' => '1234567891',
                    'state' => 'Activo'
                        ]);

        BankAccount::create([
                    'bankName' => 'INTERBANK',
                    'accountNumber' => '1234567891',
                    'interbankAccountNumber' => '1234567891',
                    'state' => 'Activo'
                        ]);

    }
}