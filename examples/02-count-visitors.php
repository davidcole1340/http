<?php

use React\EventLoop\Factory;
use React\Socket\Server;
use React\Http\Response;
use Psr\Http\Message\RequestInterface;

require __DIR__ . '/../vendor/autoload.php';

$loop = Factory::create();
$socket = new Server(isset($argv[1]) ? $argv[1] : '0.0.0.0:0', $loop);

$counter = 0;
$server = new \React\Http\Server($socket, function (RequestInterface $request, Response $response) use (&$counter) {
    $response->writeHead(200, array('Content-Type' => 'text/plain'));
    $response->end("Welcome number " . ++$counter . "!\n");
});

echo 'Listening on http://' . $socket->getAddress() . PHP_EOL;

$loop->run();
