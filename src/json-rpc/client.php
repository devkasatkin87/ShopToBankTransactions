<?php

use Datto\JsonRpc\Client;

require_once __DIR__ . '/vendor/autoload.php';

$clientShop = new Client();

$clientShop->query(1, 'block', ['Petrovskiy Albert Ivanovich', '2341 9876 0913 1323', '09/2018', '875', 212]);

$clientShop->query(2, 'withdraw', ['Kirilov Oleg Karlovich', '3221 0292 2121 1341', '10/2020', '092', 100]);

$clientShop->query(3, 'withdraw', ['Koralov Mikhail Petrovich', '3311 0101 0222 0988', '09/2017', '011', 150]);

$clientShop->query(4, 'block', ['2341 9876 0913 1323', '09/2018', '875', 212]);

$queries = $clientShop->encode();

//echo "Sended queries:\n{$quaries}\n\n";

$guzzle = new GuzzleHttp\Client();

$guzzle_reply = $guzzle->post('http://webserver/jrpc/', ['body' => $queries]);

$replyBank = $guzzle_reply->getBody();

//echo "Response $replyBank" . PHP_EOL;

$responses = $clientShop->decode($replyBank);

echo "Bank responses for transactions:\n";

foreach ($responses as $response) {
    
	$id = $response->getId();
        
	$isError = $response->isError();
        
	if ($isError) {
            
		$error = $response->getError();
                
		$errorProperties = array(
                    
			'code' => $error->getCode(),
                    
			'message' => $error->getMessage(),
                    
			'data' => $error->getData()
		);
                
		echo " Operation # {$id}, error: ", json_encode($errorProperties), "\n";
                
	} else {
            
		$result = $response->getResult();
                
		echo "Operation # {$id}, Operation result: ", json_encode($result), "\n";
	}
}
echo "\n";


