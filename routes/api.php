<?php
	ini_set("display_errors","on");
	
	//Api Page
	$app->get('/',function (){
		echo json_encode('API is go');
	});
	
	
	$app->group('/login',function () use ($app) {
		$app->post('/',function (){
			$post_data['UserID'] = $_POST['UserID'];
			$post_data['UserPassword']   = $_POST['UserPassword'];
			$post_data['UserType'] = $_POST['UserType'];
			
			$cookie = getcookie();
			$code = verifycode($cookie);
			
			if(!$code&&!$cookie){
				verify($post_data,$cookie);
			}else{
				echo json_decode('Initialization Failure');
			}
		});
	});
?>