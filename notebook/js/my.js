<script type="text/javascript">
// 校验用户输入的值是否是整数.  (isNaN) 0123
function checkPageNow(){
  //1.获取用户输入
  var pageNow=document.getElementById('pageNow').value;
  //alert(pageNow);

  //2.校验 isNaN如果不是数字，返回真
//  if(isNaN(pageNow)){alert('输入的跳转页有错误！'); return false;}

  //3.这里使用正则表达式处理 pageNow必须满足，要以1-9，后面的数是1-9的数字
  var reg=/^[1-9](\d)*$/;
  //reg.test(pageNow)表示使用reg这个规则，来测试一下pageNow字符串是否合法， 合法则true, 否则false
  if(pageNow!=""){
	 if(!reg.test(pageNow)){
		alert('输入的跳转页有错误！');
		//把最后的输入截掉
		document.getElementById('pageNow').value=pageNow.substring(0,pageNow.length-1);
		return false;
	 }else{
	   //格式OK
	   if(pageNow><{$pageCount}>){
		  alert('输入的值过大!');
		  //把最后的输入截掉
		document.getElementById('pageNow').value=pageNow.substring(0,pageNow.length-1);
	   }
	 }
  }else{
	 alert('不能为空');
  }
}
</script>