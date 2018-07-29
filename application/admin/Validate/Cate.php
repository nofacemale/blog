<?php

namespace app\admin\Validate;

use think\Validate;
class Cate extends Validate
{


	protected $rule = [
		'cateName' => 'require|max:25| unique',
	];

	protected $message = [

		'cateName.require' => '栏目名称必须填写！',
		'cateName.unique' => '重复栏目名称！'


	];

	protected $scene = [
		'add' => ['cateName' => 'require|unique:cate']
	];
	


}