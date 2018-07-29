<?php

namespace app\admin\controller;

use \think\DB;

//文章控制器

class Article extends \think\Controller
{

	//文章列表
	public function index()
	{
		return view();
	}
	//添加文章
	public function add()
	{

		if(request()->isPost())
		{
			$data = [
				'title' => input('title'),
				'author' => input('author'),
				'desc' => input('desc'),
				'keyWords' => input('keyWords'),
				'content' => input('content'),
				'pic' => input('pic'),
				'cateId' => input('cateId'),
				'state' => input('state'),
			];

			dump($_POST);die;
		}

		$data = DB('cate')->select();
		$this->assign('data',$data);
		//dump($data);die;

		return view();
	}

	


	


}