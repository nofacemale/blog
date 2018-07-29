<?php

namespace app\admin\controller;

use \think\DB;

//友情链接控制器

class Cate extends \think\Controller
{
	public function index()
	{
		$data = DB('cate')->select();

		//dump($data);die;

		$this->assign('data',$data);
		return view();
	}
	//添加页面
	public function addIndex()
	{
		return view('add');
	}

	//添加栏目
	public function add()
	{
		$cateName = input('cateName');

		if(DB('cate')->where('cateName',$cateName)->find())
		{
			$this->error("栏目存在！",'cate/index');
			return;
		}

		$data = ['cateName' => $cateName];

		if($cateName)
		{
			if(DB('cate')->insert(['cateName' => $cateName]))
			{
				$this->success('添加成功！','cate/index');
			}
			else
			{
				$this->error('添加失败！','cate/index');
			}
		}
	}

	//删除栏目
	public function del()
	{
		$id = input('id');

		if($id)
		{
			if(DB('cate')->delete($id))
			{
				$this->success('删除栏目成功！','cate/index');
			}
			else
			{
				$this->error('删除栏目失败！','cate/index');
			}

		}
	}

	//编辑栏目页面
	public function editIndex()
	{
		$id = input('id');

		if($id)
		{
			$data = DB('cate')->where('id',$id)->find();
			$this->assign('data',$data);
		}

		return view();
	}

	//编辑处理
	public function edit()
	{
		$cateName = input('cateName');
		$id = input('id');
		//查询传递过来的栏目名称
		$data = DB('cate')->where('id',$id)->find();

		if($cateName != $data['cateName'])
		{
			//判断传递栏目是否存在
			if(DB('cate')->where('cateName',$cateName)->find())
			{
				$this->error('当前栏目已存在','cate/index');
			}
			
			if(DB('cate')->where('id',$id)->update(['cateName'=>$cateName]))
			{
				$this->success('保存成功！','cate/index');
			}
			else
			{
				$this->error('保存失败！','cate/index');
			}

		}
		else
		{
			$this->success('未更改栏目名称','cate/index');
		}
	}


	


}