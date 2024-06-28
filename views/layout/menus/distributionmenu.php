<?php
	echo main_sidebar_dropdown([
		"name"=>"Distribution",
		"icon"=>"nav-icon fa fa-sitemap",
		"links"=>[
			["route"=>"create-distribution","text"=>"Create Distribution","icon"=>"far fa-circle nav-icon"],
			["route"=>"distribution","text"=>"Manage Distribution","icon"=>"far fa-circle nav-icon"],
		]
	]);
?>
