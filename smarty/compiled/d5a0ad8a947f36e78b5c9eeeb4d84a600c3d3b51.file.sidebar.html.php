<?php /* Smarty version Smarty-3.1.17, created on 2016-09-05 21:02:04
         compiled from "application/views/private/base-layout/sidebar.html" */ ?>
<?php /*%%SmartyHeaderCode:36644969557720c1bb0aaa1-97212896%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd5a0ad8a947f36e78b5c9eeeb4d84a600c3d3b51' => 
    array (
      0 => 'application/views/private/base-layout/sidebar.html',
      1 => 1472809882,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '36644969557720c1bb0aaa1-97212896',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_57720c1bb698f6_47423759',
  'variables' => 
  array (
    'baseurl' => 1,
    'user_account' => 1,
    'site_navigation_menu_private' => 1,
    'site_sub_navigation' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57720c1bb698f6_47423759')) {function content_57720c1bb698f6_47423759($_smarty_tpl) {?><!-- sidebar: style can be found in sidebar.less --><section class="sidebar">    <!-- Sidebar user panel -->  <div class="user-panel">    <div class="image clearfix" style="text-align:center">      <img src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
doc/images/logo.png" style="width:65px; border:none;"  alt="User Image" />    </div>    <div class="pull-left info">      <p>User : <?php echo $_smarty_tpl->tpl_vars['user_account']->value['admin_name'];?>
      </p>      <?php if ($_smarty_tpl->tpl_vars['user_account']->value['id_auth']=='5') {?>      <p><?php echo $_smarty_tpl->tpl_vars['user_account']->value['nama_museum'];?>
      </p>      <?php }?>    </div>  </div>  <!-- sidebar menu: : style can be found in sidebar.less -->  <ul class="sidebar-menu">    <?php echo $_smarty_tpl->tpl_vars['site_navigation_menu_private']->value;?>
  </ul>  </section><!-- /.sidebar --><!--<div class="side-menu"><h3>Sub Menu</h3><?php echo $_smarty_tpl->tpl_vars['site_sub_navigation']->value;?>
</div>--><?php }} ?>
