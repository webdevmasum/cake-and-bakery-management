<?php
if(isset($_POST["btnCreate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbProductId"])){
		$errors["product_id"]="Invalid product_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtQty"])){
		$errors["qty"]="Invalid qty";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbTransactionTypeId"])){
		$errors["transaction_type_id"]="Invalid transaction_type_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtRemark"])){
		$errors["remark"]="Invalid remark";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbWarehouseId"])){
		$errors["warehouse_id"]="Invalid warehouse_id";
	}

*/
	if(count($errors)==0){
		$rawmaterialsstock=new RawMaterialsStock();
		$rawmaterialsstock->product_id=$_POST["cmbProductId"];
		$rawmaterialsstock->qty=$_POST["txtQty"];
		$rawmaterialsstock->transaction_type_id=$_POST["cmbTransactionTypeId"];
		$rawmaterialsstock->remark=$_POST["txtRemark"];
		$rawmaterialsstock->created_at=$now;
		$rawmaterialsstock->warehouse_id=$_POST["cmbWarehouseId"];

		$rawmaterialsstock->save();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="raw_materials_stock">Manage RawMaterialsStock</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='create-rawmaterialsstock' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=select_field(["label"=>"Product","name"=>"cmbProductId","table"=>"products"]);
	$html.=input_field(["label"=>"Qty","type"=>"text","name"=>"txtQty"]);
	$html.=select_field(["label"=>"Transaction Type","name"=>"cmbTransactionTypeId","table"=>"transaction_types"]);
	$html.=input_field(["label"=>"Remark","type"=>"text","name"=>"txtRemark"]);
	$html.=select_field(["label"=>"Warehouse","name"=>"cmbWarehouseId","table"=>"warehouses"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnCreate", "value"=>"Create"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
