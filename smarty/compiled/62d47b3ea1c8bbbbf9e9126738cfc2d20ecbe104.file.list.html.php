<?php /* Smarty version Smarty-3.1.17, created on 2016-08-15 23:17:54
         compiled from "application/views/private/asosiasi/list.html" */ ?>
<?php /*%%SmartyHeaderCode:15084250795772f2b0697980-92299484%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '62d47b3ea1c8bbbbf9e9126738cfc2d20ecbe104' => 
    array (
      0 => 'application/views/private/asosiasi/list.html',
      1 => 1470722578,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15084250795772f2b0697980-92299484',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5772f2b07be0b6_53051877',
  'variables' => 
  array (
    'url_private' => 0,
    'notification_msg' => 0,
    'notification_status' => 0,
    'url_search' => 0,
    'search_status' => 0,
    'propinsi' => 0,
    'result_propinsi' => 0,
    'propinsi_selected' => 0,
    'url_add' => 0,
    'asosiasi' => 0,
    'no' => 0,
    'result' => 0,
    'url_edit' => 0,
    'url_delete' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5772f2b07be0b6_53051877')) {function content_5772f2b07be0b6_53051877($_smarty_tpl) {?><section class="content-header">
                    <h1>
                      Asosiasi Anggota
                        <small>panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['url_private']->value;?>
"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Asosiasi Anggota</li>
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
                        <div class="col-md-12">
                        	<!-- Warning box -->
                            <div class="box box-solid box-success" id="scrform">
                                <div class="box-header">
                                    <h3 class="box-title">Pencarian Lebih Detail</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-warning btn-sm" id="btnscr" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                 <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_search']->value;?>
" >
                                 <input type="hidden" name="search_status" id="search_status" value="<?php echo $_smarty_tpl->tpl_vars['search_status']->value;?>
"  />
                                <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        	<label for="user_name_lama">Provinsi </label>
                                            <div class="input-group">
                                        	 <select name="id_propinsi" class="form-control" >
                                            <option value="">-Pilih Provinsi-</option>
                                            <?php  $_smarty_tpl->tpl_vars['result_propinsi'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['result_propinsi']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['propinsi']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['result_propinsi']->key => $_smarty_tpl->tpl_vars['result_propinsi']->value) {
$_smarty_tpl->tpl_vars['result_propinsi']->_loop = true;
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['result_propinsi']->value['id_propinsi'];?>
" <?php if ($_smarty_tpl->tpl_vars['result_propinsi']->value['id_propinsi']==$_smarty_tpl->tpl_vars['propinsi_selected']->value) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['result_propinsi']->value['nama_propinsi'];?>
</option>
                                            <?php } ?>
                    						</select>
                                            </div>
                                    </div>
                                    
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>  Cari</button>
                                        <input type="submit" name="reset" class="btn btn-primary" value="Reset" />
                                    </div>
                              </div>
                          </div>
                         
                          </div>
                        </div>
                        <div class="col-md-12">
                        	<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Data Asosiasi Anggota</h3>
                                    <div class="box-tools">
                                    	<div class="btn-group pull-right"><a href="<?php echo $_smarty_tpl->tpl_vars['url_add']->value;?>
" title="Tambah Data" class="btn bg-olive btn-flat"><i class='fa fa-plus'></i> Tambah Data</a></div>
                                    </div>
                                </div><!-- /.box-header -->
                                    <div class="box-body table-responsive">
                                        <table id="table_datagrid" class="table table-bordered table-striped">
                                            <thead>
                                               <th width="5%">No </th>
                                                <th width="13%">Id Asosiasi</th>
                                                <th width="25%">Nama Asosiasi</th>
                                                <th width="20%">Kota</th>
                                                <th width="20%">Provinsi</th>
                                                <th width="12%"></th>
                                            </thead>
                                            <tbody>
                                            <?php if ($_smarty_tpl->tpl_vars['asosiasi']->value!='') {?>
   											 <?php  $_smarty_tpl->tpl_vars['result'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['result']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['asosiasi']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['result']->key => $_smarty_tpl->tpl_vars['result']->value) {
$_smarty_tpl->tpl_vars['result']->_loop = true;
?>
                                            <tr>
                                                <td><?php echo $_smarty_tpl->tpl_vars['no']->value++;?>
.</td>
                                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['result']->value['id_asosiasi'];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['result']->value['nama_asosiasi'];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['result']->value['nama_kota'];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['result']->value['nama_propinsi'];?>
</td>
                                                <td align="center">
                                                   <div class="btn-group"><a href="<?php echo $_smarty_tpl->tpl_vars['url_edit']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['result']->value['id_asosiasi'];?>
" title="Edit" class="btn btn-success btn-flat"><i class='fa fa-pencil'></i></a>&nbsp;<a href="<?php echo $_smarty_tpl->tpl_vars['url_delete']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['result']->value['id_asosiasi'];?>
" title="Hapus" class="btn btn-danger btn-flat" id="btndel<?php echo $_smarty_tpl->tpl_vars['result']->value['no_regmus'];?>
" onclick="return konfirmasi_delete();"><i class='fa fa-trash'></i></a></div> 
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php }?>
                                            </tbody>
                                            <tfoot>
                                        </tfoot>
                                    </table>
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div><!-- /.row -->
                    
                </section><!-- /.content -->

<?php }} ?>
