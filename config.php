<?php 

session_start();
date_default_timezone_set('Asia/Kolkata');
$timestamp = date('Y-m-d h:i:s');

// path configuration
$project_path = "/employee_tracking";
define('FILEPATH',"http://".$_SERVER['SERVER_NAME'].$project_path);
define('APPPATH',$_SERVER['DOCUMENT_ROOT'].$project_path);


// local or remote connection
define('SERVER','dev');

if(SERVER == 'dev'){
	
	// Development Server DB
	define('HOST',"localhost");
	define('USER',"root");
	define('PASS',"");
	define('DB',"employee_tracking");

}else if(SERVER == 'prod'){

	// Production Server DB
	define('HOST',"localhost");
	define('USER',"root");
	define('PASS',"");
	define('DB',"nikki_bites");

}

?>