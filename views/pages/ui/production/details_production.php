<?php
if(isset($_POST["btnDetails"])){
	$production=Production::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="production">Manage Production</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>Production Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$production->id</td></tr>";
		$html.="<tr><th>Product Name</th><td>$production->product_name</td></tr>";
		$html.="<tr><th>Manufacturer Id</th><td>$production->manufacturer_id</td></tr>";
		$html.="<tr><th>Quantity</th><td>$production->quantity</td></tr>";
		$html.="<tr><th>Price</th><td>$production->price</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
