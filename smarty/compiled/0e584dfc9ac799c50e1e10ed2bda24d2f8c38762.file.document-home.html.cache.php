<?php /* Smarty version Smarty-3.1.17, created on 2016-09-23 09:22:09
         compiled from "application\views\web\base-layout\document-home.html" */ ?>
<?php /*%%SmartyHeaderCode:2617657888d570c68f0-28104633%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0e584dfc9ac799c50e1e10ed2bda24d2f8c38762' => 
    array (
      0 => 'application\\views\\web\\base-layout\\document-home.html',
      1 => 1474442830,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2617657888d570c68f0-28104633',
  'function' => 
  array (
  ),
  'cache_lifetime' => 3600,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_57d77d57802cf4_77894363',
  'variables' => 
  array (
    'act_lang' => 0,
    'BASEURL' => 0,
    'THEMESPATH' => 0,
    'LOADSTYLE' => 0,
    'LOADJS' => 0,
  ),
  'has_nocache_code' => true,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57d77d57802cf4_77894363')) {function content_57d77d57802cf4_77894363($_smarty_tpl) {?><!DOCTYPE html><html>  <head>    <meta charset="utf-8">    <title>    <?php if ($_smarty_tpl->tpl_vars['act_lang']->value=='en') {?>    The center of Information and coordination of Industry Perkelapasawitan Indonesia    <?php } else { ?>      Pusat Informasi dan Koordinasi Industri Perkelapasawitan Indonesia    <?php }?>        </title>    <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
doc/favicon.ico">    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['THEMESPATH']->value;?>
" />    <?php echo $_smarty_tpl->tpl_vars['LOADSTYLE']->value;?>
  </head>  <body>    <div class="mask-l" style="background-color: #fff; width: 100%; height: 100%; position: fixed; top: 0; left:0; z-index: 9999999;">    </div>     <!--removed by integration-->    <?php echo $_smarty_tpl->getSubTemplate ("web/base-layout/sound.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate ("web/base-layout/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>
    <div class="j-menu-container">    </div>    <div class="l-main-container" >      <?php echo $_smarty_tpl->getSubTemplate ("web/base-layout/slider.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>
        <?php echo '/*%%SmartyNocache:2617657888d570c68f0-28104633%%*/<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars[\'template_content\']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
/*/%%SmartyNocache:2617657888d570c68f0-28104633%%*/';?>
     </div>       <?php echo $_smarty_tpl->getSubTemplate ("web/base-layout/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>
    <!-- javascript loaded -->    <?php echo $_smarty_tpl->tpl_vars['LOADJS']->value;?>
    <!-- end of loaded javascript -->  </body></html><?php }} ?>
