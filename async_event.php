<?php
	/**
	 * Created by PhpStorm.
	 * User: yushi
	 * Date: 2018/6/7
	 * Time: 21:54
	 */
	$fp=stream_socket_client("tcp://www.qq.com:80",$errno,$errstr,30);
	fwrite($fp,"GET / HTTP/1.1 \r\n Host:www.qq.com \r\n\r\n");
	//添加我们的异步事件
	swoole_event_add($fp,function ($fp){
		$resp=fread($fp,8192);
		var_dump($resp);
		swoole_event_del($fp);
		fclose($fp);
	});
	echo "这个先执行\n";