<?php
class Production implements JsonSerializable{
	public $id;
	public $product_name;
	public $manufacturer_id;
	public $quantity;
	public $price;

	public function __construct(){
	}
	public function set($id,$product_name,$manufacturer_id,$quantity,$price){
		$this->id=$id;
		$this->product_name=$product_name;
		$this->manufacturer_id=$manufacturer_id;
		$this->quantity=$quantity;
		$this->price=$price;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}production(product_name,manufacturer_id,quantity,price)values('$this->product_name','$this->manufacturer_id','$this->quantity','$this->price')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}production set product_name='$this->product_name',manufacturer_id='$this->manufacturer_id',quantity='$this->quantity',price='$this->price' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}production where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,product_name,manufacturer_id,quantity,price from {$tx}production");
		$data=[];
		while($production=$result->fetch_object()){
			$data[]=$production;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,product_name,manufacturer_id,quantity,price from {$tx}production $criteria limit $top,$perpage");
		$data=[];
		while($production=$result->fetch_object()){
			$data[]=$production;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}production $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,product_name,manufacturer_id,quantity,price from {$tx}production where id='$id'");
		$production=$result->fetch_object();
			return $production;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}production");
		$production =$result->fetch_object();
		return $production->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Product Name:$this->product_name<br> 
		Manufacturer Id:$this->manufacturer_id<br> 
		Quantity:$this->quantity<br> 
		Price:$this->price<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbProduction"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}production");
		while($production=$result->fetch_object()){
			$html.="<option value ='$production->id'>$production->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}production $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,product_name,manufacturer_id,quantity,price from {$tx}production $criteria limit $top,$perpage");

		// $result=$db->query("select pp.id,pp.product_name,pm.name manufacturer,pp.quantity,pp.price from core_production pp,core_manufacturers pm where pp.manufacturer_id=pm.id $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-production\">New Production</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Product Name</th><th>Quantity</th><th>Price</th></tr>";
		}
		while($production=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button(["id"=>$production->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-production"]);
				$action_buttons.= action_button(["id"=>$production->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-production"]);
				$action_buttons.= action_button(["id"=>$production->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"production"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$production->id</td><td>$production->product_name</td><td>$production->quantity</td><td>$production->price</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,product_name,manufacturer_id,quantity,price from {$tx}production where id={$id}");
		$production=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Production Details</th></tr>";
		$html.="<tr><th>Id</th><td>$production->id</td></tr>";
		$html.="<tr><th>Product Name</th><td>$production->product_name</td></tr>";
		// $html.="<tr><th>Manufacturer Id</th><td>$production->manufacturer_id</td></tr>";
		$html.="<tr><th>Quantity</th><td>$production->quantity</td></tr>";
		$html.="<tr><th>Price</th><td>$production->price</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
