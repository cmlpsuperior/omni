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
    
    public function autenticar(Request $request){
        $email = $request->get('email');
        $password =  $request->get('password');
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            //return redirect()->action('ClienteController@index' );
            return view ('se autentico correctamente');
        }
        
        return redirect()->action('LoginController@index' )->withInput()->withErrors ('Usuario o contraseña incorrecto');  
    }
    public function logout (){
        Auth::logout();
        return redirect()->action('LoginController@index' );  
    }
}
