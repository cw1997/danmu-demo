<?php 
echo "author:changwei [www.changwei.me]\nEmail:867597730@qq.com\nstart at ".time()."\n";

//官网demo
$server = new swoole_websocket_server("0.0.0.0", 1997);

$server->on('open', function (swoole_websocket_server $server, $request) {
    echo "server: handshake success with fd{$request->fd}\n";//$request->fd 是客户端id
});

$server->on('message', function (swoole_websocket_server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    //$frame->fd 是客户端id，$frame->data是客户端发送的数据
    //服务端向客户端发送数据是用 $server->push( '客户端id' ,  '内容')
    $data = $frame->data;
    foreach($server->connections as $fd){
        $server->push($fd , $data);//循环广播
    }
});

$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();

/*$serv = new swoole_websocket_server("0.0.0.0", 1997);

$serv->on('Open', function($server, $req) {
    echo "connection open: ".$req->fd;
});

$serv->on('Message', function($server, $frame) {
    echo time()." receive message: ".$frame->data."\n";
    // $server->push($frame->fd,$frame->data);
/*    foreach ($server->connection as $fd) {
    	if ($frame->fd!=$fd) {
    		$server->send($fd,$frame->data);
    	}
    }
});

$serv->on('Close', function($server, $fd) {
    echo "$fd connection close: ".$fd;
});

$serv->start();*/

/*$serv = new swoole_server("0.0.0.0", 1234);
$serv->on('connect', function ($serv, $fd){
    echo "Client:Connect.\n";
});
$serv->on('receive', function ($serv, $fd, $from_id, $data) {
    $serv->send($fd, 'Swoole: '.$data);
    $serv->close($fd);
});
$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.\n";
});
$serv->start();*/
/*$serv = new swoole_http_server("127.0.0.1", 9502);

$serv->on('Request', function($request, $response) {
    var_dump($request->get);
    var_dump($request->post);
    var_dump($request->cookie);
    var_dump($request->files);
    var_dump($request->header);
    var_dump($request->server);

    $response->cookie("User", "Swoole");
    $response->header("X-Server", "Swoole");
    $response->end("<h1>Hello Swoole!</h1>");
});

$serv->start();*/
?>