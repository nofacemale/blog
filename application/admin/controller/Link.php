<?php

namespace app\admin\controller;

use \think\DB;

//友情链接控制器

class Link extends \think\Controller
{
	//友情链接列表
	public function index()
	{

		$data = DB('link')->select();

		$this->assign('data',$data);


		return view();
	}

	//添加友情链接
	public function addIndex()
	{
		return view('add');
	}

	//添加友链
	public function add()
	{
		$title = input('name');
		$link = input('link');
		$desc = input('desc');

		$data = ['title'=>$title,'link'=>$link,'desc'=>$desc];

		$result = DB('link')->insert($data);

		if($result)
		{
			$this->success('添加成功！','link/index');
		}
		else
		{
			$this->error('添加失败！','link/index');
		}

	}

	//编辑页面
	public function editIndex()
	{

		$id = input('id');

		$data = DB('link')->where('id',$id)->find();

		$this->assign('data',$data);


		return view();
	}

	//删除友链
	public function del()
	{
		$id = input('id');

		if($id)
		{
			if(DB('link')->delete($id))
			{
				$this->success('删除成功！','link/index');
			}
			else
			{
				$this->error('删除失败！','link/index');
			}
		}
		else
		{
			$this->error('出错！没有友链ID','link/index');
		}
	}


}