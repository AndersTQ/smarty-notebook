<?php /* Smarty version 2.6.18, created on 2015-11-24 02:15:51
         compiled from messageList.html */ ?>
<html>
  <head>
 <!-- <script type="text/javascript" src='/js/my.js'> </script> -->
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../js/my.js", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title> 信息列表界面 </title>
  </head>
  <a href="#"><font size="7" color="blue">发布信息</font></a>
  <a href="#"><font size="7" color="blue">退出系统</font></a>
  <table>
    <tr><td>ID</td><td>发送人</td><td>发送时间</td><td>接收人</td><td>内容</td></tr>
	<?php $_from = $this->_tpl_vars['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mess']):
?>
	  <tr><td><?php echo $this->_tpl_vars['mess']['message_id']; ?>
</td><td><?php echo $this->_tpl_vars['mess']['sender']; ?>
</td><td><?php echo $this->_tpl_vars['mess']['sendtime']; ?>
</td><td><?php echo $this->_tpl_vars['mess']['getter']; ?>
</td><td><?php echo $this->_tpl_vars['mess']['content']; ?>
</td></tr>
	<?php endforeach; endif; unset($_from); ?>
  </table>
  <?php echo $this->_tpl_vars['navigator']; ?>

</html>