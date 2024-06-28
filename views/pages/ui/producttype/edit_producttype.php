<?php
if(isset($_POST["btnEdit"])){
	$producttype=ProductType::find($_POST["txtId"]);
}
if(isset($_POST["btnUpdate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}

*/
	if(count($errors)==0){
		$producttype=new ProductType();
		$producttype->id=$_POST["txtId"];
		$producttype->name=$_POST["txtName"];

		$producttype->update();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="product_types">Manage ProductType</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='edit-producttype' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Id","type"=>"hidden","name"=>"txtId","value"=>"$producttype->id"]);
	$html.=input_field(["label"=>"Name","type"=>"text","name"=>"txtName","value"=>"$producttype->name"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnUpdate", "value"=>"Update"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
