<?php
if(isset($_POST["btnEdit"])){
	$production=Production::find($_POST["txtId"]);
}
if(isset($_POST["btnUpdate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtProductName"])){
		$errors["product_name"]="Invalid product_name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbManufacturerId"])){
		$errors["manufacturer_id"]="Invalid manufacturer_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtQuantity"])){
		$errors["quantity"]="Invalid quantity";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPrice"])){
		$errors["price"]="Invalid price";
	}

*/
	if(count($errors)==0){
		$production=new Production();
		$production->id=$_POST["txtId"];
		$production->product_name=$_POST["txtProductName"];
		$production->manufacturer_id=$_POST["cmbManufacturerId"];
		$production->quantity=$_POST["txtQuantity"];
		$production->price=$_POST["txtPrice"];

		$production->update();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="production">Manage Production</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='edit-production' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Id","type"=>"hidden","name"=>"txtId","value"=>"$production->id"]);
	$html.=input_field(["label"=>"Product Name","type"=>"text","name"=>"txtProductName","value"=>"$production->product_name"]);
	$html.=select_field(["label"=>"Manufacturer","name"=>"cmbManufacturerId","table"=>"manufacturers","value"=>"$production->manufacturer_id"]);
	$html.=input_field(["label"=>"Quantity","type"=>"text","name"=>"txtQuantity","value"=>"$production->quantity"]);
	$html.=input_field(["label"=>"Price","type"=>"text","name"=>"txtPrice","value"=>"$production->price"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnUpdate", "value"=>"Update"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
