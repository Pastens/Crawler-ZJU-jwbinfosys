<?php
	ini_set("display_errors","on");
	
	//Api Page
	$app->get('/',function (){
		echo json_encode('API is go');
	});

	
?>