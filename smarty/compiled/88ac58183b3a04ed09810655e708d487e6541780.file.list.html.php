<?php /* Smarty version Smarty-3.1.17, created on 2016-08-17 21:40:12
         compiled from "application/views/web/program/list.html" */ ?>
<?php /*%%SmartyHeaderCode:6002292075773404aaf5cf7-08737790%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88ac58183b3a04ed09810655e708d487e6541780' => 
    array (
      0 => 'application/views/web/program/list.html',
      1 => 1471344820,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6002292075773404aaf5cf7-08737790',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5773404ab96059_26534860',
  'variables' => 
  array (
    'program_list' => 0,
    'rs' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5773404ab96059_26534860')) {function content_5773404ab96059_26534860($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['program_list']->value!='') {?>
    <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['program_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
 <section class="b-portfolio-slider-box">
        <div class="f-carousel-secondary b-portfolio__example-box f-some-examples-tertiary b-carousel-reset b-carousel-arr-square b-carousel-arr-square--big f-carousel-arr-square">
            <div class="b-carousel-title f-carousel-title f-carousel-title__color f-primary-b b-diagonal-line-bg-light">
               Program : <?php echo $_smarty_tpl->tpl_vars['rs']->value['judul_program'];?>
  <span class="b-blog-one-column__info_delimiter"></span>
               <strong> Tanggal Dibuat: <?php echo $_smarty_tpl->tpl_vars['rs']->value['tanggal'];?>
 </strong>
               <br/>
            </div>
         
           <br/>
           <div class="col-md-9">
            <div class="b-portfolio-slider-box__items">
                <div class="b-slider-images j-slider-images">
                    <img class=""  data-retina="" src="<?php echo $_smarty_tpl->tpl_vars['rs']->value['image'];?>
" alt="">
                    
                </div>
            </div>
           </div>
        </div>
    </section>
<?php } ?>
<?php }?><?php }} ?>
