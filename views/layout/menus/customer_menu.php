<?php
	echo main_sidebar_dropdown([
		"name"=>"Customers",
		"icon"=>"nav-icon fa fa-users",
		"links"=>[
			["route"=>"create-customer","text"=>"Create Customer","icon"=>"far fa-circle nav-icon"],
			["route"=>"customers","text"=>"Manage Customer","icon"=>"far fa-circle nav-icon"],
		]
	]);
?>
