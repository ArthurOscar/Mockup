<?php

session_start();



require("phpMQTT.php");
require __DIR__ . '/../includes/env_loader.php';

// Carrega as variáveis do .env
loadEnv(__DIR__ . '/../includes/.env');

$server = $_ENV['MQTT_SERVER'];
$port = (int) $_ENV['MQTT_PORT'];
$topic_ilu = "s1/iluminacao";
$topic_temp = "s1/temperatura";
$topic_umi = "s1/umidade";
$client_id = "phpmqtt-" . rand();
$username = $_ENV['MQTT_USERNAME'];
$password = $_ENV['MQTT_PASSWORD'];

header('Content-Type: application/json');

$messages_ilu = [];
$messages_temp = [];
$messages_umi = [];

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
if (!$mqtt->connect(true, NULL, $username, $password)) {
    echo json_encode(["error" => "Não foi possível conectar ao broker"]);
    exit;
}

// Subscribing e coletando mensagens por 2 segundos
$mqtt->subscribe([$topic_ilu => ["qos" => 0, "function" => function ($topic_ilu, $msg_ilu) use (&$messages_ilu) {
    $messages_ilu[] = ["topic" => $topic_ilu, "msg" => $msg_ilu, "time" => date("H:i:s")];
}]], 0);

$mqtt->subscribe([$topic_temp => ["qos" => 0, "function" => function ($topic_temp, $msg_temp) use (&$messages_temp) {
    $messages_temp[] = ["topic" => $topic_temp, "msg" => $msg_temp, "time" => date("H:i:s")];
}]], 0);

$mqtt->subscribe([$topic_umi => ["qos" => 0, "function" => function ($topic_umi, $msg_umi) use (&$messages_umi) {
    $messages_umi[] = ["topic" => $topic_umi, "msg" => $msg_umi, "time" => date("H:i:s")];
}]], 0);

$start = time();
while (time() - $start < 2) { // escuta 2 segundos
    $mqtt->proc();
}

$mqtt->close();

$_SESSION['resposta_ilu'] = $messages_ilu;
$_SESSION['resposta_temp'] = $messages_temp;
$_SESSION['resposta_umi'] = $messages_umi;
header("location: ../public/index_dashboard.php");
?>