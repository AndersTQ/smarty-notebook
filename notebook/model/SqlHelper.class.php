<?php
	//这个一个工具类,作用是完成对数据库的操作 [提供crud]
	class SqlHelper {  // smarty 12 - 14:38  24:10
		public $conn;	// best private
		public $dbname="smartytest";
		public $username="root";
		public $password="root";
		public $host="localhost";

		public function __construct(){
			$this->conn=mysql_connect($this->host,$this->username,$this->password);
			if(!$this->conn){
				die("连接失败".mysql_error());
			}
			mysql_query("set names utf8");
			mysql_select_db($this->dbname,$this->conn) or die("连接失败");
		}

		//提供同一查询函数  dql(select) dml(update,delete,insert)

		//执行dql语句 $sql select * from emp 接收一sql语句，完成功能
		public function execute_dql($sql){
			$res=mysql_query($sql,$this->conn) or die("查询失败".mysql_error());
		//	die($sql);
			return $res;
		}

		//执行dql语句，但是返回的是一个数组
		public function execute_dql2($sql){
			$arr=array();
			$res=mysql_query($sql,$this->conn) or die("查询失败".mysql_error());
			$i=0;
			//把$res=>$arr 把结果集内容转移到一个数组中.
			while($row=mysql_fetch_assoc($res)){
			//	$arr[$i++]=$row;
				$arr[]=$row;
			}
			//这里就可以马上把$res关闭.
			mysql_free_result($res);
			return $arr;
		}

		//因为分页功能是一个通用的功能,所以用一个函数来处理
		//$sqls  $sql1="select count(*) from 表名"
		//       $sql2="select * from where 表名 limit 0,6";
	//	public function exectue_dql_page($sqls,$fenyePage){
		public function exectue_dql_page($fenyePage){
			$sqls=array();
			$sqls[0]="select count(*) from ".$fenyePage->fenyeTable.$fenyePage->fenyeLimit;
			$sqls[1]="select * from ".$fenyePage->fenyeTable.$fenyePage->fenyeLimit." limit ".($fenyePage->pageNow-1)*$fenyePage->pageSize.",".$fenyePage->pageSize;

		//	"select count(*) from emp"
			$res=$this->execute_dql2($sqls[0]);
			$fenyePage->rowCount=$res[0]['count(*)'];
			$fenyePage->pageCount=ceil($res[0]['count(*)']/$fenyePage->pageSize);
		//	echo $fenyePage->pageCount;
		//	操作数据库..  echo '------'.$sqls[1];
			$fenyePage->res_array=$this->execute_dql2($sqls[1]);

		//	这里能不能把navigator处理

		//	显示上一页的超链接
			if ($fenyePage->pageNow>1){
				$pre_page=$fenyePage->pageNow-1;
				$fenyePage->navigate.="<a href='{$fenyePage->gotoUrl}?pageNow={$pre_page}{$fenyePage->condition}'>上一页</a>&nbsp;&nbsp;";
			}

			$naviSize=10;
			$start=floor(($fenyePage->pageNow-1)/$naviSize) *$naviSize+1;

			if($start>1){
				$pre_start=$start-1;
				$fenyePage->navigate.= "&nbsp;&nbsp;<a href='{$fenyePage->gotoUrl}?pageNow={$pre_start}{$fenyePage->condition}'>&nbsp;&nbsp;<<&nbsp;&nbsp;</a>";
			}

			// 显示10超链接
			for($index=$start;$start<$index+$naviSize && $start<=$fenyePage->pageCount;$start++){
				$fenyePage->navigate.= "<a href='{$fenyePage->gotoUrl}?pageNow=$start{$fenyePage->condition}'>[$start]</a>";
			}

		//	如果$pageNow是1 2 3 4 5 6 7 8 9 10  >>11
		//	if($fenyePage->pageNow<$fenyePage->pageCount && $index+$naviSize<=$fenyePage->pageCount)
			if($index+$naviSize<=$fenyePage->pageCount)
				//整体每10页翻动
				$fenyePage->navigate.= "&nbsp;&nbsp;<a href='{$fenyePage->gotoUrl}?pageNow=$start{$fenyePage->condition}'>&nbsp;&nbsp;>>&nbsp;&nbsp;</a>";

		//	显示下一页的超链接
			if ($fenyePage->pageNow<$fenyePage->pageCount){
				$next_page=$fenyePage->pageNow+1;
				$fenyePage->navigate.="<a href='{$fenyePage->gotoUrl}?pageNow={$next_page}{$fenyePage->condition}'>下一页</a>&nbsp;&nbsp;";
			}

		//	显示当前页和共有多少页
			$fenyePage->navigate.= " &nbsp;&nbsp; 当前第{$fenyePage->pageNow}页/共{$fenyePage->pageCount}页<br/>";

		//	表单
			$fenyePage->navigate.="<br/><form action='{$fenyePage->gotoUrl}' method='get' onsubmit='return checkPageNow()' />";
			$fenyePage->navigate.="跳转到:<input type='text' id='pageNow' onkeyup='return checkPageNow()' name='pageNow' />";
			$fenyePage->navigate.="<input type='submit' value='GO'></form>";
		//	echo $fenyePage->condition."-----????";
		}

		//考虑分页情况的查询,这是一个比较通用的并体现oop编程思想的代码
		//$sql1="select * from where 表名 limit 0,6";
		//$sql2="select count(id) from 表名"
		public function exectue_dql_fenye($fenyePage){
		//public function exectue_dql_fenye($gotoUrl2,$tableName,$fenyePage){	// $gotoUrl2,$tableName 以及 数据库 都应该封装到fenyePage对象中

		//	die($fenyePage->pageNow);
			if ($fenyePage->pageNow<1) $fenyePage->pageNow=1;

		//	die($fenyePage->pageSize."xxxxxxxxxx");

		//	$sql2="select count(id) from ".$tableName;
			$sql2="select count(*) from ".$fenyePage->fenyeTable.$fenyePage->fenyeLimit;

			$res2=mysql_query($sql2,$this->conn) or die(mysql_error());

			if($row=mysql_fetch_row($res2)){
			//	die($row[0].$sql2);
				$fenyePage->pageCount=ceil($row[0]/$fenyePage->pageSize);
				if ($fenyePage->pageNow>$fenyePage->pageCount) $fenyePage->pageNow=$fenyePage->pageCount;
				$fenyePage->rowCount=$row[0];
			}
			mysql_free_result($res2);

		//	$sql1="select * from ".$tableName." limit "
			$sql1="select * from ".$fenyePage->fenyeTable.$fenyePage->fenyeLimit." limit ".($fenyePage->pageNow-1)*$fenyePage->pageSize.",".$fenyePage->pageSize;

			//这里我们查询了要分页显示的数据
			$res=mysql_query($sql1,$this->conn) or die(mysql_error());
			//$res=>array()
			$arr=array();
			//把$res转移到$arr
			while($row=mysql_fetch_assoc($res)){
				$arr[]=$row;
			}
			mysql_free_result($res);

			$this->close_connect();

		//	die($fenyePage->pageNow);

		//	if ($fenyePage->pageNow>$fenyePage->pageCount) $fenyePage->pageNow=$fenyePage->pageCount;
			//把导航信息也封装到fenyePage对象中
			$navigate="<br/>";
			if ($fenyePage->pageNow>1){
				$prePage=$fenyePage->pageNow-1;
				$navigate.="<a href='{$fenyePage->gotoUrl}?pageNow=$prePage'>上一页</a>&nbsp;";
			}

			if(empty($pageNow)) $pageNow=$fenyePage->pageNow;
			if(empty($pageCount)) $pageCount=ceil($fenyePage->pageCount);
			$page_whole=10;
			$start=floor(($pageNow-1)/$page_whole)*$page_whole+1;
			$index=$start;
		/*	if($pageNow<1) header("Location: {$fenyePage->gotoUrl}?pageNow=$pageCount");
			if($pageNow>$pageCount) header("Location: {$fenyePage->gotoUrl}?pageNow=$pageCount");;	*/
			
			//整体每10页向前翻
			//如果当前pageNow在1-10页数，就没有向前翻动的超连接
		//	if($pageNow>$page_whole){
			if($index>$page_whole){
				$navigate.= "&nbsp;&nbsp;<a href='{$fenyePage->gotoUrl}?pageNow=".($start-1)."'>&nbsp;&nbsp;<<&nbsp;&nbsp;</a>";
			}
			//定$start 1---》10  floor((pageNow-1)/10)=0*10+1   11->20   floor((pageNow-1)/10)=1*10+1 21-30 floor((pageNow-1)/10)=2*10+1
			if($pageNow+$page_whole-1<=$pageCount)		$max_page=$index+$page_whole; 
			else{
				$max_page= $pageCount+1;
			//	die($max_page);
				if($max_page>$start+$page_whole) $max_page=$index+$page_whole;
			}
			for(;$start<$max_page;$start++){
				$navigate.= "<a href='{$fenyePage->gotoUrl}?pageNow=$start'>[$start]</a>";
			}

		//	if($pageNow<=floor($pageCount/$page_whole)*$page_whole )
			if($index+$page_whole<=$pageCount)
				//整体每10页翻动
				$navigate.= "&nbsp;&nbsp;<a href='{$fenyePage->gotoUrl}?pageNow=$start'>&nbsp;&nbsp;>>&nbsp;&nbsp;</a>";

			if($fenyePage->pageNow<$fenyePage->pageCount){
				$nextPage=$fenyePage->pageNow+1;
				$navigate.="<a href='{$fenyePage->gotoUrl}?pageNow=$nextPage'>下一页</a>&nbsp;";
			}

			//显示当前页和共有多少页
			$navigate.=" &nbsp;&nbsp; 当前第{$pageNow}页/共{$pageCount}页<br/>";

			$navigate.="<br/><form action='{$fenyePage->gotoUrl}' method='get' onsubmit='return checkPageNow()' />";
			$navigate.="跳转到:<input type='text' id='pageNow' onkeyup='return checkPageNow()' name='pageNow' />";
			$navigate.="<input type='submit' value='GO'></form>";

			//把$arr赋给$fenyePage
			$fenyePage->res_array=$arr;
			$fenyePage->navigate=$navigate;
		}

		//执行dml(update delete insert)语句
		public function execute_dml($sql){
			$b=mysql_query($sql,$this->conn) or die("dml语句失败".mysql_error());
			if(!$b){
				return 0; //0表示失败
			}else{
				if(mysql_affected_rows($this->conn)>0){
					return 1;//表示执行ok
				}else{
					return 2;//表示没有行受到影响
				}
			}
		}

		//可以批量执行sql //prepared,批量执行
		public function execute_dml3($sqls){
			for($i=0;$i<count($sqls);$i++) $this->execute_dql($sqls[$i]);
		}

		//关闭连接的方法
		public function close_connect(){
			if(!empty($this->conn)){
				mysql_close($this->conn);
			}
		}
	}
?>