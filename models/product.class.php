<?php
class Product implements JsonSerializable{
	public $id;
	public $name;
	public $offer_price;
	public $regular_price;
	public $description;
	public $photo;
	public $product_category_id;
	public $section_id;
	public $uom_id;
	public $weight;
	public $created_at;
	public $updated_at;
	public $quantity;
	public $product_type_id;

	public function __construct(){
	}
	public function set($id,$name,$offer_price,$regular_price,$description,$photo,$product_category_id,$section_id,$uom_id,$weight,$created_at,$updated_at,$quantity,$product_type_id){
		$this->id=$id;
		$this->name=$name;
		$this->offer_price=$offer_price;
		$this->regular_price=$regular_price;
		$this->description=$description;
		$this->photo=$photo;
		$this->product_category_id=$product_category_id;
		$this->section_id=$section_id;
		$this->uom_id=$uom_id;
		$this->weight=$weight;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;
		$this->quantity=$quantity;
		$this->product_type_id=$product_type_id;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}products(name,offer_price,regular_price,description,photo,product_category_id,section_id,uom_id,weight,created_at,updated_at,quantity,product_type_id)values('$this->name','$this->offer_price','$this->regular_price','$this->description','$this->photo','$this->product_category_id','$this->section_id','$this->uom_id','$this->weight','$this->created_at','$this->updated_at','$this->quantity','$this->product_type_id')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}products set name='$this->name',offer_price='$this->offer_price',regular_price='$this->regular_price',description='$this->description',photo='$this->photo',product_category_id='$this->product_category_id',section_id='$this->section_id',uom_id='$this->uom_id',weight='$this->weight',created_at='$this->created_at',updated_at='$this->updated_at',quantity='$this->quantity',product_type_id='$this->product_type_id' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}products where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name,offer_price,regular_price,description,photo,product_category_id,section_id,uom_id,weight,created_at,updated_at,quantity,product_type_id from {$tx}products");
		$data=[];
		while($product=$result->fetch_object()){
			$data[]=$product;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,offer_price,regular_price,description,photo,product_category_id,section_id,uom_id,weight,created_at,updated_at,quantity,product_type_id from {$tx}products $criteria limit $top,$perpage");
		$data=[];
		while($product=$result->fetch_object()){
			$data[]=$product;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}products $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,offer_price,regular_price,description,photo,product_category_id,section_id,uom_id,weight,created_at,updated_at,quantity,product_type_id from {$tx}products where id='$id'");
		$product=$result->fetch_object();
			return $product;
	}
	
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}products");
		$product =$result->fetch_object();
		return $product->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		Offer Price:$this->offer_price<br> 
		Regular Price:$this->regular_price<br> 
		Description:$this->description<br> 
		Photo:$this->photo<br> 
		Product Category Id:$this->product_category_id<br> 
		Section Id:$this->section_id<br> 
		Uom Id:$this->uom_id<br> 
		Weight:$this->weight<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
		Quantity:$this->quantity<br> 
		Product Type Id:$this->product_type_id<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbProducts"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}products");
		while($product=$result->fetch_object()){
			$html.="<option value ='$product->id'>$product->name</option>";
		}
		$html.="</select>";
		return $html;
	}


	static function html_select_finished_good($name="cmbProduct"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}products where product_type_id=1");
		while($product=$result->fetch_object()){
			$html.="<option value ='$product->id'>$product->name</option>";
		}
		$html.="</select>";
		return $html;
	}

	static function html_select_raw_materials($name="cmbProduct"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}products where product_type_id=2");
		while($product=$result->fetch_object()){
			$html.="<option value ='$product->id'>$product->name</option>";
		}
		$html.="</select>";
		return $html;
	}



	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}products $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		// $result=$db->query("select id,name,offer_price,regular_price,description,photo,product_category_id,section_id,uom_id,weight,created_at,updated_at,quantity,product_type_id from {$tx}products $criteria limit $top,$perpage");

		$result=$db->query("
		select p.id,p.name,p.offer_price,p.regular_price,p.photo,pc.name category,pou.name uom,p.weight,p.created_at,p.updated_at,pt.name product_type from core_products p,core_product_categories pc,core_uoms pou,core_product_types pt where p.product_category_id=pc.id and p.uom_id=pou.id and p.product_type_id=pt.id $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-product\">New Product</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Name</th><th>Offer Price</th><th>Regular Price</th><th>Photo</th><th>Uom</th><th>Weight</th><th>Created At</th><th>Updated At</th><th>Product Type Id</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th><th>Offer Price</th><th>Regular Price</th><th>Photo</th><th>Uom Id</th><th>Weight</th><th>Created At</th><th>Updated At</th><th>Product Type Id</th></tr>";
		}
		while($product=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button(["id"=>$product->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-product"]);
				$action_buttons.= action_button(["id"=>$product->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-product"]);
				$action_buttons.= action_button(["id"=>$product->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"products"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$product->id</td><td>$product->name</td><td>$product->offer_price</td><td>$product->regular_price</td><td><img src='img/$product->photo' width='100' /></td><td>$product->uom</td><td>$product->weight</td><td>$product->created_at</td><td>$product->updated_at</td><td>$product->product_type</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,name,offer_price,regular_price,description,photo,product_category_id,section_id,uom_id,weight,created_at,updated_at,quantity,product_type_id from {$tx}products where id={$id}");
		$product=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Product Details</th></tr>";
		$html.="<tr><th>Id</th><td>$product->id</td></tr>";
		$html.="<tr><th>Name</th><td>$product->name</td></tr>";
		$html.="<tr><th>Offer Price</th><td>$product->offer_price</td></tr>";
		$html.="<tr><th>Regular Price</th><td>$product->regular_price</td></tr>";
		$html.="<tr><th>Description</th><td>$product->description</td></tr>";
		$html.="<tr><th>Photo</th><td><img src=\'img/$product->photo\' width=\'100\' /></td></tr>";
		$html.="<tr><th>Product Category Id</th><td>$product->product_category_id</td></tr>";
		$html.="<tr><th>Section Id</th><td>$product->section_id</td></tr>";
		$html.="<tr><th>Uom Id</th><td>$product->uom_id</td></tr>";
		$html.="<tr><th>Weight</th><td>$product->weight</td></tr>";
		$html.="<tr><th>Created At</th><td>$product->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$product->updated_at</td></tr>";
		$html.="<tr><th>Quantity</th><td>$product->quantity</td></tr>";
		$html.="<tr><th>Product Type Id</th><td>$product->product_type_id</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
