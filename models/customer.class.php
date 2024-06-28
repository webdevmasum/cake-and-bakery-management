<?php
class Customer implements JsonSerializable{
	public $id;
	public $name;
	public $mobile;
	public $email;
	public $created_at;
	public $updated_at;
	public $address;

	public function __construct(){
	}
	public function set($id,$name,$mobile,$email,$created_at,$updated_at,$address){
		$this->id=$id;
		$this->name=$name;
		$this->mobile=$mobile;
		$this->email=$email;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;
		$this->address=$address;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}customers(name,mobile,email,created_at,updated_at,address)values('$this->name','$this->mobile','$this->email','$this->created_at','$this->updated_at','$this->address')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}customers set name='$this->name',mobile='$this->mobile',email='$this->email',created_at='$this->created_at',updated_at='$this->updated_at',address='$this->address' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}customers where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name,mobile,email,created_at,updated_at,address from {$tx}customers");
		$data=[];
		while($customer=$result->fetch_object()){
			$data[]=$customer;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,mobile,email,created_at,updated_at,address from {$tx}customers $criteria limit $top,$perpage");
		$data=[];
		while($customer=$result->fetch_object()){
			$data[]=$customer;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}customers $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,mobile,email,created_at,updated_at,address from {$tx}customers where id='$id'");
		$customer=$result->fetch_object();
			return $customer;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}customers");
		$customer =$result->fetch_object();
		return $customer->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		Mobile:$this->mobile<br> 
		Email:$this->email<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
		Address:$this->address<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbCustomer"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}customers");
		while($customer=$result->fetch_object()){
			$html.="<option value ='$customer->id'>$customer->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}customers $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,name,mobile,email,created_at,updated_at,address from {$tx}customers $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-customer\">New Customer</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Name</th><th>Mobile</th><th>Email</th><th>Created At</th><th>Updated At</th><th>Address</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th><th>Mobile</th><th>Email</th><th>Created At</th><th>Updated At</th><th>Address</th></tr>";
		}
		while($customer=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button(["id"=>$customer->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-customer"]);
				$action_buttons.= action_button(["id"=>$customer->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-customer"]);
				$action_buttons.= action_button(["id"=>$customer->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"customers"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$customer->id</td><td>$customer->name</td><td>$customer->mobile</td><td>$customer->email</td><td>$customer->created_at</td><td>$customer->updated_at</td><td>$customer->address</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,name,mobile,email,created_at,updated_at,address from {$tx}customers where id={$id}");
		$customer=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Customer Details</th></tr>";
		$html.="<tr><th>Id</th><td>$customer->id</td></tr>";
		$html.="<tr><th>Name</th><td>$customer->name</td></tr>";
		$html.="<tr><th>Mobile</th><td>$customer->mobile</td></tr>";
		$html.="<tr><th>Email</th><td>$customer->email</td></tr>";
		$html.="<tr><th>Created At</th><td>$customer->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$customer->updated_at</td></tr>";
		$html.="<tr><th>Address</th><td>$customer->address</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
