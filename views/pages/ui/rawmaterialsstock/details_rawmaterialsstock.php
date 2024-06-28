<?php
if(isset($_POST["btnDetails"])){
	$rawmaterialsstock=RawMaterialsStock::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="raw_materials_stock">Manage RawMaterialsStock</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>RawMaterialsStock Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$rawmaterialsstock->id</td></tr>";
		$html.="<tr><th>Product Id</th><td>$rawmaterialsstock->product_id</td></tr>";
		$html.="<tr><th>Qty</th><td>$rawmaterialsstock->qty</td></tr>";
		$html.="<tr><th>Transaction Type Id</th><td>$rawmaterialsstock->transaction_type_id</td></tr>";
		$html.="<tr><th>Remark</th><td>$rawmaterialsstock->remark</td></tr>";
		$html.="<tr><th>Created At</th><td>$rawmaterialsstock->created_at</td></tr>";
		$html.="<tr><th>Warehouse Id</th><td>$rawmaterialsstock->warehouse_id</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
