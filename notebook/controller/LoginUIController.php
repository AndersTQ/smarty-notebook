<?php
	require_once '../config/smarty_include.php';
//	require_once '../smarty_include2.php';  //完全同以上文件
/*	require_once '../../../libs/Smarty.class.php';
	$smarty=new Smarty;	// 创建smarty对象
	$smarty->left_delimiter = '<{';  
	$smarty->right_delimiter = '}>';
	// 根据实际情况 指定 模板文件夹目录
	$smarty->template_dir = '../templates';
	// 重新指定编译后的目录
	$smarty->compile_dir = '../templates_c';*/

	$smarty->display("login.html");
?>