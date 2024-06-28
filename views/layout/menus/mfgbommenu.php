<?php
	echo main_sidebar_dropdown([
		"name"=>"MfgBom",
		"icon"=>"nav-icon fa fa-wrench",
		"links"=>[
			["route"=>"create-mfgbom","text"=>"Create MfgBom","icon"=>"far fa-circle nav-icon"],
			["route"=>"mfg_boms","text"=>"Manage MfgBom","icon"=>"far fa-circle nav-icon"],
		]
	]);
?>
