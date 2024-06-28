<?php
	echo main_sidebar_dropdown([
		"name"=>"Production",
		"icon"=>"nav-icon fa fa-tasks",
		"links"=>[

			["route"=>"create-bom","text"=>"Create BoM","icon"=>"far fa-circle nav-icon"],
			["route"=>"boms","text"=>"Manage BoM","icon"=>"far fa-circle nav-icon"],

			["route"=>"create-production","text"=>"Create Production","icon"=>"far fa-circle nav-icon"],
			["route"=>"production","text"=>"Manage Production","icon"=>"far fa-circle nav-icon"],

			["route"=>"create-stock","text"=>"Create Product Stock","icon"=>"far fa-circle nav-icon"],
			["route"=>"stocks","text"=>"Manage Product Stock","icon"=>"far fa-circle nav-icon"],
		]
	]);
?>
