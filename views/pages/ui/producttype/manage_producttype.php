<?php
if(isset($_POST["btnDelete"])){
	ProductType::delete($_POST["txtId"]);
}
?>
<?php
echo page_header(["title"=>"Manage ProductType"]);
?>
<div class="p-4">
<?php echo table_wrap_open();?>
<?php
	$current_page=isset($_GET["page"])?$_GET["page"]:1;
	echo ProductType::html_table($current_page,5);
?>
<?php echo table_wrap_close();?>
</div>
