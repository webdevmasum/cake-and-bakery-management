<?php
if(isset($_POST["btnDetails"])){
	$stockadjustment=StockAdjustment::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="stock_adjustment">Manage StockAdjustment</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>StockAdjustment Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$stockadjustment->id</td></tr>";
		$html.="<tr><th>Name</th><td>$stockadjustment->name</td></tr>";
		$html.="<tr><th>Damage Product</th><td>$stockadjustment->damage_product</td></tr>";
		$html.="<tr><th>Product Name</th><td>$stockadjustment->product_name</td></tr>";
		$html.="<tr><th>Branch Name</th><td>$stockadjustment->branch_name</td></tr>";
		$html.="<tr><th>Quantity</th><td>$stockadjustment->quantity</td></tr>";
		$html.="<tr><th>Price</th><td>$stockadjustment->price</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
