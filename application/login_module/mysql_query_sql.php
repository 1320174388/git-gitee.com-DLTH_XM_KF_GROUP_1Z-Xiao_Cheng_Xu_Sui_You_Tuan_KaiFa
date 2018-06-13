<?php
/**
 *  版权声明 :  地老天荒科技（北京）有限公司
 *  文件名称 :  mysql_query_sql.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/12 15:10
 *  文件描述 :  数据库表迁移文件，删除/创建模块应用表
 *  历史记录 :  -----------------------
 */
    $config = [
        'host'     => '127.0.0.1',   // 数据库地址
        'port'     => '3306',        // 数据库端口
        'database' => 'dlth_xm_v1',  // 数据库名称
        'charset'  => 'utf8',        // 设置字符集
        'user'     => 'root',        // 用户名称
        'password' => '',            // 用户密码

    ];

	$date     =  date('Y-m-d H:i:s',time());

	// 连接数据库
    $server  = 'mysql:host='.$config['host'].';';

    $server .= 'port='.$config['port'].';';

    $server .= 'dbname='.$config['database'].';';

    $server .= 'charset='.$config['charset'].';';

    $pdo = new pdo($server,$config['user'],$config['password']);
	
	// 开启事务
	$pdo->beginTransaction();
	
	try{

	    // 创建 dlth_xm1_home_users 用户身份标识表
	    $pdo->exec('drop table dlth_xm1_home_users;');

	    echo '
删除 dlth_xm1_home_users 用户身份标识表
';
		$pdo->exec('create table dlth_xm1_home_users(
			user_id int unsigned primary key auto_increment,
			user_openid varchar(50) unique,
			user_token varchar(50) unique,
			user_time varchar(50)
		);');

		echo '
创建 dlth_xm1_home_users 用户身份标识表
';


		// 添加成功
		$pdo->commit();
		echo '
success
';

    }catch(PDOException $e){
    	// 添加失败
    	$pdo->rollback();
        echo $e->getMessage();
    }   
    