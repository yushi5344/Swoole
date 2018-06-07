<?php
	/**
	 * Created by PhpStorm.
	 * User: yushi
	 * Date: 2018/6/7
	 * Time: 21:19
	 */
	//创建锁对象
	$lock=new swoole_lock(SWOOLE_MUTEX);//互斥锁
	echo "创建互斥锁\n";
	//开始锁定 主进程
	$lock->lock();
	if (pcntl_fork()>0){
		sleep(1);
		$lock->unlock();//解锁
	}else{
		echo "子进程 等待锁\n";
		$lock->lock();//上锁
		echo "子进程获取锁";
		$lock->unlock();//释放锁
		exit("子进程退出");
	}
	echo "主进程 释放锁";
	unset($lock);
	sleep(5);
	echo "子进程退出";