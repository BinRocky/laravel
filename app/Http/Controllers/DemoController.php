<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Requests;
use Cache;
use DB;
use Session;

class DemoController extends Controller
{
	public function demo(){
		
		echo 3|4;
		
		die;
		
		$a = collect([1, 2, 3, 4, 5])->implode('-');
		var_dump($a);die;
		
		
		
		// $a = env('DB_DATABASE');
		// $a = config('filesystems.disks.s3.secret');
		// echo $a; 
		
		// DB::connection()->enableQueryLog(); //开启sql语句日志记录
		$data = DB::table('goods')->where('id',1)->get();
		// $query = DB::getQueryLog(); //获取执行的sql语句
		print_r($data);
	}
	
    public function setsession(){
		Session::put('name','王八');
		Session::put('age','15');
	}
	
	public function getsession(){
		$name = Session::get('name','22');
		$age = Session::get('age','55');
		$data = Session::all();
		dd($data);
	}
	
	public function delsession(){
		Session::forget('age');
	}
	
	
	
	
	
	
	
	
}
