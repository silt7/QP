<?php

// This is the main Web application configuration. Any writable
// application properties can be configured here.
return array(
	'basePath'   => dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '..',
	'name'       => 'Birthday',
	'modules'    => array(
		'gii' => array(
			'class'     => 'system.gii.GiiModule',
			'password'  => '1',
			'ipFilters' => array( '109.167.253.109' ),
			// 'newFileMode'=>0666,
			// 'newDirMode'=>0777,
		),
	),
	'import'     => array(
		'ext.sessionstorage.*'
	),
	'components' => array(

		'session'    => array(
			'class'   => 'UserHttpSession',
			'storage' => array(
				'class'        => 'SQLSessionStorage',
				'connectionID' => 'db',
			),
		),
		'db'         => array(

			'connectionString' => 'mysql:host=localhost;dbname=qp',
			'username'         => 'qp',
			'password'         => 'Kxd7En5udSFVUNda',
			'charset'          => 'utf8',

		),
		'urlManager' => array(

			'urlFormat'      => 'path',
			'showScriptName' => false,
			'caseSensitive'  => false,
			'rules'          => array(
				'catalog'                             => 'catalog/index',
				'kitchen-module'                      => 'catalog/kitchenModule',
				'kitchen-modules-color'               => 'catalog/kitchenModulesColor',
				'fronts-color'                        => 'catalog/frontsColor',
				'tabletop'                            => 'catalog/tabletopsColor',
				'wall-panels'                         => 'catalog/wallpanelscolor',
				'kitchens'                            => 'site/kitchens',
				'kitchen'                             => 'site/kitchen',
				'how-to'                              => 'site/howToOrder',
				'delivery'                            => 'site/deliveryAndAssembly',
				'about'                               => 'site/aboutManufacture',
				'contacts'                            => 'site/contacts',
				'sign-up'                             => 'user/signUp',
				'sign-in'                             => 'user/signIn',
				'sign-out'                            => 'user/signOut',
				// shop

				'add/module'                          => 'shop/addModuleToShoppingCart',
				'add/front'                           => 'shop/addFrontToShoppingCart',
				'remove/item/<id>'                    => 'shop/removeItem',
				'shopping-cart'                       => 'shop/shoppingCart',
				'ordering'                            => 'shop/ordering',
				// admin
				'admin'                               => 'admin/admin/dashboard',
				'admin/pages'                         => 'admin/page/view',
				'admin/page/edit/<id:d+>'             => 'admin/page/edit',
				'admin/actions'                       => 'admin/action/view',
				'admin/action/edit/<id:d+>'           => 'admin/action/edit',
				'admin/slider'                        => 'admin/slider/view',
				'admin/slider/edit/<id:d+>'           => 'admin/slider/edit',
				'admin/catalog-menu'                  => 'admin/catalogmenu/view',
				'admin/catalog-menu/edit/<id>'        => 'admin/catalogmenu/edit',
				'admin/catalog-menu/save'             => 'admin/catalogmenu/save',
				'admin/running-meter'                 => 'admin/runningmeter/view',
				'admin/running-meter/create'          => 'admin/runningmeter/create',
				'admin/running-meter/delete'          => 'admin/runningmeter/delete',
				'admin/running-meter/edit'            => 'admin/runningmeter/edit',
				'admin/running-meter/edit/<id:d+>'    => 'admin/runningmeter/edit',
				'admin/kitchens'                      => 'admin/kitchens/view',
				'admin/kitchens/edit/<id:d+>'         => 'admin/kitchens/edit',
				'admin/colors'                        => 'admin/color/view',
				'admin/color/edit/<id:d+>'            => 'admin/color/edit',
				'admin/kitchens/edit/<id:d+>'         => 'admin/kitchens/edit',
				'admin/module-options'                => 'admin/moduleoptions/view',
				'admin/module-option/edit'            => 'admin/moduleoptions/edit',
				'admin/module-option/delete'          => 'admin/moduleoptions/delete',
				'admin/module-option/create'          => 'admin/moduleoptions/create',
				'admin/module-option/save'            => 'admin/moduleoptions/save',
				'admin/item-modules'                  => 'admin/itemmodules/view',
				'admin/item-module/edit'              => 'admin/itemmodules/edit',
				'admin/item-module/delete'            => 'admin/itemmodules/delete',
				'admin/item-module/create'            => 'admin/itemmodules/create',
				'admin/item-module/save'              => 'admin/itemmodules/save',
				'admin/item-fronts'                   => 'admin/itemfronts/view',
				'admin/item-fronts/edit'              => 'admin/itemfronts/edit',
				'admin/item-fronts/delete'            => 'admin/itemfronts/delete',
				'admin/item-fronts/create'            => 'admin/itemfronts/create',
				'admin/item-fronts/save'              => 'admin/itemfronts/save',
				//'admin/<controller:w+>/<action:w+>/<id:d+>' => 'admin/<controller>/<action>',
				'<controller:w+>/<action:w+>/<id:d+>' => '<controller>/<action>',
				'<controller:w+>/<action:w+>'         => '<controller>/<action>'
			),
		),
		'user'       => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
		),
	),

);