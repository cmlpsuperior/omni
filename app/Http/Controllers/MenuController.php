<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses;:
use App\BillType;

class MenuController extends Controller
{
    public function sale(){
    	$billTypes = BillType::orderBy('idBillType', 'asc')->get();
    	return view ( 'menu.sale', [ 'billTypes'=>$billTypes ] ); 
    }
}
