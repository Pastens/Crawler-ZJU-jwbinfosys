<?php
	$post_data = array(
		'UserID' => '',
		'UserPassword' => '',
		'UserType' => '学生'
	);
	$verify = verify($post_data);
	if($verify == true){
		echo true;
	}else if($verify == false){
		echo false;
	}
	function verify($post_data){
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
		$cookie = "ASP.NET_SessionId=bdqb4oj2k1itrinnecqtbs45";
		$ch =  curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_REFERER, $referer);
		// curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $verifycode);
		$output = curl_exec($ch);
		curl_close($ch);
		if($output == "'1'"){
			return true;
		}else{
			return false;
		}
	}
	
?>