<?php
	/**
	 * Created by PhpStorm.
	 * User: yushi
	 * Date: 2018/6/7
	 * Time: 21:34
	 */
	swoole_async_readfile(__DIR__."/1.txt",function ($filename,$content){
		echo "$filename \n $content \n";
	});