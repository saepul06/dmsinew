<?php /* Smarty version Smarty-3.1.17, created on 2016-08-18 22:55:27
         compiled from "application/views/web/base-layout/document.html" */ ?>
<?php /*%%SmartyHeaderCode:209770567457720cfa9655e2-51094615%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '316164f4bc7b528acc57a8bce980ce5f06ca3fcf' => 
    array (
      0 => 'application/views/web/base-layout/document.html',
      1 => 1471574979,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '209770567457720cfa9655e2-51094615',
  'function' => 
  array (
  ),
  'cache_lifetime' => 3600,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_57720cfa9fe6f5_99860577',
  'variables' => 
  array (
    'title' => 1,
    'BASEURL' => 0,
    'THEMESPATH' => 0,
    'LOADSTYLE' => 0,
    'LOADJS' => 0,
  ),
  'has_nocache_code' => true,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57720cfa9fe6f5_99860577')) {function content_57720cfa9fe6f5_99860577($_smarty_tpl) {?><!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <title><?php echo '/*%%SmartyNocache:209770567457720cfa9655e2-51094615%%*/<?php echo $_smarty_tpl->tpl_vars[\'title\']->value;?>
/*/%%SmartyNocache:209770567457720cfa9655e2-51094615%%*/';?>
</title>

  <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
doc/favicon.ico">
<meta property="og:title" content="Join the best company in the world!" />
<meta property="og:url" content="http://www.sharethis.com" />
<meta property="og:image" content="http://sharethis.com/images/logo.jpg" />
<meta property="og:description" content="ShareThis is its people. It's imperative that we hire smart,innovative people who can work intelligently as we continue to disrupt the very category we created. Come join us!" />
<meta property="og:site_name" content="ShareThis" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['THEMESPATH']->value;?>
" />

<?php echo $_smarty_tpl->tpl_vars['LOADSTYLE']->value;?>


</head>

<body>

  <div class="mask-l" style="background-color: #fff; width: 100%; height: 100%; position: fixed; top: 0; left:0; z-index: 9999999;"></div> <!--removed by integration-->



<?php echo $_smarty_tpl->getSubTemplate ("web/base-layout/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


<div class="j-menu-container"></div>



<?php echo $_smarty_tpl->getSubTemplate ("web/base-layout/header_detail.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>




 	<div class="l-main-container">

    

    	 <?php echo '/*%%SmartyNocache:209770567457720cfa9655e2-51094615%%*/<?php echo $_smarty_tpl->getSubTemplate ("web/base-layout/breadcrumbs.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
/*/%%SmartyNocache:209770567457720cfa9655e2-51094615%%*/';?>


        <div class="l-inner-page-container">

            <div class="container">

                <div class="row">

                    <?php echo '/*%%SmartyNocache:209770567457720cfa9655e2-51094615%%*/<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars[\'template_content\']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
/*/%%SmartyNocache:209770567457720cfa9655e2-51094615%%*/';?>


                    <?php echo '/*%%SmartyNocache:209770567457720cfa9655e2-51094615%%*/<?php echo $_smarty_tpl->getSubTemplate ("web/base-layout/sidebar.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
/*/%%SmartyNocache:209770567457720cfa9655e2-51094615%%*/';?>


                 </div>

               </div>

        </div>

    

	</div>

<?php echo $_smarty_tpl->getSubTemplate ("web/base-layout/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


 <!-- javascript loaded -->

<?php echo $_smarty_tpl->tpl_vars['LOADJS']->value;?>


<!-- end of loaded javascript -->



</body>

</html><?php }} ?>
