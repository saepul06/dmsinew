<?php /* Smarty version Smarty-3.1.17, created on 2016-08-09 04:54:19
         compiled from "application\views\private\berita\list.html" */ ?>
<?php /*%%SmartyHeaderCode:7040578c7ce031eea8-84639059%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e536b4d00dbd3e9ce7cef19499267608cbebed4a' => 
    array (
      0 => 'application\\views\\private\\berita\\list.html',
      1 => 1470711146,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7040578c7ce031eea8-84639059',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_578c7ce05f19c9_19250158',
  'variables' => 
  array (
    'url_private' => 0,
    'notification_msg' => 0,
    'notification_status' => 0,
    'url_add' => 0,
    'start' => 0,
    'end' => 0,
    'total' => 0,
    'pagging' => 1,
    'url_process' => 1,
    'data' => 1,
    'result' => 1,
    'no' => 1,
    'url_edit' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_578c7ce05f19c9_19250158')) {function content_578c7ce05f19c9_19250158($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\xampp\\htdocs\\dmsinew\\application\\third_party\\Smarty\\plugins\\modifier.date_format.php';
?>
<script type="text/javascript">
	function konfirmasi_delete_data(){
		tanya = confirm('Apakah anda yakin akan menghapus data ini!');
		if(tanya){
			return true;
		}else{
			return false;
		}
	}

</script>

                <section class="content-header">
                    <h1>
                       Berita
                        <small>panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['url_private']->value;?>
"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Berita</li>
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
                        	<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Daftar Berita</h3>
                                     <div class="box-tools">
                                     	<div class="btn-group pull-right"><a href="<?php echo $_smarty_tpl->tpl_vars['url_add']->value;?>
" title="Tambah Data" class="btn bg-olive btn-flat"><i class='fa fa-plus'></i> Tambah Data</a>
                                        </div>
                                        
                                    </div>
                                </div><!-- /.box-header -->
                                 <!-- <div class="box-header">
                                 	<span class="pull-left" style="margin-left:10px;">Menampilkan <b><?php echo $_smarty_tpl->tpl_vars['start']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['end']->value;?>
</b> dari <b><?php echo $_smarty_tpl->tpl_vars['total']->value;?>
</b> data</span>
                                 	<div class="box-tools">
                                    	<?php if ($_smarty_tpl->tpl_vars['total']->value!=0) {?>
                                        <ul class="pagination pagination-sm no-margin pull-right">
                                           <?php if ($_smarty_tpl->tpl_vars['pagging']->value!='') {?><?php echo $_smarty_tpl->tpl_vars['pagging']->value;?>
<?php }?>
                                        </ul>
                                        <?php }?>
                                    </div>
                                    
                                   
                                    
                                 </div> -->
                                 
                                  <form action="<?php echo $_smarty_tpl->tpl_vars['url_process']->value;?>
" name="form-koleksi" method="post" onsubmit="javascript:return konfirmasi_delete_data();">
                                  <div style="margin-left:10px;">
                                  <input type="submit" name="hapus" value="hapus" class="btn btn-danger"/>
                                  </div>
                                    <div class="box-body table-responsive">
                                    
                                        <table id="table_datagrid" class="table table-bordered table-striped"">
                                            <thead>
                                                <tr>
                                               <th width="5%" id="cekAll"><input type="checkbox" class="checked-all" name="checked-all"  id="checked-all" class="form-control"></th>
                                                <th width="5%">No.</th>
                                                <th width="35%">Judul Berita</th>
                                                <th width="20%" align="center">Asosiasi</th>
                                                <th width="10%" align="center">Tanggal</th>
                                                <th width="18%" align="center">Foto</th>
                                                <th width="7%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php if ($_smarty_tpl->tpl_vars['data']->value!='') {?>
                                              <?php  $_smarty_tpl->tpl_vars['result'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['result']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['result']->key => $_smarty_tpl->tpl_vars['result']->value) {
$_smarty_tpl->tpl_vars['result']->_loop = true;
?>
                                            <tr>
                                                <td align="center"><input type=checkbox name="id_berita[]" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['id_berita'];?>
" class="checkbox" /></td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['no']->value++;?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['result']->value['judul'];?>

                                                <br/>
                                                <i><?php echo $_smarty_tpl->tpl_vars['result']->value['judul_english'];?>
</i></td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['result']->value['nama_asosiasi'];?>
</td>
                                                <td align="center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['result']->value['tanggal'],"%d/%m/%Y");?>
</td>
                                                <td align="center"><?php if ($_smarty_tpl->tpl_vars['result']->value['image']!='') {?>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['result']->value['image'];?>
" width="100" />
                                                <?php }?>
                                                </td>
                                                <td align="center">
                                                <div class="btn-group-vertical"><a href="<?php echo $_smarty_tpl->tpl_vars['url_edit']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['result']->value['id_berita'];?>
" title="Edit" class="btn btn-success btn-flat"><i class='fa fa-pencil'></i></a>
                                              </div> 
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php }?>
                                            </tbody>
                                            <tfoot>
                                           
                                        </tfoot>
                                    </table>
                                    
                                    </div><!-- /.box-body -->
                                    <div class="box-footer clearfix">
                                    <input type="submit" name="hapus" value="hapus" class="btn btn-danger"/>
    	                               <ul class="pagination pagination-sm no-margin pull-right"> <?php if ($_smarty_tpl->tpl_vars['pagging']->value!='') {?><?php echo $_smarty_tpl->tpl_vars['pagging']->value;?>
<?php }?></ul>
	                                </div>
                                    </form>
                                    
                            </div><!-- /.box -->
                        </div>
                    </div><!-- /.row -->
                </section><!-- /.content -->
<?php }} ?>
