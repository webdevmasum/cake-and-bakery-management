<?php
if(isset($_POST["btnDetails"])){
	$producttype=ProductType::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="product_types">Manage ProductType</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>ProductType Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$producttype->id</td></tr>";
		$html.="<tr><th>Name</th><td>$producttype->name</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
