# Swoole

##安装swoole  


	下载 wget https://github.com/swoole/swoole-src/archive/v1.10.2.tar.gz
	解压 tar -xf v1.10.2.tar.gz
	phpize
	./configure --with-php-config=/usr/local/php/bin/php-config
	make && make install
	cd /usr/local/php/etc/
	vim php.ini
	extension=swoole.so
	lmmp restart
	php -m 