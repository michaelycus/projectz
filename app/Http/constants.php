<?php

//Config::get('constants.langs');
// or if you want a specific one
//Config::get('constants.langs.en');

define('ARTICLE_STATUS_EDITING',  		'0');
define('ARTICLE_STATUS_PROOFREADING',  	'1');
define('ARTICLE_STATUS_SCHEDULED',  	'2');
define('ARTICLE_STATUS_PUBLISHED',  	'3');

define('VIDEO_STATUS_TRANSCRIPTION',  	'0');
define('VIDEO_STATUS_SYNCHRONIZATION',  '1');
define('VIDEO_STATUS_TRANSLATION',  	'2');
define('VIDEO_STATUS_PROOFREADING',  	'3');
define('VIDEO_STATUS_SCHEDULED',  		'4');
define('VIDEO_STATUS_PUBLISHED',  		'5');

define('PERMISSION_VIDEO_EXECUTE',	    'p_video_execute');
define('PERMISSION_VIDEO_CREATE',	    'p_video_create');
define('PERMISSION_VIDEO_MANAGE',	    'p_video_manage');
define('PERMISSION_ARTICLE_EXECUTE',	'p_article_execute');
define('PERMISSION_ARTICLE_CREATE', 	'p_article_create');
define('PERMISSION_ARTICLE_MANAGE',	    'p_article_manage');
define('PERMISSION_POST_EXECUTE',	    'p_post_execute');
define('PERMISSION_POST_CREATE',	    'p_post_create');
define('PERMISSION_POST_MANAGE',	    'p_post_manage');

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