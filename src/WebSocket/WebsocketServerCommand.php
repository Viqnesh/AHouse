<?php
namespace App\WebSocket;

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\WebSocket\Chat;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
 
class WebsocketServerCommand extends Command
{
    protected static $defaultName = "websocket-server";
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $port = 8080;
        $output->writeln("Starting server on port " . $port);
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Chat()
                )
            ),
            $port
        );
        $server->run();
        return 0;
    }
}
?>