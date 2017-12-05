<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Goods;
use App\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class GoodsController extends Controller
{
	//商品列表
    public function index(){
    	//取出商品数据
    	$data =  Goods::with('category')->get();
    	//使用with('category')表示把所属的栏目名称一块取出来。
    	return view('admin.goods.index',compact('data'));
    }
    //添加商品的
    public function add(Request $request){
    	if($request->isMethod('get')){
    			//展示添加商品的表单
    			//取出栏目数据
    			//$category = Category::pluck($value,$key);
    			//组建成一个例如[$key1=>$value1,'$key2'=>$value2]样式的一维数组
    			$category = Category::pluck('cat_name','id');
    			return  view('admin.goods.add',compact('category'));
    	}else if($request->isMethod('post')){
    		//完成添加商品的操作
    		//定义一个验证规则
    		$rules = [
    			'goods_name'=>'required|unique:goods,goods_name',
    			'cat_id'=>'required|integer',
    			'goods_price'=>'required'
    		];
    		//定义一个数组用于显示未通过验证时的错误提示
    		$msgs = [
    			'goods_name.required'=>'商品名称不能为空',
    			'goods_name.unique'=>'商品名称已经存在',
    			'goods_price.required'=>'商品价格不能为空',
    			'cat_id.required'=>'栏目不能为空'
    		];

    		//使用Validator类来完成验证
    		//语法：Validator::make(验证的数据,验证规则,错误提示);
    		$validator = Validator::make($request->all(),$rules,$msgs);//返回一个对象
    		if($validator->passes()){
    			//通过验证了，完成入库操作
    			$res = Goods::create($request->all());
    			if($res){
    				//添加成功
    				return redirect('admin/goods/index');
    			}else {
    				//添加失败
    				//return redirect('admin/goods/add');
    				return back()->withErrors(['error'=>'添加失败']);
    				//使用withErrors把错误信息，添加到$errors对象里面了
    			}
    		}else {
    			//未通过验证
    			return back()->withErrors($validator);
    		}
    	}
    }
    //完成文件上传的
    public function upimg(){
    	//接收上传的文件
    	$file = Input::file('Filedata'); 
    	if($file->isValid()){
    		//表示上传成功
    		//获取上传文件的后缀
    		$ext = $file->getClientOriginalExtension();
    		$filename = date('Y-m-d-H-i-s').'.'.$ext;
    		$file->move('./uploads/',$filename);
    		//返回上传文件保存的路径
    		return '/uploads/'.$filename;
    	}
    }
 
	
	//商品修改
	public function update(Request $request,Goods $goods){
		 //$goods 事被修改的数据对象
		 if($request->isMethod('get')){
			 //展示 被修改的表单
			 $category = Category::pluck('cat_name','id');
			 return view('admin.goods.update', compact('goods', 'category'));
		 }else if($request->isMethod('post')){
			 //完成 修改操作
			 
			 //定义一个验证规则
    		$rules = [
    			'goods_name'=>'required|unique:goods,goods_name,'.$goods->id,
    			'cat_id'=>'required|integer',
    			'goods_price'=>'required'
    		];
    		//定义一个数组用于显示未通过验证时的错误提示
    		$msgs = [
    			'goods_name.required'=>'商品名称不能为空',
    			'goods_name.unique'=>'商品名称已经存在',
    			'goods_price.required'=>'商品价格不能为空',
    			'cat_id.required'=>'栏目不能为空'
    		];

    		//使用Validator类来完成验证
    		//语法：Validator::make(验证的数据,验证规则,错误提示);
    		$validator = Validator::make($request->all(),$rules,$msgs);//返回一个对象
    		
			if($validator->passes()){
				//验证通过
				$res = $goods->update($request->all());
				if($res){
					return redirect('admin/goods/index');
				}else{
					return back()->withErrors(['error'=>'修改失败']);
				}
			}else{
				//验证未通过
				return back()->withErrors($validator);
			}
			 
		 }
	}
	
	//删除商品
	public function del(Request $request){
		//接受post提交的数据
		$id = $request->input('id');
		$res = Goods::where('id',$id)->delete();
		if($res){
			return ['info'=>1]; //返回1 删除成功
		}else{
			return ['info'=>0]; //返回0 删除失败
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
