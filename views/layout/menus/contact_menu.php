<?php
	echo main_sidebar_dropdown([
		"name"=>"Contact",
		"icon"=>"nav-icon fa fa-address-book",
		"links"=>[
			["route"=>"create-contact","text"=>"Create Contact","icon"=>"far fa-circle nav-icon"],
			["route"=>"contacts","text"=>"Manage Contact","icon"=>"far fa-circle nav-icon"],
		]
	]);
?>
