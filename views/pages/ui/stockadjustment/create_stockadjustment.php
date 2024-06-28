<?php
if(isset($_POST["btnCreate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtDamageProduct"])){
		$errors["damage_product"]="Invalid damage_product";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtProductName"])){
		$errors["product_name"]="Invalid product_name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtBranchName"])){
		$errors["branch_name"]="Invalid branch_name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtQuantity"])){
		$errors["quantity"]="Invalid quantity";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPrice"])){
		$errors["price"]="Invalid price";
	}

*/
	if(count($errors)==0){
		$stockadjustment=new StockAdjustment();
		$stockadjustment->name=$_POST["txtName"];
		$stockadjustment->damage_product=$_POST["txtDamageProduct"];
		$stockadjustment->product_name=$_POST["txtProductName"];
		$stockadjustment->branch_name=$_POST["txtBranchName"];
		$stockadjustment->quantity=$_POST["txtQuantity"];
		$stockadjustment->price=$_POST["txtPrice"];

		$stockadjustment->save();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="stock_adjustment">Manage StockAdjustment</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='create-stockadjustment' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Name","type"=>"text","name"=>"txtName"]);
	$html.=input_field(["label"=>"Damage Product","type"=>"text","name"=>"txtDamageProduct"]);
	$html.=input_field(["label"=>"Product Name","type"=>"text","name"=>"txtProductName"]);
	$html.=input_field(["label"=>"Branch Name","type"=>"text","name"=>"txtBranchName"]);
	$html.=input_field(["label"=>"Quantity","type"=>"text","name"=>"txtQuantity"]);
	$html.=input_field(["label"=>"Price","type"=>"text","name"=>"txtPrice"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnCreate", "value"=>"Create"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
