<?php

namespace app\admin\Validate;

use think\Validate;
class Admin extends Validate
{


	protected $rule = [
		'userName' => 'require|max:25',
		'passWord' => 'require|max:32',
	];

	protected $message = [

		'userName.require' => '账户名称必须填写！'
		'userName.max' => '名称不得大于25位！'
		'passWord.require' => '密码不能为空！'

	];

	protected $scene = [
		'add' => 'userName|max'
	];
	


}