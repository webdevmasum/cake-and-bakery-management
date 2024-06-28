<?php
if(isset($_POST["btnEdit"])){
	$distribution=Distribution::find($_POST["txtId"]);
}
if(isset($_POST["btnUpdate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtProductName"])){
		$errors["product_name"]="Invalid product_name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtQuantity"])){
		$errors["quantity"]="Invalid quantity";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPrice"])){
		$errors["price"]="Invalid price";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbWarehousesId"])){
		$errors["warehouses_id"]="Invalid warehouses_id";
	}

*/
	if(count($errors)==0){
		$distribution=new Distribution();
		$distribution->id=$_POST["txtId"];
		$distribution->product_name=$_POST["txtProductName"];
		$distribution->quantity=$_POST["txtQuantity"];
		$distribution->price=$_POST["txtPrice"];
		$distribution->warehouses_id=$_POST["cmbWarehousesId"];

		$distribution->update();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="distribution">Manage Distribution</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='edit-distribution' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Id","type"=>"hidden","name"=>"txtId","value"=>"$distribution->id"]);
	$html.=input_field(["label"=>"Product Name","type"=>"text","name"=>"txtProductName","value"=>"$distribution->product_name"]);
	$html.=input_field(["label"=>"Quantity","type"=>"text","name"=>"txtQuantity","value"=>"$distribution->quantity"]);
	$html.=input_field(["label"=>"Price","type"=>"text","name"=>"txtPrice","value"=>"$distribution->price"]);
	$html.=select_field(["label"=>"Warehouses","name"=>"cmbWarehousesId","table"=>"warehousess","value"=>"$distribution->warehouses_id"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnUpdate", "value"=>"Update"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
