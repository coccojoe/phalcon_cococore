# phalcon_cococore
一个基于phalcon core的PHP MVC框架，基于Phalcon v1.3.4 Stable<br/>
Phalcon框架详情参见：https://github.com/phalcon/cphalcon</br>

# 重写规则
Apache Rewrite 
--------------------- 
RewriteEngine On</br> 
RewriteCond %{REQUEST_FILENAME} !-d<br/> 
RewriteCond %{REQUEST_FILENAME} !-f<br/> 
RewriteRule ^(.*)$ index.php?_url=/$1 [QSA,L]<br/>

Nginx Rewrite 
--------------------- 
try_files $uri $uri/ @rewrite;<br/>

location @rewrite {<br/>
	rewrite ^/(.*)$ /index.php?_url=/$1;<br/>
}<br/>

More information : http://docs.phalconphp.com/en/latest/index.html<br/>
中文版文档：http://docs.phalconphp.com/zh/latest/index.html<br/>
