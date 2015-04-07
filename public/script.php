<?php
require __DIR__.'/../bootstrap/autoload.php';

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

$host = 'localhost';
$port = 5672;
$user = 'guest';
$pass = 'guest';
$connection = new AMQPConnection($host, $port, $user, $pass);
$channel = $connection->channel();

$exchange = 'topic_logs';
$type = 'topic';
$passive = FALSE;
$durable = FALSE;
$auto_delete = FALSE;
$channel->exchange_declare($exchange, $type, $passive, $durable, $auto_delete);

$exclusive = TRUE;
list($queue_name, ,) = $channel->queue_declare("", $passive, $durable, $exclusive, $auto_delete);

$binding_keys = array_slice($argv, 1);
if (empty($binding_keys)) {
	file_put_contents('php://stderr', "Usage: $argv[0] [info] [warning] [error]\n");	
	exit(1);
}

foreach ($binding_keys as $binding_key) {
	$channel->queue_bind($queue_name, $exchange, $binding_key);
}

$callback = function($msg) {
	echo ' [x] ', $msg->delivery_info['routing_key'], ':', $msg->body, "\n";
};

$consumer_tag = '';
$no_local = FALSE;
$no_ack = TRUE;
$exclusive = FALSE;
$nowait = FALSE;
$channel->basic_consume($queue_name, $consumer_tag, $no_local, $no_ack, $exclusive, $nowait, $callback);

while(count($channel->callbacks)) {
	$channel->wait();
}

$channel->close();
$connection->close();

/*
$exchange = 'logs';
$type = 'fanout';
$passive = FALSE;
$durable = FALSE;
$auto_delete = FALSE;
$channel->exchange_declare($exchange, $type, $passive, $durable, $auto_delete);

$exclusive = TRUE;
list($queue_name, ,) = $channel->queue_declare('', $passive, $durable, $exclusive, $auto_delete);

$channel->queue_bind($queue_name, $exchange);

$callback = function($msg) {
	echo ' [x] ' . $msg->body . "\n";
};

$consumer_tag = '';
$no_local = FALSE;
$no_ack = TRUE;
$exclusive = FALSE;
$nowait = FALSE;
$channel->basic_consume($queue_name, $consumer_tag, $no_local, $no_ack, $exclusive, $nowait, $callback);

while(count($channel->callbacks)) {
	$channel->wait();
}

$channel->close();
$connection->close();
 */
/*
$queue = "task_new";
$passive = FALSE;
$durable = TRUE; //持久化
$exclusive = FALSE;
$auto_delete = FALSE;
//声明一个队列
$channel->queue_declare($queue, $passive, $durable, $exclusive, $auto_delete);

echo " [x] Waiting for messages \n";

$callback = function($msg) {
	echo " [x] Received " . $msg->body . "\n";
	sleep(substr_count($msg->body, '.'));
	echo " [x] Done \n";
	$msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};

$channel->basic_qos(NULL, 1, NULL);

$consumer_tag = '';
$no_local = FALSE;
//$no_ack = TRUE;
$no_ack = FALSE; //回送确认
$exclusive = FALSE;
$nowait = FALSE;
$channel->basic_consume($queue, $consumer_tag, $no_local, $no_ack, $exclusive, $nowait, $callback);

while(count($channel->callbacks)) {
	$channel->wait();
}
 */
