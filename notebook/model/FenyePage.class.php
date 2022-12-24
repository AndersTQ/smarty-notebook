<?php
	
	//这是一个用于保存分页信息的类
	class FenyePage{
		public $pageSize=10;	//public $pageSize;  error always
		public $res_array;  //显示数据 查询后获取的结果集(二维数组)
		public $rowCount;   //这是从数据库中获取
		public $pageNow=1;  //用户指定的
		public $pageCount;  //这个是计算得到的
		public $navigate;   //分页导航
		public $fenyeDb="d1";
		public $fenyeTable="t1";
		public $fenyeLimit;	//数据查询条件
		public $gotoUrl;	//表示把分页请求提交给哪个页面
		var $condition="";

		public function getPageSize(){ return $this->pageSize; }
		public function setPageSize($pageSize){$this->pageSize = $pageSize; }

		public function getRes_array(){ return $this->res_array; }
		public function setRes_array($res_array){$this->res_array = $res_array; }

		public function getRowCount(){ return $this->rowCount; }
		public function setRowCount($rowCount){$this->rowCount = $rowCount; }

		public function getPageNow(){ return $this->pageNow; }
		public function setPageNow($pageNow){$this->pageNow = $pageNow; }

		public function getPageCount(){ return $this->pageCount; }
		public function setPageCount($pageCount){$this->pageCount = $pageCount; }

		public function getNavigate(){ return $this->navigate; }
		public function setNavigate($navigate){$this->navigate = $navigate; }

		public function getFenyeDb(){ return $this->fenyeDb; }
		public function setFenyeDb($fenyeDb){ $this->fenyeDb=$fenyeDb; }

		public function getFenyeTable(){ return $this->fenyeTable;}
		public function setFenyeTable($fenyeTable){ $this->fenyeTable = $fenyeTable; }

		public function getFenyeLimit(){ return $this->fenyeLimit;}
		public function setFenyeLimit($fenyeLimit){ $this->fenyeLimit = $fenyeLimit; }

		public function getGotoUrl(){ return $this->gotoUrl; }
		public function setGotoUrl($gotoUrl){$this->gotoUrl = $gotoUrl; }

		public function getCondition(){ return $this->condition; }
		public function setCondition($condition){$this->condition = $condition; }
	}
?>