<?php
class Stoce implements JsonSerializable{

	public function __construct(){
	}
	public function set(){

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}stoces()values()");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}stoces set  where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}stoces where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select  from {$tx}stoces");
		$data=[];
		while($stoce=$result->fetch_object()){
			$data[]=$stoce;
		}
			return $data;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select  from {$tx}stoces where id='$id'");
		$stoce=$result->fetch_object();
			return $stoce;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}stoces");
		$stoce =$result->fetch_object();
		return $stoce->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "";
	}

	//-------------HTML----------//

	static function html_select($name="cmbStoce"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}stoces");
		while($stoce=$result->fetch_object()){
			$html.="<option value ='$stoce->id'>$stoce->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}stoces");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select  from {$tx}stoces limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-stoce\">New Stoce</a></th></tr>";
		if($action){
			$html.="<tr><th>Action</th></tr>";
		}else{
			$html.="<tr></tr>";
		}
		while($stoce=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button(["id"=>$stoce->id, "name"=>"Details", "value"=>"Detials", "class"=>"info", "url"=>"details-stoce"]);
				$action_buttons.= action_button(["id"=>$stoce->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-stoce"]);
				$action_buttons.= action_button(["id"=>$stoce->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"stoces"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select  from {$tx}stoces where id={$id}");
		$stoce=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Stoce Details</th></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
