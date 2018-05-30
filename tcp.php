<?php
//创建服务器
	$host='0.0.0.0';
	$port=9501;
//$serv=new swoole_server($host,$port,$mode,$sock_type);
$serv=new swoole_server($host,$port);
/*
 * $host 监听的ip
 * 127.0.0.1 监听 本地
 * 192.168.60.133  监听对应外网ip
 * 0.0.0.0 监听所有ip
 * ipv4/ipv6
 *
 * $port 端口号
 * 1024以下的端口号需要root权限
 * $mode 默认SWOOLE——PROCESS   多进程
 * $socket_type 默认 SWOOLE_SOCK_TCP
 */
//使用
//bool $swoole_server->on(string $evnet,mixed $callback);
//connect:建立连接 $serv服务器信息 $fd客户端信息
//receive：当接收到数据 $serv服务器信息  $fd客户端  $from_id客户端id $data数据
//close:关闭连接
$serv->on('connect',function ($serv,$fd){
	echo "建立连接\n";
});
$serv->on('receive',function ($serv,$fd,$from_id,$dada){
	echo "接收到数据源\n";
	var_dump($dada);
});
$serv->on('close',function ($serv,$fd){
	echo "连接关闭";
});
//启动服务器
$serv->start();