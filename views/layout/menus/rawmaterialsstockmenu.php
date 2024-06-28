<?php
	echo main_sidebar_dropdown([
		"name"=>"RM Stock",
		"icon"=>"nav-icon fa fa-wrench",
		"links"=>[
			["route"=>"create-rawmaterialsstock","text"=>"Create RM Stock","icon"=>"far fa-circle nav-icon"],
			["route"=>"raw_materials_stock","text"=>"Manage RM Stock","icon"=>"far fa-circle nav-icon"],
		]
	]);
?>
