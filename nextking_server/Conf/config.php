<?php
return array(
	'APP_STATUS' => 'debug', // 
	'URL_MODEL'=> 2,
	'URL_HTML_SUFFIX'=> '.do',
        'DB_TYPE'=> 'mysql', // 	'DB_HOST'=> 'localhost', //
        'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'=>'king', // 	'DB_USER'=>'root', // 
        'DB_USER'   => 'root', // 用户名
	'DB_PWD'=>'zaq1xsw2', // 	'DB_PORT'=>'3306', //'DB_PREFIX'=>'ldc_', // 
        'DB_PORT'=>'8889',
        'DB_PREFIX'=>'nk_',
    
    
        'SESSION_AUTH_KEY'=>'SessionAuthUser',

	
	'COOKIE_USER_NAME'=>"AuthName",
	'COOKIE_USER_ID'=>"AuthID",
    
    'TMPL_PARSE_STRING' =>  array( // 添加输出替换
        '__UPLOAD__'    =>  __ROOT__.'/Uploads',
    ),
    

);
?>