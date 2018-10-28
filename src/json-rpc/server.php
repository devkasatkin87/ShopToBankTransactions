<?php

use Datto\JsonRpc\Server;

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__.'/Source/Bank.php';

$serverBank = new Server(new Source\Bank());

$requestShop = file_get_contents('php://input');

$replyBank = $serverBank->reply($requestShop);

echo $replyBank, "\n";