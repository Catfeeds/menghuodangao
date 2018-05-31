<?php 

return [
	'required'     => '请填写:attribute',
	'email'        => '必须是有效的电子邮件地址',
	'unique'       => '已经存在',
	'min'       => [
		'string'=>':attribute至少:min个字符',
	],
	'captcha'=>'验证码错误',
	'custom'       => [
	// 'name'      =>[
	// 	'required' => '请填写:attribute',
	// ],
	],
	'attributes'   =>[
		'email'        =>"邮箱",
	],
];
