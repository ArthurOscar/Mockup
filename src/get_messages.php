<?php

session_start();


require("phpMQTT.php");
require __DIR__ . '/../includes/env_loader.php';

// Carrega as variáveis do .env
loadEnv(__DIR__ . '/../includes/.env');

$server = $_ENV['MQTT_SERVER'];
$port = (int) $_ENV['MQTT_PORT'];
$topic = $_ENV['MQTT_TOPIC'];
$client_id = "phpmqtt-" . rand();
$username = $_ENV['MQTT_USERNAME'];
$password = $_ENV['MQTT_PASSWORD'];

header('Content-Type: application/json');

$messages = [];

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
if (!$mqtt->connect(true, NULL, $username, $password)) {
    echo json_encode(["error" => "Não foi possível conectar ao broker"]);
    exit;
}

// Subscribing e coletando mensagens por 1-5 segundos
$mqtt->subscribe([$topic => ["qos" => 0, "function" => function ($topic, $msg) use (&$messages) {
    $messages[] = ["topic" => $topic, "msg" => $msg, "time" => date("H:i:s")];
}]], 0);

$start = time();
while (time() - $start < 5) { // escuta 5 segundos
    $mqtt->proc();
}

var_dump($messages);

$mqtt->close();

$_SESSION['resposta'] = $messages;
?>