<?php
class Distribution implements JsonSerializable{
	public $id;
	public $product_name;
	public $quantity;
	public $price;
	public $warehouses_id;

	public function __construct(){
	}
	public function set($id,$product_name,$quantity,$price,$warehouses_id){
		$this->id=$id;
		$this->product_name=$product_name;
		$this->quantity=$quantity;
		$this->price=$price;
		$this->warehouses_id=$warehouses_id;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}distribution(product_name,quantity,price,warehouses_id)values('$this->product_name','$this->quantity','$this->price','$this->warehouses_id')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}distribution set product_name='$this->product_name',quantity='$this->quantity',price='$this->price',warehouses_id='$this->warehouses_id' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}distribution where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,product_name,quantity,price,warehouses_id from {$tx}distribution");
		$data=[];
		while($distribution=$result->fetch_object()){
			$data[]=$distribution;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,product_name,quantity,price,warehouses_id from {$tx}distribution $criteria limit $top,$perpage");
		$data=[];
		while($distribution=$result->fetch_object()){
			$data[]=$distribution;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}distribution $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,product_name,quantity,price,warehouses_id from {$tx}distribution where id='$id'");
		$distribution=$result->fetch_object();
			return $distribution;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}distribution");
		$distribution =$result->fetch_object();
		return $distribution->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Product Name:$this->product_name<br> 
		Quantity:$this->quantity<br> 
		Price:$this->price<br> 
		Warehouses Id:$this->warehouses_id<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbDistribution"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}distribution");
		while($distribution=$result->fetch_object()){
			$html.="<option value ='$distribution->id'>$distribution->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}distribution $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,product_name,quantity,price,warehouses_id from {$tx}distribution $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-distribution\">New Distribution</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Warehouses Id</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Warehouses Id</th></tr>";
		}
		while($distribution=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button(["id"=>$distribution->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-distribution"]);
				$action_buttons.= action_button(["id"=>$distribution->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-distribution"]);
				$action_buttons.= action_button(["id"=>$distribution->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"distribution"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$distribution->id</td><td>$distribution->product_name</td><td>$distribution->quantity</td><td>$distribution->price</td><td>$distribution->warehouses_id</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,product_name,quantity,price,warehouses_id from {$tx}distribution where id={$id}");
		$distribution=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Distribution Details</th></tr>";
		$html.="<tr><th>Id</th><td>$distribution->id</td></tr>";
		$html.="<tr><th>Product Name</th><td>$distribution->product_name</td></tr>";
		$html.="<tr><th>Quantity</th><td>$distribution->quantity</td></tr>";
		$html.="<tr><th>Price</th><td>$distribution->price</td></tr>";
		$html.="<tr><th>Warehouses Id</th><td>$distribution->warehouses_id</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
