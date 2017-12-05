<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(){
		return view('admin.admin.login');
	}
	
	public function login_check(Request $request){
		//数据验证
		$this->validate($request,[
			'username'=>'required|min:3|max:16|regex:/^[a-zA-Z1-9\x{2e80}-\x{9FFF}]*$/u',
			'password'=>'required|between:6,12',
			'captcha'=>'required|size:4|captcha',
		]);
		
		//验证 用户名/密码 
		$data = $request->only(['username', 'password']);
		$res = Auth::guard('admin')->attempt($data, $request->has('online'));
		
		if($res){
			//登陆成功，进入后台首页
			return redirect('admin/index');
		
		}else{
			//登陆失败，返回登陆页面
			return redirect('admin/login')->withErrors([
				'error'=>'用户名或密码错误',
			]);
		}
	}
	
	public function logout(){
		Auth::guard('admin')->logout();
		return redirect('admin/login');
	}
	
	
	
	
	
	
	
	
	
	
}