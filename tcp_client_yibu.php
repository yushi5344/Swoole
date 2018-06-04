<?php
	/**
	 * Created by PhpStorm.
	 * User: yushi
	 * Date: 2018/6/4
	 * Time: 21:18
	 */
	//创建异步tcp
	$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
	//注册连接成功的回调
	$client->on("connect", function($cli) {
		$cli->send("hello world\n");
	});
	//注册数据接收 $cli:服务端信息
	$client->on("receive", function($cli, $data){
		echo "received: {$data}\n";
	});
	//注册连接失败
	$client->on("error", function($cli){
		echo "connect failed\n";
	});
	//关闭连接
	$client->on("close", function($cli){
		echo "connection close\n";
	});
	$client->connect("47.95.218.48", 9501, 0.5);