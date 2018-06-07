<?php
	/**
	 * Created by PhpStorm.
	 * User: yushi
	 * Date: 2018/6/7
	 * Time: 22:04
	 */
	//实例化资源
	$db=new swoole_mysql();
	$config=[
		'host'=>'localhost',
		'user'=>'root',
		'password'=>'root',
		'database'=>'blog',
		'charset'=>'utf8'
	];
	//连接数据

	$db->connect($config,function ($db,$r){
		if ($r===false){
			var_dump($db->connect_errno,$db->connect_error);
			die("连接失败");
		}
		//成功
		$sql ="show tables";
		$db->query($sql,function (swoole_mysql $db,$r){
			if ($r===false){
				var_dump($db->error);
				die("操作失败");
			}elseif ($r===true){
				var_dump($db->affected_rows,$db->insert_id);
			}
			var_dump($r);
			$db->close();
		});
	});