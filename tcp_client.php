<?php
	/**
	 * Created by PhpStorm.
	 * User: yushi
	 * Date: 2018/6/4
	 * Time: 21:34
	 */
	//创建客户端
	$client=new swoole_client(SWOOLE_SOCK_TCP);
	//连接服务器
	$client->connect('192.168.1.111',8080,5) or die('连接失败');
	$client->send('hello world') or die('发送失败');
	$data=$client->recv();
	if ($data){
		echo $data;
	}else{
		die('接收失败');
	}
	//关闭客户端
	$client->close();