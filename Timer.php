<?php
	/**
	 * Created by PhpStorm.
	 * User: yushi
	 * Date: 2018/6/4
	 * Time: 20:24
	 */

	//循环执行
	swoole_timer_tick(2000,function ($timer_id){
		echo "执行 $timer_id \n";
	});
	//单次执行
	swoole_timer_after(3000,function (){
		echo "3000毫秒后执行 \n";
	});