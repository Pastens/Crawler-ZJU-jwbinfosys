<?php
	$post_data = array(
		'UserID' => $_POST['UserID'],
		'UserPassword' => $_POST['UserPassword'],
		'UserType' => $_POST['UserType']
	);
	function login($post_data){
		$setcookie = getcookie();
		$verify = verify($post_data,$setcookie);
		if($verify == true){
			echo true;
		}else if($verify == false){
			echo false;
		}
	};
	function verify($post_data,$setcookie){
		$verifycode = "strXh=".$post_data['UserID']."\n".
				 	  "strMm=".$post_data['UserPassword']."\n".
				 	  "strLx=".$post_data['UserType'];
		$url = "http://jwbinfosys.zju.edu.cn/ajax/zjdx.AjaxForm,zjdx.ashx?_method=Pdmm&_session=no";
		$header = array(
			'Accept-Encoding: gzip, deflate',
			'Accept-Language: en-us',
			'Connection: keep-alive',
			'Content-Type: text-plain; charset=UTF-8',
			'Host: jwbinfosys.zju.edu.cn',
			'Origin: http://jwbinfosys.zju.edu.cn',
			'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11) AppleWebKit/601.1.56 (KHTML, like Gecko) Version/9.0 Safari/601.1.56'
		);
		$referer = "http://jwbinfosys.zju.edu.cn/default2.aspx";
		$ch =  curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_COOKIE, $setcookie);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_REFERER, $referer);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $verifycode);
		$output = curl_exec($ch);
		curl_close($ch);
		echo $output;
		if($output == "'1'"){
			return true;
		}else{
			return false;
		}
	};
	function getcookie(){
		$url = "http://jwbinfosys.zju.edu.cn/default2.aspx";
		$header = array(
			'Accept-Encoding: gzip, deflate, sdch',
			'Accept-Language: zh-CN,zh;q=0.8,en;q=0.6',
			'Connection: keep-alive',
			'Host: jwbinfosys.zju.edu.cn',
			'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11) AppleWebKit/601.1.56 (KHTML, like Gecko) Version/9.0 Safari/601.1.56'
		);
		$referer = "http://jwbinfosys.zju.edu.cn";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_REFERER, $referer);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_NOBODY, 1);
		$output = curl_exec($ch);
		preg_match('/^Set-Cookie: (.*?);/m', $output, $setcookie);
		curl_close($ch);
		return $setcookie[1];
	};
?>