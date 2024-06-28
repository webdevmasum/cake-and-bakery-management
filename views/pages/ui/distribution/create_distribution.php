<?php
if(isset($_POST["btnCreate"])){
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
		$distribution->product_name=$_POST["txtProductName"];
		$distribution->quantity=$_POST["txtQuantity"];
		$distribution->price=$_POST["txtPrice"];
		$distribution->warehouses_id=$_POST["cmbWarehousesId"];

		$distribution->save();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="distribution">Manage Distribution</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='create-distribution' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Product Name","type"=>"text","name"=>"txtProductName"]);
	$html.=input_field(["label"=>"Quantity","type"=>"text","name"=>"txtQuantity"]);
	$html.=input_field(["label"=>"Price","type"=>"text","name"=>"txtPrice"]);
	$html.=select_field(["label"=>"Warehouses","name"=>"cmbWarehousesId","table"=>"warehouses"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnCreate", "value"=>"Create"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
