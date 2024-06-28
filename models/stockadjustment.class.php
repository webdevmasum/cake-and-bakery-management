<?php
class StockAdjustment implements JsonSerializable{
	public $id;
	public $name;
	public $damage_product;
	public $product_name;
	public $branch_name;
	public $quantity;
	public $price;

	public function __construct(){
	}
	public function set($id,$name,$damage_product,$product_name,$branch_name,$quantity,$price){
		$this->id=$id;
		$this->name=$name;
		$this->damage_product=$damage_product;
		$this->product_name=$product_name;
		$this->branch_name=$branch_name;
		$this->quantity=$quantity;
		$this->price=$price;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}stock_adjustment(name,damage_product,product_name,branch_name,quantity,price)values('$this->name','$this->damage_product','$this->product_name','$this->branch_name','$this->quantity','$this->price')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}stock_adjustment set name='$this->name',damage_product='$this->damage_product',product_name='$this->product_name',branch_name='$this->branch_name',quantity='$this->quantity',price='$this->price' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}stock_adjustment where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name,damage_product,product_name,branch_name,quantity,price from {$tx}stock_adjustment");
		$data=[];
		while($stockadjustment=$result->fetch_object()){
			$data[]=$stockadjustment;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,damage_product,product_name,branch_name,quantity,price from {$tx}stock_adjustment $criteria limit $top,$perpage");
		$data=[];
		while($stockadjustment=$result->fetch_object()){
			$data[]=$stockadjustment;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}stock_adjustment $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,damage_product,product_name,branch_name,quantity,price from {$tx}stock_adjustment where id='$id'");
		$stockadjustment=$result->fetch_object();
			return $stockadjustment;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}stock_adjustment");
		$stockadjustment =$result->fetch_object();
		return $stockadjustment->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		Damage Product:$this->damage_product<br> 
		Product Name:$this->product_name<br> 
		Branch Name:$this->branch_name<br> 
		Quantity:$this->quantity<br> 
		Price:$this->price<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbStockAdjustment"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}stock_adjustment");
		while($stockadjustment=$result->fetch_object()){
			$html.="<option value ='$stockadjustment->id'>$stockadjustment->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}stock_adjustment $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,name,damage_product,product_name,branch_name,quantity,price from {$tx}stock_adjustment $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-stockadjustment\">New StockAdjustment</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Name</th><th>Damage Product</th><th>Product Name</th><th>Branch Name</th><th>Quantity</th><th>Price</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th><th>Damage Product</th><th>Product Name</th><th>Branch Name</th><th>Quantity</th><th>Price</th></tr>";
		}
		while($stockadjustment=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button(["id"=>$stockadjustment->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-stockadjustment"]);
				$action_buttons.= action_button(["id"=>$stockadjustment->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-stockadjustment"]);
				$action_buttons.= action_button(["id"=>$stockadjustment->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"stock_adjustment"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$stockadjustment->id</td><td>$stockadjustment->name</td><td>$stockadjustment->damage_product</td><td>$stockadjustment->product_name</td><td>$stockadjustment->branch_name</td><td>$stockadjustment->quantity</td><td>$stockadjustment->price</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,name,damage_product,product_name,branch_name,quantity,price from {$tx}stock_adjustment where id={$id}");
		$stockadjustment=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">StockAdjustment Details</th></tr>";
		$html.="<tr><th>Id</th><td>$stockadjustment->id</td></tr>";
		$html.="<tr><th>Name</th><td>$stockadjustment->name</td></tr>";
		$html.="<tr><th>Damage Product</th><td>$stockadjustment->damage_product</td></tr>";
		$html.="<tr><th>Product Name</th><td>$stockadjustment->product_name</td></tr>";
		$html.="<tr><th>Branch Name</th><td>$stockadjustment->branch_name</td></tr>";
		$html.="<tr><th>Quantity</th><td>$stockadjustment->quantity</td></tr>";
		$html.="<tr><th>Price</th><td>$stockadjustment->price</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
