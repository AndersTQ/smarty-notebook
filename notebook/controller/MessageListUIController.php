<?php	// 专门处理分页信息查询的控制器
	require_once '../config/smarty_include.php';
	require_once '../model/MessageModel.class.php';
	require_once '../model/FenyePage.class.php';

	$fenyePage=new FenyePage();
	if(isset($_GET['pageNow'])) 	$fenyePage->pageNow=$_GET['pageNow'];
	$fenyePage->pageSize=2;
	$fenyePage->fenyeTable="message";
//	$fenyePage->gotoUrl="MessageListUIController.php";
	session_start();
	$loginname=$_SESSION['loginname'];
	$fenyePage->fenyeLimit=" where getter='".$loginname."'";

	// 直接用模板显示
	// 直接调用MessageModel.class.php方法(包含分页)
	$messageModel=new MessageModel();	
	$messageModel->showMessageByPage($fenyePage);
	// 把新的分页信息再次分配给模板
	$smarty->assign("arr",$fenyePage->res_array);
	//分配导航条
	$smarty->assign("navigator",$fenyePage->navigate);
//	echo $fenyePage->navigate;	exit();
	$smarty->assign("pageCount",$fenyePage->pageCount);

	$smarty->display("messageList.html");
?>