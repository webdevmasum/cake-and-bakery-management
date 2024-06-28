<?php
	echo main_sidebar_dropdown([
		"name"=>"Order",
		"icon"=>"nav-icon fa fa-shopping-cart",
		"links"=>[
			["route"=>"create-order","text"=>"Create Order","icon"=>"far fa-circle nav-icon"],
			["route"=>"orders","text"=>"Manage Order","icon"=>"far fa-circle nav-icon"],

			// ["route"=>"tailor-order","text"=>"Create Tailor Order","icon"=>"far fa-circle nav-icon"],
			// ["route"=>"restaurant-order","text"=>"Create Restaurant Order","icon"=>"far fa-circle nav-icon"],
			// ["route"=>"electronics-order","text"=>"Create Electronics Order","icon"=>"far fa-circle nav-icon"],
			// ["route"=>"service-order","text"=>"Create Service Order","icon"=>"far fa-circle nav-icon"],

			
		]
	]);
?>
