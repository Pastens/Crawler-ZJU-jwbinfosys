<?php
	function verifycode(){

	}
	$codepic = getcode();
	code($codepic);

	function code($pic){
		header("Content-Type: text/html");
		include ('Valite.php');
		$valite = new Valite();
		$valite->setImage($pic);
		$valite->getHec();
		$ert = $valite->run();
		unlink($pic);
		echo $ert;
	};
	function getcode(){
		header("Content-Type: image/Gif; charset=gb2312");
		$url = "http://jwbinfosys.zju.edu.cn/CheckCode.aspx";
		$header = array(
			'Accept-Encoding: gzip, deflate, sdch',
			'Accept-Language: zh-CN,zh;q=0.8,en;q=0.6',
			'Connection: keep-alive',
			'Host: jwbinfosys.zju.edu.cn',
			'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11) AppleWebKit/601.1.56 (KHTML, like Gecko) Version/9.0 Safari/601.1.56'
		);
		$referer = "http://jwbinfosys.zju.edu.cn/default2.aspx";
		$cookie = "ASP.NET_SessionId=bdqb4oj2k1itrinnecqtbs45";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_REFERER, $referer);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, false);
		$output = time().'.gif';
		@file_put_contents($output, curl_exec($ch));
		curl_close($ch);
		return $output;
	};
?>