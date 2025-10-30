<?php

class Email
{
    public function EmailVerify($email)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://emailreputation.abstractapi.com/v1/?api_key=8ab3a072073f4018b6c30d31a6345052&email=' . urlencode($email));
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