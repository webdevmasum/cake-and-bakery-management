<?php
if($page=="create-contactcategory"){
	$found=include("views/pages/ui/contactcategory/create_contactcategory.php");
}elseif($page=="edit-contactcategory"){
	$found=include("views/pages/ui/contactcategory/edit_contactcategory.php");
}elseif($page=="contact_categories"){
	$found=include("views/pages/ui/contactcategory/manage_contactcategory.php");
}elseif($page=="details-contactcategory"){
	$found=include("views/pages/ui/contactcategory/details_contactcategory.php");
}elseif($page=="view-contactcategory"){
	$found=include("views/pages/ui/contactcategory/view_contactcategory.php");
}
?>