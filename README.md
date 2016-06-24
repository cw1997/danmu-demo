# 前端HTML5 websocket结合后端swoole实现的弹幕系统
服务端使用php的swoole扩展，不到二十行代码。前端使用jquery.danmu插件。

使用方法：liunx发行版安装php5.3+并且编译swoole扩展，在php.ini中加入extension=swoole.so之后打开命令行，cd到server.php所在目录，修改文件中的监听IP和端口，使用php server.php即开启服务端。
然后客户端html中修改websocket连接的服务端IP和端口，打开页面即可开始体验该实时弹幕系统。
