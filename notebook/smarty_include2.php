<?php  //���µ�ַ����ļ�λ���޹أ�ֻ�����������ļ�λ���й�	
	require_once '../../../libs/Smarty.class.php';
	$smarty=new Smarty;	// ����smarty����
	$smarty->left_delimiter = '<{';  
	$smarty->right_delimiter = '}>';
	// ����ʵ����� ָ�� ģ���ļ���Ŀ¼
	$smarty->template_dir = '../templates';
	// ����ָ��������Ŀ¼
	$smarty->compile_dir = '../templates_c';

	// below for text.php
	/* Warning: require_once(../../../libs/Smarty.class.php) [function.require-once]: failed to open stream: No such file or directory in D:\myenv\apache\htdocs\smarty\Code\notebook\config\smarty_include.php on line 2

	Fatal error: require_once() [function.require]: Failed opening required '../../../libs/Smarty.class.php' (include_path='.;C:\php\pear') in D:\myenv\apache\htdocs\smarty\Code\notebook\config\smarty_include.php on line 2
	require_once '../../../libs/Smarty.class.php';
	$smarty=new Smarty;	// ����smarty����
	$smarty->left_delimiter = '<{';  
	$smarty->right_delimiter = '}>';
	// ����ʵ����� ָ�� ģ���ļ���Ŀ¼
	$smarty->template_dir = './templates';
	// ����ָ��������Ŀ¼
	$smarty->compile_dir = './templates_c';  */	
?>