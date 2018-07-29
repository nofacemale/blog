<?php

namespace app\admin\controller;

use app\admin\Model\Admin as adminModel;

use \think\DB;

class Index extends \think\Controller
{
	//后台首页
	public function index()

	{
		return view();
	}

	//管理员列表
	public function adminList()
	{

		$list = adminModel::paginate(3);
		$this->assign('list',$list);
		return view('lst');
	}


	//管理员登录
	public function login()

	{
		return view('login');
	}

	//添加管理员
	public function add()

	{
		if (request()->isPost())
		{
			//账号信息验证

			$validate = new \think\Validate([

				'userName' => 'require|max:25',
				'passWord' => 'require|max:32'
			]);

			

			$data = [

			'userName' => input('userName'),
			'passWord' => md5(input('passWord') . config('passWordSalt.salt'))

			];

			if(!$validate->check($data))
			{
				if(input('passWord'))
				{
					$this->error('密码不能为空，请重新注册！');

				}

				$this->error($validate->getError());
				die;
			}

			//账号信息验证END

			if(DB('admin')->where('userName',$data['userName'])->select())
			{
				$this->error('管理员已存在，请重新添加','add');
				return;
			}

			if(DB('admin')->insert($data))
			{
				$this->success('管理员添加成功','adminList');

			}else
			{
				$this->error('管理员添加失败','adminList');
			}



		}


		return view('add');


	}

	//管理员编辑
	public function edit()
	{

		$id = input('id');
		$passWord = input('passWord');
		$userName = input('userName');
		$edit = input('edit');



		if($id)
		{
			$data = DB('admin')->where('id',$id)->find();
			
			$this->assign('data',$data);
		}


		
			

		return view('edit');
	}

	//更新管理员信息
	public function editAdmin()
	{
		$id = input('id');
		$passWord = input('passWord');
		$userName = input('userName');
		$edit = input('edit');


		//$data = DB('admin')->where('id',$id)->find();
		
		if($passWord)
		{


			if(DB('admin')->where('id',$id)->update(['userName' => $userName,'passWord'=> md5($passWord . Config('passWordSalt.salt'))]))
			{
				//echo DB('admin')->table('admin')->getLastSql();die;

				$this->success('修改成功','index/adminList');
			}
			else
			{
				$this->error('密码修改失败，请重新尝试！','index/adminList');
			}

		}
		else 
		{
			// dump($id);
			// dump($userName);
			// die;
			DB('admin')->where('id',$id)->update(['userName'=>$userName]);
			
			$this->success('名称修改成功','index/adminList');
			
			

		}
				

	}

	//管理员删除
	public function adminDel()
	{
		$id = input('id');
		

		if($id)
		{
			if(DB('admin')->delete($id))
			{
				$this->success('删除成功！','index/adminList');
			}
		}
	}


}