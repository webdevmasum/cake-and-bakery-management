<?php
if($page=="create-rawmaterialsstock"){
	$found=include("views/pages/ui/rawmaterialsstock/create_rawmaterialsstock.php");
}elseif($page=="edit-rawmaterialsstock"){
	$found=include("views/pages/ui/rawmaterialsstock/edit_rawmaterialsstock.php");
}elseif($page=="raw_materials_stock"){
	$found=include("views/pages/ui/rawmaterialsstock/manage_rawmaterialsstock.php");
}elseif($page=="details-rawmaterialsstock"){
	$found=include("views/pages/ui/rawmaterialsstock/details_rawmaterialsstock.php");
}elseif($page=="view-rawmaterialsstock"){
	$found=include("views/pages/ui/rawmaterialsstock/view_rawmaterialsstock.php");
}
?>
