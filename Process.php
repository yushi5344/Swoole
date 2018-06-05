<?php
	/**
	 * Created by PhpStorm.
	 * User: yushi
	 * Date: 2018/6/5
	 * Time: 21:02
	 */
	//创建进程
	//进程对应的执行函数
	function doProcess(swoole_process $worker){
		echo "PID ",$worker->pid,"\n";
		sleep(10);
	}
	//创建进程1
	$process=new swoole_process("doProcess");
	$pid=$process->start();
	//创建进程2
	$process=new swoole_process("doProcess");
	$pid=$process->start();
	//创建进程3
	$process=new swoole_process("doProcess");
	$pid=$process->start();

	//等待结束
	swoole_process::wait();