<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses;:
use App\BillType;

class MenuController extends Controller
{
    public function dashBoard (){
    	return view ('menu.dashBoard');
    }

    public function shop (){
    	return view ('menu.shop');
    }
}
