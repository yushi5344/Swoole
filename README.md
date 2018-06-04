# Swoole

## 安装swoole


	下载 wget https://github.com/swoole/swoole-src/archive/v1.10.2.tar.gz
	解压 tar -xf v1.10.2.tar.gz
	phpize
	./configure --with-php-config=/usr/local/php/bin/php-config
	make && make install
	cd /usr/local/php/etc/
	vim php.ini
	extension=swoole.so
	lmmp restart
	php -m 


# TCP服务器

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

在linux服务器上运行  

	php tcp.php

查看是否运行

	[root@localhost ~]# ps -ajft
	Warning: bad syntax, perhaps a bogus '-'? See /usr/share/doc/procps-3.2.8/FAQ
	  PPID    PID   PGID    SID TTY       TPGID STAT   UID   TIME COMMAND
	  3432   3434   3434   3434 pts/2      3449 Ss       0   0:00 -bash
	  3434   3449   3449   3434 pts/2      3449 R+       0   0:00  \_ ps -ajft
	  3330   3333   3333   3333 pts/1      3428 Ss       0   0:00 -bash
	  3333   3415   3415   3333 pts/1      3428 T        0   0:00  \_ vim tcp.php
	  3333   3428   3428   3333 pts/1      3428 Sl+      0   0:00  \_ php tcp.php
	  3428   3429   3428   3333 pts/1      3428 S+       0   0:00      \_ php tcp.php
	  3429   3431   3428   3333 pts/1      3428 S+       0   0:00          \_ php tcp.php

在cmd中
    
        Telnet ip地址  9501

# udp服务器

    $serv=new swoole_server('0.0.0.0',9502,SWOOLE_PROCESS,SWOOLE_SOCK_UDP);
	//监听数据接收事件
	$serv->on('packet',function ($serv,$data,$fd){
		//发送数据到响应客户端，反馈信息
		$serv->sendto($fd['address'],$fd['port'],"server:$data");
		var_dump($fd);
	});
	$serv->start();//启动服务
	
在linux上

    nc -vuz ip地址 9502
    
# http服务器

    $serv=new swoole_http_server('0.0.0.0',9503);
	$serv->on('request',function ($request,$response){
		var_dump($request);
		$response->header("Content-Type","text/html;charset-utf-8");
		$response->end('Hello world'.rand(100,999));
	});
	$serv->start();
	
在浏览器中 

    http://ip地址:9503



# websocket服务器

服务端

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


客户端 js实现

	<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
    </head>
    <body>
    <script>
        var wsServer="ws://47.95.218.48:9501";
        var webSocket=new WebSocket(wsServer);
        webSocket.onopen=function (evt) {
            console.log("连接成功");
        };
        webSocket.onclose=function (evt) {
            console.log("关闭");
        };
        webSocket.onmessage=function (evt) {
            console.log(evt.data);
        };
        webSocket.onerror=function (evt,e) {
            console.log("error")
        }
    </script>
    </body>
    </html>