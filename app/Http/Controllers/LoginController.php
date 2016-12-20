<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregado:
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index (){
        
		return view('login.index');  
	}
    
    public function authenticate(Request $request){
        $name = $request->get('name');
        $password =  $request->get('password');
        if (Auth::attempt(['name' => $name, 'password' => $password])) {
            return redirect()->action('EmployeeController@index' );  
        }
        
        return redirect()->action('LoginController@index' )->withInput()->withErrors ('Usuario o contraseña incorrecto');  
    }
    public function logout (){
        Auth::logout();
        return redirect()->action('LoginController@index' );  
    }
}
