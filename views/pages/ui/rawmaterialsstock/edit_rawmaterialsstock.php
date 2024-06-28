<?php
if(isset($_POST["btnEdit"])){
	$rawmaterialsstock=RawMaterialsStock::find($_POST["txtId"]);
}
if(isset($_POST["btnUpdate"])){
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
		$rawmaterialsstock->id=$_POST["txtId"];
		$rawmaterialsstock->product_id=$_POST["cmbProductId"];
		$rawmaterialsstock->qty=$_POST["txtQty"];
		$rawmaterialsstock->transaction_type_id=$_POST["cmbTransactionTypeId"];
		$rawmaterialsstock->remark=$_POST["txtRemark"];
		$rawmaterialsstock->created_at=$now;
		$rawmaterialsstock->warehouse_id=$_POST["cmbWarehouseId"];

		$rawmaterialsstock->update();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="raw_materials_stock">Manage RawMaterialsStock</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='edit-rawmaterialsstock' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Id","type"=>"hidden","name"=>"txtId","value"=>"$rawmaterialsstock->id"]);
	$html.=select_field(["label"=>"Product","name"=>"cmbProductId","table"=>"products","value"=>"$rawmaterialsstock->product_id"]);
	$html.=input_field(["label"=>"Qty","type"=>"text","name"=>"txtQty","value"=>"$rawmaterialsstock->qty"]);
	$html.=select_field(["label"=>"Transaction Type","name"=>"cmbTransactionTypeId","table"=>"transaction_types","value"=>"$rawmaterialsstock->transaction_type_id"]);
	$html.=input_field(["label"=>"Remark","type"=>"text","name"=>"txtRemark","value"=>"$rawmaterialsstock->remark"]);
	$html.=select_field(["label"=>"Warehouse","name"=>"cmbWarehouseId","table"=>"warehouses","value"=>"$rawmaterialsstock->warehouse_id"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnUpdate", "value"=>"Update"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
