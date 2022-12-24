<?php  //以下地址与此文件位置无关，只与引用它的文件位置有关	
	require_once '../../../libs/Smarty.class.php';
	$smarty=new Smarty;	// 创建smarty对象
	$smarty->left_delimiter = '<{';  
	$smarty->right_delimiter = '}>';
	// 根据实际情况 指定 模板文件夹目录
	$smarty->template_dir = '../templates';
	// 重新指定编译后的目录
	$smarty->compile_dir = '../templates_c';

	// below for text.php
	/* Warning: require_once(../../../libs/Smarty.class.php) [function.require-once]: failed to open stream: No such file or directory in D:\myenv\apache\htdocs\smarty\Code\notebook\config\smarty_include.php on line 2

	Fatal error: require_once() [function.require]: Failed opening required '../../../libs/Smarty.class.php' (include_path='.;C:\php\pear') in D:\myenv\apache\htdocs\smarty\Code\notebook\config\smarty_include.php on line 2
	require_once '../../../libs/Smarty.class.php';
	$smarty=new Smarty;	// 创建smarty对象
	$smarty->left_delimiter = '<{';  
	$smarty->right_delimiter = '}>';
	// 根据实际情况 指定 模板文件夹目录
	$smarty->template_dir = './templates';
	// 重新指定编译后的目录
	$smarty->compile_dir = './templates_c';  */	
?>