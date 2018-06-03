<?php
	/**
	 * Created by PhpStorm.
	 * User: yushi
	 * Date: 2018/6/3
	 * Time: 17:48
	 */

	$serv=new swoole_server('0.0.0.0',9502,SWOOLE_PROCESS,SWOOLE_SOCK_UDP);
	//监听数据接收事件
	$serv->on('packet',function ($serv,$data,$fd){
		//发送数据到响应客户端，反馈信息
		$serv->sendto($fd['address'],$fd['port'],"server:$data");
		var_dump($fd);
	});
	$serv->start();//启动服务