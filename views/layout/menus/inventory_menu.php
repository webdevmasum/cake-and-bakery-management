
<?php
	echo main_sidebar_dropdown([
		"name"=>"Inventroy",
		"icon"=>"nav-icon fa fa-cubes",
		"links"=>[
			["route"=>"create-supplier","text"=>"Create Supplier","icon"=>"far fa-circle nav-icon"],
			// ["route"=>"suppliers","text"=>"Manage Supplier","icon"=>"far fa-circle nav-icon"],

			["route"=>"create-stock","text"=>"Create RM Stock","icon"=>"far fa-circle nav-icon"],
			["route"=>"stocks","text"=>"Manage RM Stock","icon"=>"far fa-circle nav-icon"],

			["route"=>"create-product","text"=>"Create Product","icon"=>"far fa-circle nav-icon"],
			// ["route"=>"products","text"=>"Manage Product","icon"=>"far fa-circle nav-icon"],

			["route"=>"create-productcategory","text"=>"Create P.Category","icon"=>"far fa-circle nav-icon"],
			// ["route"=>"product_categories","text"=>"Manage P.Category","icon"=>"far fa-circle nav-icon"],

			["route"=>"sections","text"=>"Manage Section","icon"=>"far fa-circle nav-icon"],
			// ["route"=>"categories","text"=>"Manage Category","icon"=>"far fa-circle nav-icon"],
			// ["route"=>"products","text"=>"create Products","icon"=>"far fa-circle nav-icon"],
			// ["route"=>"products","text"=>"Manage Products","icon"=>"far fa-circle nav-icon"],
			["route"=>"manufacturers","text"=>"Manage Manufacturers","icon"=>"far fa-circle nav-icon"],
			["route"=>"warehouses","text"=>"Manage Warehouses","icon"=>"far fa-circle nav-icon"],
		]
	]);
?>




