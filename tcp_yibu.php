<?php
	/**
	 * Created by PhpStorm.
	 * User: yushi
	 * Date: 2018/6/4
	 * Time: 20:52
	 */
	$serv=new swoole_server('0.0.0.0',9501);
	//设置异步 进程工作数
	$serv->set(array('task_worker_num'=>4));
	//投递异步任务
	$serv->on('receive',function ($serv,$fd,$from_id,$data){
		$task_id=$serv->task($data);//异步ID
		echo "异步id $task_id \n";
	});
	//处理异步任务
	$serv->on('task',function ($serv,$task_id,$from_id,$data){
		echo "执行异步id $task_id";
		$serv->finish("$data  ->  ok");
	});
	//处理结果
	$serv->on('finish',function ($serv,$task_id,$data){
		echo "执行完成";
	});
	//启动服务
	$serv->start();