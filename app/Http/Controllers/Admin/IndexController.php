<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
	public function index(){
//		echo date('Y-m-d H:i:s');
//		die;
		
		return view('admin.index.index');
	}
	public function welcome(){
		return view('admin.index.welcome');
	}
 
	
	
	
}