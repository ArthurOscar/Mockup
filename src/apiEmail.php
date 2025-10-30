<?php

class Email
{
    // Cria uma váriavel privada
    private $apiUrl;

    public function __construct()
    {
        // Carrega o arquivo de configuração
        $config = include __DIR__ . '/../includes/config.php';
        $this->apiUrl = $config['API_Key'];
    }

    public function EmailVerify($email)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . urlencode($email));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $data = curl_exec($ch);
        curl_close($ch);
        // Decodifica a requisição que é dada em JSON
        $dado = json_decode($data, true);
        // Verifica a validade do email pela API
        if (isset($dado["email_deliverability"]["status_detail"]) && $dado["email_deliverability"]["status_detail"] === "valid_email") {
            return true;
        } else {
            return false;
        }
    }
}