<?php

//Config::get('constants.langs');
// or if you want a specific one
//Config::get('constants.langs.en');

define('REVIEW_DANGER',  '1');
define('REVIEW_WARNING', '2');
define('REVIEW_SUCCESS', '3');

define ('REVIEW_STATUS', serialize(array(
    REVIEW_DANGER  => "Precisa ainda de vários ajustes.",
    REVIEW_WARNING => "Poucos detalhes precisam ser melhorados.",
    REVIEW_SUCCESS => "Está pronto para ser lançado!"
)));

define ('ARTICLE_REVIEW_ITEMS', serialize(array(
    "Conteúdo dentro do escopo",
    "Ortografia",
    "Formatação",
    "Imagem Destacada (min 1280x720 16:9)",
    "Categorias",
    "Open Graph Data",
    "Links",
    "Tags",
)));



define('ARTICLE_STATUS_EDITING',  		'editing');
define('ARTICLE_STATUS_PROOFREADING',  	'proofreading');
define('ARTICLE_STATUS_SCHEDULED',  	'scheduled');
define('ARTICLE_STATUS_PUBLISHED',  	'published');

define('VIDEO_STATUS_TRANSCRIPTION',  	'transcription');
define('VIDEO_STATUS_SYNCHRONIZATION',  'sync');
define('VIDEO_STATUS_TRANSLATION',  	'translation');
define('VIDEO_STATUS_PROOFREADING',  	'proofreading');
define('VIDEO_STATUS_SCHEDULED',  		'scheduled');
define('VIDEO_STATUS_PUBLISHED',  		'published');

define('PERMISSION_TYPE_VIDEO',	        'p_vid');
define('PERMISSION_VIDEO_EXECUTE',	    'p_vid_1');
define('PERMISSION_VIDEO_CREATE',	    'p_vid_2');
define('PERMISSION_VIDEO_MANAGE',	    'p_vid_3');

define('PERMISSION_TYPE_ARTICLE',       'p_art');
define('PERMISSION_ARTICLE_EXECUTE',	'p_art_1');
define('PERMISSION_ARTICLE_CREATE', 	'p_art_2');
define('PERMISSION_ARTICLE_MANAGE',	    'p_art_3');

define('PERMISSION_TYPE_POST',	        'p_pos');
define('PERMISSION_POST_EXECUTE',	    'p_pos_1');
define('PERMISSION_POST_CREATE',	    'p_pos_2');
define('PERMISSION_POST_MANAGE',	    'p_pos_3');

define('PERMISSION_SYSTEM_MANAGER',     'p_sys_1');

define('PERMISSION_YES', '<i class="fa fa-check text-success"></i>');
define('PERMISSION_NO', '<i class="fa fa-times text-danger"></i>');


return [
	'video' => [
		'status' => [
			'transcription'			=> '0',
			'syncronization'		=> '1',
			'translation'			=> '2',
			'proofreading'			=> '3',
			'scheluded' 			=> '4',
			'published'				=> '5',
		],
		'actions' => [
			'add'		 	 	  	=> '11',
			'edit'		 	 	  	=> '12',
			'delete'	 	 	  	=> '13',
			'comment'	 	 	  	=> '14',

			'transcript'		  	=> '21',
			'translate'		 	  	=> '22',
			'synchronize'	 	  	=> '23',
			'proofread'		 	  	=> '24',
			'schelude'		 	  	=> '25',
			'publish'		 	  	=> '26',

			'go-to-translate'     	=> '31',
			'go-to-synchronize'   	=> '32',
			'go-to-proofread' 	  	=> '33',
			'go-to-schelude' 	  	=> '34',
			'go-to-publish'		  	=> '35',

			'back-to-transcript'    => '41',
			'back-to-translate'     => '42',
			'back-to-synchronize' 	=> '43',
			'back-to-proofread'   	=> '44',
			'back-to-schelude'    	=> '45',
		]
	],
	'article' => [
		'status' => [
			'editing'		 		=> '0',
			'proofreading'		 	=> '1',
			'scheluded'		 	 	=> '2',
			'published'		 	 	=> '3',
		],
		'actions' => [
			'add'		 	 		=> '11',
			'edit'		 	 	  	=> '12',
			'delete'	 	 	  	=> '13',
			'comment'	 	 	  	=> '14',

			'editing'	 	 	  	=> '21',
			'proofread'		 	 	=> '22',
			'schelude'	 		  	=> '23',
			'publish'		 	  	=> '24',

			'go-to-proofread'     	=> '31',
			'go-to-schelude'      	=> '32',
			'go-to-publish'       	=> '33',

			'back-to-editing'     	=> '41',
			'back-to-proofread'   	=> '42',
			'back-to-schelude'    	=> '43',
		]
	],
	'auth' => [
		'unauthorized'	=> '0',
		'operator'		=> '1',
		'admin'			=> '2',
	]
];