<?php /* Smarty version Smarty-3.1.17, created on 2016-08-09 06:24:34
         compiled from "application\views\private\kontak\edit.html" */ ?>
<?php /*%%SmartyHeaderCode:32737578c948f3f4ed5-38187611%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7da9d9b79404e5c4e44862cad9f7935c60359d4f' => 
    array (
      0 => 'application\\views\\private\\kontak\\edit.html',
      1 => 1470700986,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32737578c948f3f4ed5-38187611',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_578c948f4bc284_91186058',
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
<?php if ($_valid && !is_callable('content_578c948f4bc284_91186058')) {function content_578c948f4bc284_91186058($_smarty_tpl) {?>                <section class="content-header">
                    <h1>
                     Kontak Info
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
                               <input type="hidden" name="id_kontak" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_kontak'];?>
" />
                                   <div class="box-body">
                                   		<div class="form-group">
                                            <label for="user_name_lama">Email *</label>
                                           <input type="text" name="email" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
" size="100" maxlength="200" class="form-control"  />
                                        </div>
                                        <div class="form-group">
                                            <label for="user_name_lama">Telepon *</label>
                                           <input type="text" name="telp" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['telp'];?>
" size="100" maxlength="200" class="form-control" style="width:250px;"  />
                                        </div>
                                        <div class="form-group">
                                            <label for="user_name_lama">Fax *</label>
                                           <input type="text" name="fax" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['fax'];?>
" size="100" maxlength="200" class="form-control" style="width:250px;"  />
                                        </div>
                                        <div class="form-group">
                                            <label for="user_name_lama">Website </label>
                                           <input type="text" name="website" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['website'];?>
" size="100" maxlength="200" class="form-control"  />
                                        </div>
                                        <div class="form-group">
                                            <label for="pertanyaan">Alamat * </label><br />
                                           <textarea name="alamat" cols="72" rows="5" ><?php echo $_smarty_tpl->tpl_vars['data']->value['alamat'];?>
</textarea>
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
                    
 </section><!-- /.content --><?php }} ?>
