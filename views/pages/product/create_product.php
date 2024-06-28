<?php
if(isset($_POST["btnCreate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtOfferPrice"])){
		$errors["offer_price"]="Invalid offer_price";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtRegularPrice"])){
		$errors["regular_price"]="Invalid regular_price";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtDescription"])){
		$errors["description"]="Invalid description";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPhoto"])){
		$errors["photo"]="Invalid photo";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbProductCategoryId"])){
		$errors["product_category_id"]="Invalid product_category_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbSectionId"])){
		$errors["section_id"]="Invalid section_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbUomId"])){
		$errors["uom_id"]="Invalid uom_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtWeight"])){
		$errors["weight"]="Invalid weight";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtQuantity"])){
		$errors["quantity"]="Invalid quantity";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbProductTypeId"])){
		$errors["product_type_id"]="Invalid product_type_id";
	}

*/
	if(count($errors)==0){
		$product=new Product();
		$product->name=$_POST["txtName"];
		$product->offer_price=$_POST["txtOfferPrice"];
		$product->regular_price=$_POST["txtRegularPrice"];
		$product->description=$_POST["txtDescription"];
		$product->photo=upload($_FILES["filePhoto"], "img", date("YmdHis"));
		$product->product_category_id=$_POST["cmbProductCategoryId"];
		$product->section_id=$_POST["cmbSectionId"];
		$product->uom_id=$_POST["cmbUomId"];
		$product->weight=$_POST["txtWeight"];
		$product->created_at=$now;
		$product->created_at=$now;
		$product->updated_at=$now;
		$product->updated_at=$now;
		$product->quantity=$_POST["txtQuantity"];
		$product->product_type_id=$_POST["cmbProductTypeId"];

		$product->save();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="products">Manage Product</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='create-product' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Name","type"=>"text","name"=>"txtName"]);
	$html.=input_field(["label"=>"Offer Price","type"=>"text","name"=>"txtOfferPrice"]);
	$html.=input_field(["label"=>"Regular Price","type"=>"text","name"=>"txtRegularPrice"]);
	$html.=input_field(["label"=>"Description","type"=>"text","name"=>"txtDescription"]);
	$html.=input_field(["label"=>"Photo","type"=>"file","name"=>"filePhoto"]);
	$html.=select_field(["label"=>"Product Category","name"=>"cmbProductCategoryId","table"=>"product_categories"]);
	$html.=select_field(["label"=>"Section","name"=>"cmbSectionId","table"=>"sections"]);
	$html.=select_field(["label"=>"Uom","name"=>"cmbUomId","table"=>"uoms"]);
	$html.=input_field(["label"=>"Weight","type"=>"text","name"=>"txtWeight"]);
	$html.=input_field(["label"=>"Quantity","type"=>"text","name"=>"txtQuantity"]);
	$html.=select_field(["label"=>"Product Type","name"=>"cmbProductTypeId","table"=>"product_types"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnCreate", "value"=>"Create"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
