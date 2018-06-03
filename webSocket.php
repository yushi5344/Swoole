<?php
	/**
	 * Created by PhpStorm.
	 * User: yushi
	 * Date: 2018/6/3
	 * Time: 19:22
	 */
	//创建websocket服务器
	$ws=new swoole_websocket_server('0.0.0.0',9501);
	//open建立连接
	$ws->on('open',function ($ws,$request){
		var_dump($request);
		$ws->push($request->fd,"welcome\n");
	});
	//message 接收信息
	$ws->on('message',function ($ws,$request){
		echo "Message: $request->data";
		$ws->push($request->fd,"get it message");
	});
	//close 关闭连接

	$ws->on('close',function ($ws,$request){
		echo "close\n";
	});

	//启动
	$ws->start();