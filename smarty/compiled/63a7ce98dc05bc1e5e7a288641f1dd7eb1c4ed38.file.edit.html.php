<?php /* Smarty version Smarty-3.1.17, created on 2016-08-09 06:35:13
         compiled from "application\views\private\regulasi\edit.html" */ ?>
<?php /*%%SmartyHeaderCode:265905791d889339642-02467106%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '63a7ce98dc05bc1e5e7a288641f1dd7eb1c4ed38' => 
    array (
      0 => 'application\\views\\private\\regulasi\\edit.html',
      1 => 1470700989,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '265905791d889339642-02467106',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5791d889529841_37146068',
  'variables' => 
  array (
    'url_private' => 0,
    'url_list' => 0,
    'notification_msg' => 0,
    'notification_status' => 0,
    'url_process' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5791d889529841_37146068')) {function content_5791d889529841_37146068($_smarty_tpl) {?>                <section class="content-header">
                    <h1>
                      Regulasi
                        <small>panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['url_private']->value;?>
"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['url_list']->value;?>
"><i class="fa "></i> Regulasi</a></li>
                        <li class="active">Tambah Data</li>
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
                                <div class="box-header">
                                    <h3 class="box-title">Tambah Data File</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                               <form id="form" action="<?php echo $_smarty_tpl->tpl_vars['url_process']->value;?>
" method="post" enctype="multipart/form-data">
                                   <div class="box-body">
                                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_regulasi'];?>
" name="id_regulasi">
                                        <div class="form-group">
                                            <label for="user_name_lama">Judul * </label>
                                            <input type="text" name="judul" id="judul" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['judul'];?>
" class="form-control" size="50" maxlength="255" />
                                        </div>
                                         <div class="form-group">
                                            <label for="user_name_lama">Judul (<i>English</i> ) * </label>
                                            <input type="text" name="judul_english" id="judul" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['judul_english'];?>
" class="form-control" size="50" maxlength="255" />
                                        </div>
                                        <div class="form-group">
                                            <label for="user_name_lama">File Max 5 MB</label>
                                            <span>
                                                    <input  type="file" 
                                                            style="visibility:hidden; width: 1px;" 
                                                            id='foto' name='file'  
                                                            onchange="$(this).parent().find('span').html($(this).val().replace('C:\\fakepath\\', ''))"  /> 
                                                    <input class="btn btn-primary" type="button" value="Browse.." onclick="$(this).parent().find('input[type=file]').click();"/> 
                                                    &nbsp;
                                                    <span  class="badge badge-important" ></span>
                                                </span>
                                            <?php echo $_smarty_tpl->tpl_vars['data']->value['file_regulasi'];?>
<br /><br />
                                        </div>
                                        <div class="form-group">
                                            <label for="user_name_lama">Tahun</label>
                                            <input type="text" name="tahun" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['tahun'];?>
" id="tahun" class="form-control" size="10" maxlength="10" style="width:150px;" />
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>  Simpan</button>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['url_list']->value;?>
"  class="btn btn-primary"><i class="fa fa-close"></i>  Batal</a>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        
                        </div><!-- /.col -->
                        
                        
                    </div><!-- /.row -->
                    
 </section><!-- /.content -->



<?php }} ?>
