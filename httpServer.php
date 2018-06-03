<?php
	/**
	 * Created by PhpStorm.
	 * User: yushi
	 * Date: 2018/6/3
	 * Time: 18:19
	 */
	$serv=new swoole_http_server('0.0.0.0',9503);
	$serv->on('request',function ($request,$response){
		var_dump($request);
		$response->header("Content-Type","text/html;charset-utf-8");
		$response->end('Hello world',rand(100,999));
	});
	$serv->start();