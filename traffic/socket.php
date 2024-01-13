<?php

require './vendor/autoload.php';
use Ratchet\Http\HttpServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;



// Your WebSocket application
class MyWebSocket implements MessageComponentInterface
{
    public function onOpen(ConnectionInterface $conn)
    {
        echo "New connection!";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo "Message $msg ";

    }

    public function onClose(ConnectionInterface $conn)
    {
        echo "Connection has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

// Create a loop for the WebSocket server
$server = IoServer::factory(
    new HttpServer(
        new WsServer(new MyWebSocket())
    ),
    8080
);

$server->run();

?>