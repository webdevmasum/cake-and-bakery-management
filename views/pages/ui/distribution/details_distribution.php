<?php
if(isset($_POST["btnDetails"])){
	$distribution=Distribution::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="distribution">Manage Distribution</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>Distribution Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$distribution->id</td></tr>";
		$html.="<tr><th>Product Name</th><td>$distribution->product_name</td></tr>";
		$html.="<tr><th>Quantity</th><td>$distribution->quantity</td></tr>";
		$html.="<tr><th>Price</th><td>$distribution->price</td></tr>";
		$html.="<tr><th>Warehouses Id</th><td>$distribution->warehouses_id</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
