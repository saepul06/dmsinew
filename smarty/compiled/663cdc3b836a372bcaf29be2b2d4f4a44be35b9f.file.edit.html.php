<?php /* Smarty version Smarty-3.1.17, created on 2016-07-14 16:49:50
         compiled from "application/views/private/sesebi/edit.html" */ ?>
<?php /*%%SmartyHeaderCode:5988179145787603e8e0560-59206505%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '663cdc3b836a372bcaf29be2b2d4f4a44be35b9f' => 
    array (
      0 => 'application/views/private/sesebi/edit.html',
      1 => 1468489774,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5988179145787603e8e0560-59206505',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_private' => 0,
    'url_list' => 0,
    'notification_msg' => 0,
    'notification_status' => 0,
    'url_process' => 0,
    'data' => 0,
    'image_sesebi' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5787603e97e963_94292186',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5787603e97e963_94292186')) {function content_5787603e97e963_94292186($_smarty_tpl) {?>                <section class="content-header">
                    <h1>
                      Opini
                        <small>panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['url_private']->value;?>
"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['url_list']->value;?>
"><i class="fa "></i> Serba-serbi</a></li>
                        <li class="active">Edit Data</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
        <!-- Small boxes (Stat box) -->
                    <div class="row">
                     <!-- notification template -->
                        <?php if ($_smarty_tpl->tpl_vars['notification_msg']->value!='') {?>
                        <div class="col-md-12">
                            <?php if ($_smarty_tpl->tpl_vars['notification_status']->value=='red') {?>
                            <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <?php echo $_smarty_tpl->tpl_vars['notification_msg']->value;?>
.
                                    </div>
                                 <?php }?>
                                 <?php if ($_smarty_tpl->tpl_vars['notification_status']->value=='green') {?>
                                 <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                         <?php echo $_smarty_tpl->tpl_vars['notification_msg']->value;?>
.
                                    </div>
                                 <?php }?>
                         </div>
                        <?php }?>
                        <div class="col-md-9">
                        <!-- form update email-->
                             <div class="box box-success">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                      <li class="active"><a href="#tab_1" data-toggle="tab">Indonesia</a></li>
                                      <li><a href="#tab_2" data-toggle="tab">English</a></li>
                                     
                                    </ul>
                                <!-- form start -->
                              <form id="form" action="<?php echo $_smarty_tpl->tpl_vars['url_process']->value;?>
" method="post" enctype="multipart/form-data">
                               <div class="tab-content">
                                 <div class="tab-pane active" id="tab_1">
                                   <div class="box-body">
                                       <input type="hidden" name="id_sesebi" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_sesebi'];?>
" />
                                        <div class="form-group">
                                            <label for="user_name_lama">Judul Serba Serbi * </label>
                                            <input type="text" name="judul" id="judul" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['judul'];?>
" class="form-control" size="50" maxlength="255" />
                                        </div>
                                        <div class="form-group">
                                            <label for="user_name_lama">Tanggal</label>
                                            <input type="text" name="tanggal" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['tanggal'];?>
" class="tanggal form-control" size="10" maxlength="10" style="width:150px;" />
                                        </div>
                                        <div class="form-group">
                                            <label for="user_name_lama">Isi Serba Serbi</label>
                                           <textarea name="content" cols="72" rows="10" class="textarea"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $_smarty_tpl->tpl_vars['data']->value['content'];?>
</textarea>
                                        </div>
                                         <div class="form-group">
                                            <label for="user_name_lama">File Gambar</label>
                                              <div style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['image_sesebi']->value;?>
</div><br />
                                          <br />
                                           <span>
                                                    <input  type="file" 
                                                            style="visibility:hidden; width: 1px;" 
                                                            id='image_sesebi' name='image_sesebi'  
                                                            onchange="$(this).parent().find('span').html($(this).val().replace('C:\\fakepath\\', ''))"  /> 
                                                    <input class="btn btn-primary" type="button" value="Browse.." onclick="$(this).parent().find('input[type=file]').click();"/> 
                                                    &nbsp;
                                                    <span  class="badge badge-important" ></span>
                                                </span>

                                        </div>
                                        <div class="form-group">
                                            <label for="user_name_lama">Keterangan Gambar</label>
                                           <input type="text" name="keterangan_gambar" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['keterangan_gambar'];?>
" size="100" maxlength="200" class="form-control" />
                                        </div>
                                    <div class="form-group">
                                            <label for="user_name_lama">File Lampiran</label>
                                            <span>
                                                    <input  type="file" 
                                                            style="visibility:hidden; width: 1px;" 
                                                            id='file' name='file'  
                                                            onchange="$(this).parent().find('span').html($(this).val().replace('C:\\fakepath\\', ''))"  /> 
                                                    <input class="btn btn-primary" type="button" value="Browse.." onclick="$(this).parent().find('input[type=file]').click();"/> 
                                                    &nbsp;
                                                    <span  class="badge badge-important" ></span>
                                                </span>
                                                <?php echo $_smarty_tpl->tpl_vars['data']->value['file_lampiran'];?>
<br /><br />
                                        </div>
                                    </div><!-- /.box-body -->

                                    </div><!-- /.tabs pane 1-->

                                    <!-- tab 2-->
                                     <div class="tab-pane" id="tab_2">
                                   <div class="box-body">
                                         
                                       <div class="form-group">
                                            <label for="user_name_lama">Judul Serba-serbi <i>(English)</i> * </label>
                                            <input type="text" name="judul_english" id="judul" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['judul_english'];?>
" class="form-control" size="50" maxlength="255" />
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="user_name_lama">Isi Serba-serbi <i>(English)</i> *</label>
                                           <textarea name="content_english" cols="72" rows="10" class="textarea"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $_smarty_tpl->tpl_vars['data']->value['content_english'];?>
</textarea>
                                        </div>
                                         
                                        <div class="form-group">
                                            <label for="user_name_lama">Keterangan Gambar <i>(English)</i> </label>
                                           <input type="text" name="caption_picture" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['caption_picture'];?>
" size="100" maxlength="200" class="form-control" />
                                        </div>
                                    </div><!-- /.box-body -->
                                        <div class="box-footer">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>  Simpan</button>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['url_list']->value;?>
"  class="btn btn-primary"><i class="fa fa-close"></i>  Batal</a>
                                    </div>
                                    </div><!-- /.tabs pane 2-->
                                    </div><!-- /.tabs content-->
                                    </form>
                                    </div><!-- /.tabs customs-->
                                </form>
                            </div><!-- /.box -->
                        
                        </div><!-- /.col -->
                        
                        
                    </div><!-- /.row -->
                    
 </section><!-- /.content -->
<?php }} ?>
