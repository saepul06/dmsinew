<?php /* Smarty version Smarty-3.1.17, created on 2016-09-05 21:01:30
         compiled from "application/views/web/home/homecontent.html" */ ?>
<?php /*%%SmartyHeaderCode:100968988257720c28def839-37976159%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f89ff0d94e2e4e28cbde450358002fadc8a6c907' => 
    array (
      0 => 'application/views/web/home/homecontent.html',
      1 => 1473076398,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '100968988257720c28def839-37976159',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_57720c28eaac69_94675688',
  'variables' => 
  array (
    'judul' => 0,
    'berita_dmsi' => 0,
    'rs' => 0,
    'baseurl' => 0,
    'berita_asosiasi' => 0,
    'datamaxalbum' => 0,
    'rs_album' => 0,
    'foto_list' => 0,
    'BASEURL' => 0,
    'video_list' => 0,
    'act_lang' => 0,
    'eventhome' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57720c28eaac69_94675688')) {function content_57720c28eaac69_94675688($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("web/home/anggota_slider.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<section class="b-tagline-box b-infoblock b-diagonal-line-bg-light">  <div class="container">    <!--<div class="f-primary-b b-title-b-hr f-title-b-hr">GRAFIK KOLEKSI</div>-->    <div class="row">      <div class="col-md-4">        <h4 class="f-primary-b b-h4-special f-h4-special--gray f-h4-special font-judul-header" style=" color: #589444;">          <?php echo $_smarty_tpl->tpl_vars['judul']->value['berita_dmsi'];?>
        </h4>        <div class="b-blog-short-post b-blog-short-post--img-hover-bordered b-blog-short-post--w-img f-blog-short-post--w-img row">          <div class="b-blog-short-post b-blog-short-post--img-hover-bordered b-blog-short-post--w-img f-blog-short-post--w-img row"> <?php if ($_smarty_tpl->tpl_vars['berita_dmsi']->value!='') {?>            <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['berita_dmsi']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>            <div class="b-blog-short-post--popular col-md-12  col-xs-12 f-primary-b">            <div class="b-blog-short-post__item_date f-blog-short-post__item_date f-primary-it font-judul-asosiasi"> <?php echo $_smarty_tpl->tpl_vars['rs']->value['nama_asosiasi'];?>
 </div>              <div class="b-blog-short-post__item_img">                 <a href="<?php echo $_smarty_tpl->tpl_vars['rs']->value['url_detail'];?>
">                  <img data-retina src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
php_helpers/timthumb.php?src=<?php echo $_smarty_tpl->tpl_vars['rs']->value['image'];?>
&amp;w=120&amp;zc=0" alt="" />                </a>               </div>              <div class="b-remaining">                <div class="b-blog-short-post__item_text f-blog-short-post__item_text">                  <a href="<?php echo $_smarty_tpl->tpl_vars['rs']->value['url_detail'];?>
" class="f-primary-b f-more font-judul"><?php echo $_smarty_tpl->tpl_vars['rs']->value['judul'];?>
                  </a>                 </div>                <div class="b-blog-short-post__item_date f-blog-short-post__item_date f-primary-it"> <?php echo $_smarty_tpl->tpl_vars['rs']->value['tanggal'];?>
                 </div>              </div>            </div>            <?php } ?>            <?php }?>             <?php if ($_smarty_tpl->tpl_vars['berita_asosiasi']->value!='') {?>            <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['berita_asosiasi']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>            <div class="b-blog-short-post--popular col-md-12  col-xs-12 f-primary-b">            <div class="b-blog-short-post__item_date f-blog-short-post__item_date f-primary-it font-judul-asosiasi"> <?php echo $_smarty_tpl->tpl_vars['rs']->value['nama_asosiasi'];?>
 </div>              <div class="b-blog-short-post__item_img">                 <a href="<?php echo $_smarty_tpl->tpl_vars['rs']->value['url_detail'];?>
">                  <img data-retina src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
php_helpers/timthumb.php?src=<?php echo $_smarty_tpl->tpl_vars['rs']->value['image'];?>
&amp;w=120&amp;zc=0" alt="" />                </a>               </div>              <div class="b-remaining">                <div class="b-blog-short-post__item_text f-blog-short-post__item_text">                  <a href="<?php echo $_smarty_tpl->tpl_vars['rs']->value['url_detail'];?>
" class="f-primary-b f-more font-judul"><?php echo $_smarty_tpl->tpl_vars['rs']->value['judul'];?>
                  </a>                 </div>                <div class="b-blog-short-post__item_date f-blog-short-post__item_date f-primary-it"> <?php echo $_smarty_tpl->tpl_vars['rs']->value['tanggal'];?>
                 </div>              </div>            </div>            <?php } ?>            <?php }?>           </div>        </div>      </div>      <!--START Berita anggota DMSI-->      <div class="col-md-4">              <h4 class="f-primary-b b-h4-special f-h4-special--gray f-h4-special font-judul-header " style=" color: #589444;">          <?php echo $_smarty_tpl->tpl_vars['judul']->value['judul_album_video'];?>
        </h4>                           <div class="col-md-12 col-sm-12 col-xs-12 ">                <h4 class="f-primary-b">                <?php if ($_smarty_tpl->tpl_vars['datamaxalbum']->value!='') {?>                <?php  $_smarty_tpl->tpl_vars['rs_album'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs_album']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['datamaxalbum']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs_album']->key => $_smarty_tpl->tpl_vars['rs_album']->value) {
$_smarty_tpl->tpl_vars['rs_album']->_loop = true;
?>                <?php echo $_smarty_tpl->tpl_vars['rs_album']->value['nama_album'];?>
                </h4>                  <div class="b-short-photo-items-group">                <?php if ($_smarty_tpl->tpl_vars['foto_list']->value!='') {?>                    <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['foto_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>                      <?php if ($_smarty_tpl->tpl_vars['rs']->value['id_album']==$_smarty_tpl->tpl_vars['rs_album']->value['maxalbum']) {?>                <div class="b-column">                    <a class="b-short-photo-item fancybox" href="<?php echo $_smarty_tpl->tpl_vars['rs']->value['foto'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['rs']->value['judul_foto'];?>
 - <?php echo $_smarty_tpl->tpl_vars['rs']->value['nama_album'];?>
" rel="footer-group"><img width="100" height="100" data-retina src="<?php echo $_smarty_tpl->tpl_vars['rs']->value['foto'];?>
" alt=""/></a>                </div>                    <?php }?>                <?php } ?>                <?php }?>                            </div>                <?php } ?>                <?php }?>              </div> <!--col 12 -->               <div class="b-form-row b-null-bottom-indent">            <?php if ($_smarty_tpl->tpl_vars['datamaxalbum']->value!='') {?>                <?php  $_smarty_tpl->tpl_vars['rs_album'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs_album']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['datamaxalbum']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs_album']->key => $_smarty_tpl->tpl_vars['rs_album']->value) {
$_smarty_tpl->tpl_vars['rs_album']->_loop = true;
?>            <a class="f-footer-mini__link f-more f-primary-b" href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
index.php/public/foto/detail/<?php echo $_smarty_tpl->tpl_vars['rs_album']->value['maxalbum'];?>
">            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right">            </i> Selengkapnya          </a>          <?php } ?>          <?php }?>          <div class="b-hr">      </div>          </div>          <?php if ($_smarty_tpl->tpl_vars['video_list']->value!='') {?>        <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['video_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>        <div class="j-masonry-item col-md-12 col-sm-12 col-xs-12 f-center j-filter-graphic j-filter-illustration">         <h4 class="f-primary-b">                            <?php echo $_smarty_tpl->tpl_vars['rs']->value['judul_video'];?>
                </h4>          <div class="b-portfolio__content-item">            <div class="view view-eighth">              <div class="b-portfolio__content-item-img">                 <img data-retina src="<?php echo $_smarty_tpl->tpl_vars['rs']->value['video_image'];?>
" alt=""/>               </div>              <div class="b-portfolio__content-item-inner b-item-hover-action mask">                <div class="b-item-hover-action__inner">                  <div class="b-item-hover-action__inner-btn_group">                    <a href="<?php echo $_smarty_tpl->tpl_vars['rs']->value['url_play'];?>
" class="b-btn f-btn b-btn-light f-btn-light fancybox info fancybox.iframe" title="<?php echo $_smarty_tpl->tpl_vars['rs']->value['judul'];?>
">                      <i class="fa fa-link">                      </i>                    </a>                  </div>                  <div class=" f-portfolio__content-item-inner-title f-primary-b"><?php echo $_smarty_tpl->tpl_vars['rs']->value['judul_video'];?>
                  </div>                </div>              </div>            </div>          </div>        </div>        <br/>        <br/>        <br/>        <div class="b-form-row b-null-bottom-indent">            <a class="f-footer-mini__link f-more f-primary-b" href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
index.php/public/video">            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right">            </i> Selengkapnya          </a>                </div>        <?php } ?>        <?php }?>      </div>      <!--END Foto dan video-->       <!--start detail desc-->    <!--end detail -->      <!--START KEGIATAN DMSI-->      <div class="col-sm-4">        <div class="b-carousel-secondary f-carousel-secondary b-some-examples-tertiary f-some-examples-tertiary b-carousel-reset">          <div class="b-carousel-title f-carousel-title f-primary-b" style=" color: #589444;">            <?php if ($_smarty_tpl->tpl_vars['act_lang']->value=='en') {?>            DMSI EVENT            <?php } else { ?>            EVENT DMSI            <?php }?>           </div>          <div class="b-some-examples f-some-examples j-carousel-secondary"> <?php if ($_smarty_tpl->tpl_vars['eventhome']->value!='') {?>            <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['eventhome']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>            <div class="b-some-examples__item f-some-examples__item">              <div class="b-app-with-img__item">                <div class="b-app-with-img__item_img view view-sixth">                  <img data-retina="" src="<?php echo $_smarty_tpl->tpl_vars['rs']->value['image_agenda'];?>
" alt="">                  <div class="b-item-hover-action f-center mask">                    <div class="b-item-hover-action__inner">                      <div class="b-item-hover-action__inner-btn_group">                        <a href="<?php echo $_smarty_tpl->tpl_vars['rs']->value['url_detail'];?>
" class="b-btn f-btn b-btn-light f-btn-light info">                          <i class="fa fa-link">                          </i>                        </a>                      </div>                    </div>                  </div>                </div>                <div class="b-app-with-img__item_text f-center">                  <div class="b-app-with-img__item_name f-app-with-img__item_name f-primary-b">                    <a href="<?php echo $_smarty_tpl->tpl_vars['rs']->value['url_detail'];?>
"><?php echo $_smarty_tpl->tpl_vars['rs']->value['judul_agenda'];?>
                    </a>                  </div>                  <div class="b-app-with-img__item_info f-app-with-img__item_info f-primary"><?php echo $_smarty_tpl->tpl_vars['rs']->value['tanggal_mulai'];?>
                  </div>                </div>              </div>              <?php } ?>              <?php }?>             </div>          </div>        </div>        <!--visitor -->        <br/>         <br/>          <br/>        <div class="col-md-12">      <h4 class="f-primary-b b-h4-special f-h4-special--gray f-h4-special">        <?php if ($_smarty_tpl->tpl_vars['act_lang']->value=='en') {?>Visitor<?php } else { ?>Pengunjung<?php }?>      </h4>      <!-- Histats.com  (div with counter) -->      <div id="histats_counter">      </div>      <!-- Histats.com  START  (aync)-->      <script type="text/javascript">var _Hasync= _Hasync|| [];        _Hasync.push(['Histats.start', '1,3536992,4,30,130,80,00011111']);        _Hasync.push(['Histats.fasi', '1']);        _Hasync.push(['Histats.track_hits', '']);        (function() {          var hs = document.createElement('script');          hs.type = 'text/javascript';          hs.async = true;          hs.src = ('//s10.histats.com/js15_as.js');          (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);        }        )();      </script>      <noscript>        <a href="/" target="_blank">          <img  src="//sstatic1.histats.com/0.gif?3536992&101" alt="web stats" border="0">        </a>      </noscript>      <!-- Histats.com  END  -->    </div>      </div>      <!--END KEGIATAN DMSI-->    </div>  </div>  <?php echo $_smarty_tpl->getSubTemplate ("web/home/aspirasi_slider.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
  </div><?php echo $_smarty_tpl->getSubTemplate ("web/home/sponsor_slider.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
