<?php
	/**
	 * Created by PhpStorm.
	 * User: yushi
	 * Date: 2018/6/7
	 * Time: 21:30
	 */
	//执行DNS查询
	swoole_async_dns_lookup("www.baidu.com",function ($host,$ip){
		echo $host,$ip;
	});