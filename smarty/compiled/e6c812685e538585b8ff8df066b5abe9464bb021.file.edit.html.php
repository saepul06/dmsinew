<?php /* Smarty version Smarty-3.1.17, created on 2016-06-28 15:19:42
         compiled from "application/views/private/program/edit.html" */ ?>
<?php /*%%SmartyHeaderCode:13904332805772331eeb5327-71406676%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e6c812685e538585b8ff8df066b5abe9464bb021' => 
    array (
      0 => 'application/views/private/program/edit.html',
      1 => 1467081307,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13904332805772331eeb5327-71406676',
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
    'image_program' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5772331ef36399_88571651',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5772331ef36399_88571651')) {function content_5772331ef36399_88571651($_smarty_tpl) {?>                <section class="content-header">
                    <h1>
                     Program Aksi DMSI
                        <small>panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['url_private']->value;?>
"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['url_list']->value;?>
"><i class="fa "></i> Kontak</a></li>
                        <li class="active">Update Data</li>
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
                                    <h3 class="box-title">Update Data Kontak Info</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                               <form id="form" action="<?php echo $_smarty_tpl->tpl_vars['url_process']->value;?>
" method="post" enctype="multipart/form-data">
                               <input type="hidden" name="id_kontak" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_program'];?>
" />
                                   <div class="box-body">
                                   		<div class="form-group">
                                            <label for="judul">Judul Program *</label>

                                           <input type="text" name="judul_program" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['judul_program'];?>
" size="100" maxlength="200" class="form-control"  />
                                        </div>
                                        <div class="form-group">
                                            <label for="judul">Judul Program (<i>English</i>) *</label>

                                           <input type="text" name="judul_english" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['judul_english'];?>
" size="100" maxlength="200" class="form-control"  />
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal *</label>
                                            <input type="text" name="tanggal" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['tanggal'];?>
" class="tanggal form-control" size="10" maxlength="10" style="width:150px;" />
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih File Foto * </label>
                                             <div style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['image_program']->value;?>
</div><br />
                                                <span>
                                                    <input  type="file" 
                                                            style="visibility:hidden; width: 1px;" 
                                                            id='foto' name='image_program'  
                                                            onchange="$(this).parent().find('span').html($(this).val().replace('C:\\fakepath\\', ''))"  /> 
                                                    <input class="btn btn-primary" type="button" value="Browse.." onclick="$(this).parent().find('input[type=file]').click();"/> 
                                                    &nbsp;
                                                    <span  class="badge badge-important" ></span>
                                                </span>
                                        </div>
                                        
                                      	
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>  Simpan</button>
                                      
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        
                        </div><!-- /.col -->
                        
                        
                    </div><!-- /.row -->
                    
 </section><!-- /.content --><?php }} ?>
