<?php
	/**
	 * Created by PhpStorm.
	 * User: yushi
	 * Date: 2018/6/5
	 * Time: 21:40
	 */
	//进程仓库
	$workers=[];
	//最大进程数
	$worker_num=2;
	//批量创建进程 完成
	for ($i=0;$i<$worker_num;$i++){
		//创建子进程完成
		$process=new swoole_process("doProcess");
		//开启队列 类似于全局函数
		$process->useQueue();
		$pid=$process->start();
		$workers[$pid]=$process;
	}
	//执行进程函数
	function doProcess(swoole_process $process){
		$recv=$process->pop();//9182
		echo "从主进程获取到数据：$recv\n";
		sleep(5);
		$process->exit(0);
	}
	//主进程向子进程添加数据
	foreach ($workers as $pid =>$process) {
		$process->push("hello 子进程 $pid \n");
	}
	//等待子进程结束 回收资源
	for ($i=0;$i<$worker_num;$i++){
		//等待执行完成
		$ret=swoole_process::wait();
		$pid=$ret['pid'];
		unset($workers[$pid]);
		echo "子进程退出 $pid \n";
	}