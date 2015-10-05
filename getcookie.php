<?php
	getcookie();
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
		echo $setcookie[1];
	};
?>