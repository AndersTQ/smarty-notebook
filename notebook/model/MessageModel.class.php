<?php
require_once 'SqlHelper.class.php';
//require_once 'FenyePage.class.php';

class MessageModel{
	public function showMessage($loginname){		
		$sql="select * from message where getter='$loginname'";
		$sqlHelper=new SqlHelper;
		$arr=$sqlHelper->execute_dql2($sql);
		$sqlHelper->close_connect();
		return $arr;
	}

	//根据pageNow来获取对应信息
//	public function showMessageByPage($fenyePage,$loginname){
	public function showMessageByPage($fenyePage){
	//	$sqls[0]="select count(*) from message where getter='$loginname'";
	//	$sqls[1]="select * from message where getter='$loginname' limit ".($fenyePage->$pageNow-1)*$fenyePage->$pageSize.",".$fenyePage->$pageSize;
		$sqlHelper=new SqlHelper;
	//	$arr=$sqlHelper->exectue_dql_fenye($fenyePage);
		$arr=$sqlHelper->exectue_dql_page($fenyePage);
	}
}
?>
<!--
--创建一个数据库    Table 'empmanage.message' doesn't exist
create database smartytest;
use smartytest;
create table admin_emp(
  emp_id int unsigned primary key auto_increment,
  emp_name varchar(64) unique not null default '',
  emp_pwd char(32) not null -- char is faster than varchar
);

create table message(
  message_id int unsigned primary key auto_increment,
  sender varchar(64) not null,
  getter varchar(64) not null,
  sendtime datetime not null,
  content varchar(2000) not null
);

--测试数据
set names gbk;
--set character_set_client=gbk;
--set character_set_results=gbk;
insert into message (sender,getter,sendtime,content) values('周星驰','张三丰',now(),'吃了吗？');
insert into message (sender,getter,sendtime,content) values('林青霞','张三丰',now(),'吃饱了');
insert into message (sender,getter,sendtime,content) values('林青霞','张三丰',now(),'hello3');
insert into message (sender,getter,sendtime,content) values('周星驰','123',now(),'吃了吗？');
select * from message;
desc message;
set character_set_client=utf8;
set character_set_results=utf8;
-->