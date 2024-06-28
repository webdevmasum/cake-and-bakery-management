<?php
	echo main_sidebar_dropdown([
		"name"=>"Stock Adjustment",
		"icon"=>"nav-icon fa fa-gg-circle",
		"links"=>[
			["route"=>"create-stockadjustment","text"=>"Create Stock Adjustment","icon"=>"far fa-circle nav-icon"],
			["route"=>"stock_adjustment","text"=>"Manage Stock Adjustment","icon"=>"far fa-circle nav-icon"],
		]
	]);
?>
