<?php /* Smarty version Smarty-3.1.17, created on 2016-09-05 21:01:30
         compiled from "application/views/web/base-layout/footer.html" */ ?>
<?php /*%%SmartyHeaderCode:136685302057720c28d93375-61640287%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '77a1eda6cc84734346ce9ac641b1f771621654b2' => 
    array (
      0 => 'application/views/web/base-layout/footer.html',
      1 => 1472836434,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '136685302057720c28d93375-61640287',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_57720c28ddc300_75679551',
  'variables' => 
  array (
    'homeurl' => 0,
    'url_menu_profil' => 0,
    'act_lang' => 0,
    'url_menu_kontak' => 0,
    'BASEURL' => 0,
    'datasosmed' => 1,
    'rs' => 1,
    'asosiasifooter' => 1,
    'kontakinfo' => 1,
  ),
  'has_nocache_code' => true,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57720c28ddc300_75679551')) {function content_57720c28ddc300_75679551($_smarty_tpl) {?><footer>  <div class="b-footer-primary">    <div class="container">      <div class="row">        <div class="col-sm-8 col-xs-12 f-copyright b-copyright">Copyright © 2016 - Dewan Minyak Sawit Indonesia (DMSI)        </div>        <div class="col-sm-4 col-xs-12">          <div class="b-btn f-btn b-btn-default b-right b-footer__btn_up f-footer__btn_up j-footer__btn_up">            <i class="fa fa-chevron-up">            </i>          </div>          <nav class="b-bottom-nav f-bottom-nav b-right hidden-xs">            <ul>              <li class="is-active-bottom-nav">                <a href="<?php echo $_smarty_tpl->tpl_vars['homeurl']->value;?>
">Home                </a>              </li>              <li>                <a href="<?php echo $_smarty_tpl->tpl_vars['url_menu_profil']->value;?>
">                  <?php if ($_smarty_tpl->tpl_vars['act_lang']->value=='en') {?>                  About Us                  <?php } else { ?>                  Tentang kami                  <?php }?>                </a>              </li>              <li>                <a href="<?php echo $_smarty_tpl->tpl_vars['url_menu_kontak']->value;?>
">                  <?php if ($_smarty_tpl->tpl_vars['act_lang']->value=='en') {?>                  Contact Us                  <?php } else { ?>                  Kontak Kami                  <?php }?>                </a>              </li>            </ul>          </nav>        </div>      </div>    </div>  </div>  <div class="container">    <div class="b-footer-secondary row">      <div class="col-md-3 col-sm-12 col-xs-12 f-center b-footer-logo-containter">        <a href="">          <img data-retina class="b-footer-logo color-theme" src="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
themes/default/img/logo_dmsi_besar.png" alt="Logo"/>        </a>        <div class="b-footer-logo-text f-footer-logo-text">          <p>DMSI            <br />Dewan Minyak Sawit Indonesia          </p>          <div class="b-btn-group-hor f-btn-group-hor">                        <?php echo '/*%%SmartyNocache:136685302057720c28d93375-61640287%%*/<?php if ($_smarty_tpl->tpl_vars[\'datasosmed\']->value!=\'\') {?>/*/%%SmartyNocache:136685302057720c28d93375-61640287%%*/';?>
            <?php echo '/*%%SmartyNocache:136685302057720c28d93375-61640287%%*/<?php  $_smarty_tpl->tpl_vars[\'rs\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'rs\']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars[\'datasosmed\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'rs\']->key => $_smarty_tpl->tpl_vars[\'rs\']->value) {
$_smarty_tpl->tpl_vars[\'rs\']->_loop = true;
?>/*/%%SmartyNocache:136685302057720c28d93375-61640287%%*/';?>
            <a href="<?php echo '/*%%SmartyNocache:136685302057720c28d93375-61640287%%*/<?php echo $_smarty_tpl->tpl_vars[\'rs\']->value[\'link\'];?>
/*/%%SmartyNocache:136685302057720c28d93375-61640287%%*/';?>
" target="_blank" class="b-btn-group-hor__item f-btn-group-hor__item">              <i class="<?php echo '/*%%SmartyNocache:136685302057720c28d93375-61640287%%*/<?php echo $_smarty_tpl->tpl_vars[\'rs\']->value[\'logo\'];?>
/*/%%SmartyNocache:136685302057720c28d93375-61640287%%*/';?>
">              </i>            </a>            <?php echo '/*%%SmartyNocache:136685302057720c28d93375-61640287%%*/<?php } ?>/*/%%SmartyNocache:136685302057720c28d93375-61640287%%*/';?>
            <?php echo '/*%%SmartyNocache:136685302057720c28d93375-61640287%%*/<?php }?>/*/%%SmartyNocache:136685302057720c28d93375-61640287%%*/';?>
                      </div>        </div>      </div>      <div class="col-md-6 col-sm-12 col-xs-12">        <h4 class="f-primary-b">          <?php if ($_smarty_tpl->tpl_vars['act_lang']->value=='en') {?>          Association Member DMSI          <?php } else { ?>          Asosiasi Anggota DMSI          <?php }?>        </h4>        <div class="b-blog-short-post row">                    <?php echo '/*%%SmartyNocache:136685302057720c28d93375-61640287%%*/<?php if ($_smarty_tpl->tpl_vars[\'asosiasifooter\']->value!=\'\') {?>/*/%%SmartyNocache:136685302057720c28d93375-61640287%%*/';?>
          <ul class="b-list-markers f-list-markers">            <?php echo '/*%%SmartyNocache:136685302057720c28d93375-61640287%%*/<?php  $_smarty_tpl->tpl_vars[\'rs\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'rs\']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars[\'asosiasifooter\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'rs\']->key => $_smarty_tpl->tpl_vars[\'rs\']->value) {
$_smarty_tpl->tpl_vars[\'rs\']->_loop = true;
?>/*/%%SmartyNocache:136685302057720c28d93375-61640287%%*/';?>
            <li >               <a href="<?php echo '/*%%SmartyNocache:136685302057720c28d93375-61640287%%*/<?php echo $_smarty_tpl->tpl_vars[\'rs\']->value[\'url_detail\'];?>
/*/%%SmartyNocache:136685302057720c28d93375-61640287%%*/';?>
" >                <i class="fa fa-hand-o-right b-list-markers__ico f-list-markers__ico">                </i> <?php echo '/*%%SmartyNocache:136685302057720c28d93375-61640287%%*/<?php echo $_smarty_tpl->tpl_vars[\'rs\']->value[\'nama_asosiasi\'];?>
/*/%%SmartyNocache:136685302057720c28d93375-61640287%%*/';?>
              </a>            </li>            <?php echo '/*%%SmartyNocache:136685302057720c28d93375-61640287%%*/<?php } ?>/*/%%SmartyNocache:136685302057720c28d93375-61640287%%*/';?>
          </ul>          <?php echo '/*%%SmartyNocache:136685302057720c28d93375-61640287%%*/<?php }?>/*/%%SmartyNocache:136685302057720c28d93375-61640287%%*/';?>
                  </div>      </div>      <div class="col-md-3 col-sm-12 col-xs-12 ">        <h4 class="f-primary-b">          <?php if ($_smarty_tpl->tpl_vars['act_lang']->value=='en') {?>          Contact Info          <?php } else { ?>          Info Kontak          <?php }?>        </h4>        <div class="b-contacts-short-item-group">                    <div class="b-contacts-short-item col-md-12 col-sm-4 col-xs-12">            <div class="b-contacts-short-item__icon f-contacts-short-item__icon f-contacts-short-item__icon_lg b-left">              <i class="fa fa-map-marker">              </i>            </div>            <div class="b-remaining f-contacts-short-item__text">              <?php echo '/*%%SmartyNocache:136685302057720c28d93375-61640287%%*/<?php echo nl2br($_smarty_tpl->tpl_vars[\'kontakinfo\']->value[\'alamat\']);?>
/*/%%SmartyNocache:136685302057720c28d93375-61640287%%*/';?>
            </div>          </div>          <div class="b-contacts-short-item col-md-12 col-sm-4 col-xs-12">            <div class="b-contacts-short-item__icon f-contacts-short-item__icon b-left f-contacts-short-item__icon_md">              <i class="fa fa-phone">              </i>            </div>            <div class="b-remaining f-contacts-short-item__text f-contacts-short-item__text_phone">              <?php echo '/*%%SmartyNocache:136685302057720c28d93375-61640287%%*/<?php echo $_smarty_tpl->tpl_vars[\'kontakinfo\']->value[\'telp\'];?>
/*/%%SmartyNocache:136685302057720c28d93375-61640287%%*/';?>
            </div>          </div>          <div class="b-contacts-short-item col-md-12 col-sm-4 col-xs-12">            <div class="b-contacts-short-item__icon f-contacts-short-item__icon b-left f-contacts-short-item__icon_xs">              <i class="fa fa-envelope">              </i>            </div>            <div class="b-remaining f-contacts-short-item__text f-contacts-short-item__text_email">              <a href=""><?php echo '/*%%SmartyNocache:136685302057720c28d93375-61640287%%*/<?php echo $_smarty_tpl->tpl_vars[\'kontakinfo\']->value[\'email\'];?>
/*/%%SmartyNocache:136685302057720c28d93375-61640287%%*/';?>
              </a>            </div>          </div>                  </div>      </div>    </div>  </div></footer><?php }} ?>
