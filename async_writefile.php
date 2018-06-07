<?php
	/**
	 * Created by PhpStorm.
	 * User: yushi
	 * Date: 2018/6/7
	 * Time: 21:45
	 */
	$content="欢迎使用 swoole 扩展";
	swoole_async_writefile('2.txt',$content,function ($filename){
		echo $filename;
	},0);