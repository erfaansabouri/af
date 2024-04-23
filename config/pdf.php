<?php
return [
	'mode' => 'utf-8' ,
	'format' => 'a4' ,
	'author' => '' ,
	'subject' => '' ,
	'keywords' => '' ,
	'creator' => 'Aftab' ,
	'display_mode' => 'fullpage' ,
	'tempDir' => base_path('../temp/') ,
	'font_path' => public_path('web/fonts/') ,
	'font_data' => [
		'dana' => [
			'R' => 'YekanBakh-Regular.ttf' ,
			// regular font
			'useOTL' => 0xFF ,
			// required for complicated langs like Persian, Arabic and Chinese
			'useKashida' => 75 ,
			// required for complicated langs like Persian, Arabic and Chinese
		] ,
		'dananumeric' => [
			'R' => 'YekanBakhFaNum-Regular.ttf' ,
			// regular font
			'useOTL' => 0xFF ,
			// required for complicated langs like Persian, Arabic and Chinese
			'useKashida' => 75 ,
			// required for complicated langs like Persian, Arabic and Chinese
		]
		// ...add as many as you want.
	] ,
];
