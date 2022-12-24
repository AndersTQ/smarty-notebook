<?php
	require_once '../config/smarty_include.php';
	require_once '../model/MessageModel.class.php';
	require_once '../model/FenyePage.class.php';
	$emp_name=$_POST['emp_name'];
	$emp_pwd=@$_POST['emp_pwd'];
//	echo $emp_name.' --- '.$emp_pwd;

//  到数据库去验证	
	if($emp_name=="张三丰" && $emp_pwd=="1"){
		//把登录人的名字(对象),存放到session
		session_start();
		$_SESSION['loginname']=$emp_name;
		// 直接用模板显示
		// 直接调用MessageModel.class.php方法(包含分页)
		$messageModel=new MessageModel();
	//	echo "<pre>";
	//	print_r($messageModel->showMessage($emp_name));
	//	echo "</pre>";
	//	$smarty->assign("arr",$messageModel->showMessage($emp_name));

		$fenyePage=new FenyePage();
		$fenyePage->pageNow=1;
		$fenyePage->pageSize=3;
		$fenyePage->fenyeTable="message";
		$fenyePage->gotoUrl="MessageListUIController.php";
		$fenyePage->fenyeLimit=" where getter='".$emp_name."'";

		// note: php中对象是引用传递
		$messageModel->showMessageByPage($fenyePage);
	/*	echo "<pre>";
		print_r($fenyePage->res_array);
		echo "</pre>";	*/
		//	需要把分页获取的信息分配给messageList.html模板
		$smarty->assign("arr",$fenyePage->res_array);
		//分配导航条
		$smarty->assign("navigator",$fenyePage->navigate);
	//	echo $fenyePage->navigate;	exit();
		$smarty->assign("pageCount",$fenyePage->pageCount);
	
		$smarty->display("messageList.html");
	}else{
	
	}
?>