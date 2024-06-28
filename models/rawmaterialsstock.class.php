<?php
class RawMaterialsStock implements JsonSerializable{
	public $id;
	public $product_id;
	public $qty;
	public $transaction_type_id;
	public $remark;
	public $created_at;
	public $warehouse_id;

	public function __construct(){
	}
	public function set($id,$product_id,$qty,$transaction_type_id,$remark,$created_at,$warehouse_id){
		$this->id=$id;
		$this->product_id=$product_id;
		$this->qty=$qty;
		$this->transaction_type_id=$transaction_type_id;
		$this->remark=$remark;
		$this->created_at=$created_at;
		$this->warehouse_id=$warehouse_id;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}raw_materials_stock(product_id,qty,transaction_type_id,remark,created_at,warehouse_id)values('$this->product_id','$this->qty','$this->transaction_type_id','$this->remark','$this->created_at','$this->warehouse_id')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}raw_materials_stock set product_id='$this->product_id',qty='$this->qty',transaction_type_id='$this->transaction_type_id',remark='$this->remark',created_at='$this->created_at',warehouse_id='$this->warehouse_id' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}raw_materials_stock where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,product_id,qty,transaction_type_id,remark,created_at,warehouse_id from {$tx}raw_materials_stock");
		$data=[];
		while($rawmaterialsstock=$result->fetch_object()){
			$data[]=$rawmaterialsstock;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,product_id,qty,transaction_type_id,remark,created_at,warehouse_id from {$tx}raw_materials_stock $criteria limit $top,$perpage");
		$data=[];
		while($rawmaterialsstock=$result->fetch_object()){
			$data[]=$rawmaterialsstock;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}raw_materials_stock $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,product_id,qty,transaction_type_id,remark,created_at,warehouse_id from {$tx}raw_materials_stock where id='$id'");
		$rawmaterialsstock=$result->fetch_object();
			return $rawmaterialsstock;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}raw_materials_stock");
		$rawmaterialsstock =$result->fetch_object();
		return $rawmaterialsstock->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Product Id:$this->product_id<br> 
		Qty:$this->qty<br> 
		Transaction Type Id:$this->transaction_type_id<br> 
		Remark:$this->remark<br> 
		Created At:$this->created_at<br> 
		Warehouse Id:$this->warehouse_id<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbRawMaterialsStock"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}raw_materials_stock");
		while($rawmaterialsstock=$result->fetch_object()){
			$html.="<option value ='$rawmaterialsstock->id'>$rawmaterialsstock->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}raw_materials_stock $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		// $result=$db->query("select id,product_id,qty,transaction_type_id,remark,created_at,warehouse_id from {$tx}raw_materials_stock $criteria limit $top,$perpage");
		$result=$db->query("select id,product_id,qty,transaction_type_id,remark,created_at,warehouse_id from {$tx}raw_materials_stock $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-rawmaterialsstock\">New RawMaterialsStock</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Product Id</th><th>Qty</th><th>Transaction Type Id</th><th>Remark</th><th>Created At</th><th>Warehouse Id</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Product Id</th><th>Qty</th><th>Transaction Type Id</th><th>Remark</th><th>Created At</th><th>Warehouse Id</th></tr>";
		}
		while($rawmaterialsstock=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button(["id"=>$rawmaterialsstock->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-rawmaterialsstock"]);
				$action_buttons.= action_button(["id"=>$rawmaterialsstock->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-rawmaterialsstock"]);
				$action_buttons.= action_button(["id"=>$rawmaterialsstock->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"raw_materials_stock"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$rawmaterialsstock->id</td><td>$rawmaterialsstock->product_id</td><td>$rawmaterialsstock->qty</td><td>$rawmaterialsstock->transaction_type_id</td><td>$rawmaterialsstock->remark</td><td>$rawmaterialsstock->created_at</td><td>$rawmaterialsstock->warehouse_id</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,product_id,qty,transaction_type_id,remark,created_at,warehouse_id from {$tx}raw_materials_stock where id={$id}");
		$rawmaterialsstock=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">RawMaterialsStock Details</th></tr>";
		$html.="<tr><th>Id</th><td>$rawmaterialsstock->id</td></tr>";
		$html.="<tr><th>Product Id</th><td>$rawmaterialsstock->product_id</td></tr>";
		$html.="<tr><th>Qty</th><td>$rawmaterialsstock->qty</td></tr>";
		$html.="<tr><th>Transaction Type Id</th><td>$rawmaterialsstock->transaction_type_id</td></tr>";
		$html.="<tr><th>Remark</th><td>$rawmaterialsstock->remark</td></tr>";
		$html.="<tr><th>Created At</th><td>$rawmaterialsstock->created_at</td></tr>";
		$html.="<tr><th>Warehouse Id</th><td>$rawmaterialsstock->warehouse_id</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
