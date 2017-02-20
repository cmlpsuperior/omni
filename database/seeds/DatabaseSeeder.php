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
use App\MoneyType;
use App\PaymentType;
use App\bankAccount;
use App\VoucherType;

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
        //news
        $this->call(MoneyTypeTableSeeder::class);
        $this->call(PaymentTypeTableSeeder::class);
        $this->call(BankAccountTableSeeder::class);
        $this->call(VoucherTypeTableSeeder::class);
    }
	
}

class UsersTableSeeder extends Seeder 
{

    public function run()
    {
        DB::table('users')->delete();

        User::create([
                    'name' => '46618582',
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
                    'idDocumentType' => '1',
                    'name' => 'DNI',
                    'type' => 'Person'
                        ]);

        DocumentType::create([
                    'idDocumentType' => '7',
                    'name' => 'Pasaporte',
                    'type' => 'Person'
                        ]);
        DocumentType::create([
                    'idDocumentType' => '6',
                    'name' => 'RUC',
                    'type' => 'Company'
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
        $documentType = DocumentType::where('name','=', 'DNI')->first();

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
        $documentType = DocumentType::where('name','=', 'DNI')->first();

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


class MoneyTypeTableSeeder extends Seeder 
{

    public function run()
    {
        DB::table('moneyType')->delete();

        MoneyType::create([
                    'idMoneyType' => 'PEN',
                    'name' => 'Sol'
                        ]);
        MoneyType::create([
                    'idMoneyType' => 'USD',
                    'name' => 'Dolares americanos'
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

class VoucherTypeTableSeeder extends Seeder 
{
    public function run()
    {
        DB::table('voucherType')->delete();
        VoucherType::create([
                    'idVoucherType' => '01',
                    'name' => 'Factura',
                    'forSale' => 1
                        ]);

        VoucherType::create([
                    'idVoucherType' => '03',
                    'name' => 'Boleta de venta',
                    'forSale' => 1
                        ]);

        VoucherType::create([
                    'idVoucherType' => '07',
                    'name' => 'Nota de crédito',
                    'forSale' => 0
                        ]);

        VoucherType::create([
                    'idVoucherType' => '08',
                    'name' => 'Nota de débito',
                    'forSale' => 0
                        ]);
    }
}