<?php
class Order implements JsonSerializable{
	public $id;
	public $customer_id;
	public $order_date;
	public $delivery_date;
	public $shipping_address;
	public $order_total;
	public $paid_amount;
	public $remark;
	public $status_id;
	public $discount;
	public $vat;
	public $created_at;
	public $updated_at;

	public function __construct(){
	}
	public function set($id,$customer_id,$order_date,$delivery_date,$shipping_address,$order_total,$paid_amount,$remark,$status_id,$discount,$vat,$created_at,$updated_at){
		$this->id=$id;
		$this->customer_id=$customer_id;
		$this->order_date=$order_date;
		$this->delivery_date=$delivery_date;
		$this->shipping_address=$shipping_address;
		$this->order_total=$order_total;
		$this->paid_amount=$paid_amount;
		$this->remark=$remark;
		$this->status_id=$status_id;
		$this->discount=$discount;
		$this->vat=$vat;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}orders(customer_id,order_date,delivery_date,shipping_address,order_total,paid_amount,remark,status_id,discount,vat,created_at,updated_at)values('$this->customer_id','$this->order_date','$this->delivery_date','$this->shipping_address','$this->order_total','$this->paid_amount','$this->remark','$this->status_id','$this->discount','$this->vat','$this->created_at','$this->updated_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}orders set customer_id='$this->customer_id',order_date='$this->order_date',delivery_date='$this->delivery_date',shipping_address='$this->shipping_address',order_total='$this->order_total',paid_amount='$this->paid_amount',remark='$this->remark',status_id='$this->status_id',discount='$this->discount',vat='$this->vat',created_at='$this->created_at',updated_at='$this->updated_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}orders where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,customer_id,order_date,delivery_date,shipping_address,order_total,paid_amount,remark,status_id,discount,vat,created_at,updated_at from {$tx}orders");
		$data=[];
		while($order=$result->fetch_object()){
			$data[]=$order;
		}
			return $data;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,customer_id,order_date,delivery_date,shipping_address,order_total,paid_amount,remark,status_id,discount,vat,created_at,updated_at from {$tx}orders where id='$id'");
		$order=$result->fetch_object();
			return $order;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}orders");
		$order =$result->fetch_object();
		return $order->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
			Customer Id:$this->customer_id<br> 
			Order Date:$this->order_date<br> 
			Delivery Date:$this->delivery_date<br> 
			Shipping Address:$this->shipping_address<br> 
			Order Total:$this->order_total<br> 
			Paid Amount:$this->paid_amount<br> 
			Remark:$this->remark<br> 
			Status Id:$this->status_id<br> 
			Discount:$this->discount<br> 
			Vat:$this->vat<br> 
			Created At:$this->created_at<br> 
			Updated At:$this->updated_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbOrder"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}orders");
		while($order=$result->fetch_object()){
			$html.="<option value ='$order->id'>$order->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}orders");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;

         //select o.id,o.customer_id,o.order_date,o.delivery_date,o.shipping_address,o.order_total,o.paid_amount,o.remark,s.name status from core_orders o,core_status s where s.id=o.status_id
		//select o.id,c.name customer,o.order_date,o.delivery_date,o.shipping_address,o.order_total,o.paid_amount,o.remark,s.name status from core_orders o,core_status s,core_customers c where s.id=o.status_id and c.id=o.customer_id
		 //$result=$db->query("select id,customer_id,order_date,delivery_date,shipping_address,order_total,paid_amount,remark,status_id from {$tx}orders order by id desc limit $top,$perpage");
		$result=$db->query("select o.id,c.name customer,o.order_date,o.delivery_date,o.shipping_address,o.order_total,o.paid_amount,o.remark,s.name status from core_orders o,core_status s,core_customers c where s.id=o.status_id and c.id=o.customer_id order by o.id desc limit $top,$perpage");
		
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-order\">New Order</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Customer</th><th>Order Date</th><th>Delivery Date</th><th>Shipping Address</th><th>Order Total</th><th>Paid Amount</th><th>Remark</th><th>Status</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Customer</th><th>Order Date</th><th>Delivery Date</th><th>Shipping Address</th><th>Order Total</th><th>Paid Amount</th><th>Remark</th><th>Status</th></tr>";
		}
		while($order=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button(["id"=>$order->id, "name"=>"Details", "value"=>"Detials", "class"=>"info", "url"=>"details-order"]);
				$action_buttons.= action_button(["id"=>$order->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-order"]);
				$action_buttons.= action_button(["id"=>$order->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"orders"]);
				$action_buttons.= "</div></td>";
			}
             
			$odate=date("d-m-Y",strtotime($order->order_date));
			$ddate=date("d-m-Y",strtotime($order->delivery_date));

			$html.="<tr><td>$order->id</td><td>$order->customer</td><td>$odate</td><td>$ddate</td><td>$order->shipping_address</td><td>$order->order_total</td><td>$order->paid_amount</td><td>$order->remark</td><td>$order->status</td></td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,customer_id,order_date,delivery_date,shipping_address,order_total,paid_amount,remark,status_id,discount,vat,created_at,updated_at from {$tx}orders where id={$id}");
		$order=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Order Details</th></tr>";
		$html.="<tr><th>Id</th><td>$order->id</td></tr>";
		$html.="<tr><th>Customer Id</th><td>$order->customer_id</td></tr>";
		$html.="<tr><th>Order Date</th><td>$order->order_date</td></tr>";
		$html.="<tr><th>Delivery Date</th><td>$order->delivery_date</td></tr>";
		$html.="<tr><th>Shipping Address</th><td>$order->shipping_address</td></tr>";
		$html.="<tr><th>Order Total</th><td>$order->order_total</td></tr>";
		$html.="<tr><th>Paid Amount</th><td>$order->paid_amount</td></tr>";
		$html.="<tr><th>Remark</th><td>$order->remark</td></tr>";
		$html.="<tr><th>Status Id</th><td>$order->status_id</td></tr>";
		$html.="<tr><th>Discount</th><td>$order->discount</td></tr>";
		$html.="<tr><th>Vat</th><td>$order->vat</td></tr>";
		$html.="<tr><th>Created At</th><td>$order->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$order->updated_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
