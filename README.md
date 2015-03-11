# phalcon_cococore
一个基于phalcon core的PHP MVC框架，基于Phalcon v1.3.4 Stable
Phalcon框架详情参见：https://github.com/phalcon/cphalcon

# 重写规则
Apache Rewrite 
--------------------- 
RewriteEngine On 
RewriteCond %{REQUEST_FILENAME} !-d 
RewriteCond %{REQUEST_FILENAME} !-f 
RewriteRule ^(.*)$ index.php?_url=/$1 [QSA,L]

Nginx Rewrite 
--------------------- 
try_files $uri $uri/ @rewrite;

location @rewrite { 
	rewrite ^/(.*)$ /index.php?_url=/$1; 
}

More information : http://docs.phalconphp.com/en/latest/index.html
中文版文档：http://docs.phalconphp.com/zh/latest/index.html
