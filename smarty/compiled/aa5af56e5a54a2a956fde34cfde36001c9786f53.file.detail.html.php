<?php /* Smarty version Smarty-3.1.17, created on 2016-09-05 21:54:58
         compiled from "application/views/web/profil/detail.html" */ ?>
<?php /*%%SmartyHeaderCode:119916941457720fe61f3b31-16605534%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa5af56e5a54a2a956fde34cfde36001c9786f53' => 
    array (
      0 => 'application/views/web/profil/detail.html',
      1 => 1472809882,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '119916941457720fe61f3b31-16605534',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_57720fe628ebc8_67669062',
  'variables' => 
  array (
    'data' => 0,
    'page_modul' => 0,
    'profil_list' => 0,
    'rs' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57720fe628ebc8_67669062')) {function content_57720fe628ebc8_67669062($_smarty_tpl) {?><div class="col-md-9">  <!--start detail desc-->  <div class="b-article-box">    <div class="f-article_title f-primary-l b-title-b-hr">      <?php echo $_smarty_tpl->tpl_vars['data']->value['judul'];?>
    </div>    <div class="b-article__description">      <?php echo $_smarty_tpl->tpl_vars['data']->value['content'];?>
    </div>  </div>  <div class="b-article-box">    <div class="f-article_title f-primary-l b-title-b-hr"> <?php echo mb_strtoupper($_smarty_tpl->tpl_vars['page_modul']->value, 'UTF-8');?>
     </div>    <?php if ($_smarty_tpl->tpl_vars['profil_list']->value!='') {?>    <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['profil_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>    <div class="b-twitter-feeds__item b-tabs__content-list-item" style="margin-top:20px;">      <div class="b-twitter-feeds__item_name f-twitter-feeds__item_name f-primary-b">        <i class="fa fa-angle-double-right">        </i>         <a href="<?php echo $_smarty_tpl->tpl_vars['rs']->value['url_detail'];?>
"><?php echo $_smarty_tpl->tpl_vars['rs']->value['judul'];?>
        </a>       </div>    </div>    <?php } ?>    <?php }?>   </div>  <!--end detail --></div><!--end col 9--><?php }} ?>
