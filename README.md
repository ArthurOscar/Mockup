# Como rodar o código:
- Clone este repósitorio na pasta htdocs e mude suas credenciais no config_example.php e procurar para o dono do repositório para colar o arquivo .env
- Copie todo o schema.sql e cole na caixa de consulta sql no phpmyadmin
- Logo após, copia e cola o arquivo seed.sql no mesmo lugar
- Ligue o xampp e execute com localhost no seu navegador
- Exemplo de URL do navegador: localhost/mockup/public/index.php
- Realize o login com email: 'admin@email.com' e senha 'senha123'

# API utilizada:
- Abstract API
- Usada para validar emails, verificar seu domínio, e várias outras propriedades do email

# EndPoint:
- https://emailreputation.abstractapi.com/v1/
- End point com api do email -> https://emailreputation.abstractapi.com/v1/?api_key=8ab3a072073f4018b6c30d31a6345052&email=(email)

# Exemplo de resposta:
- A resposta dada em json, com várias linhas com funções para chamadas diferentes:
{
    "email_address": "arthur_o_soares@estudante.sesisenai.org.br",
    "email_deliverability": {
        "status": "deliverable",
        "status_detail": "valid_email",
        "is_format_valid": true,
        "is_smtp_valid": true,
        "is_mx_valid": true,
        "mx_records": [
            "aspmx.l.google.com",
            "alt1.aspmx.l.google.com",
            "alt2.aspmx.l.google.com",
            "aspmx2.googlemail.com",
            "aspmx3.googlemail.com"
        ]
    },
    "email_quality": {
        "score": "0.80",
        "is_free_email": false,
        "is_username_suspicious": false,
        "is_disposable": false,
        "is_catchall": true,
        "is_subaddress": false,
        "is_role": false,
        "is_dmarc_enforced": false,
        "is_spf_strict": true,
        "minimum_age": null
    },
    "email_sender": {
        "first_name": "Arthur",
        "last_name": null,
        "email_provider_name": "Google",
        "organization_name": "Espaço do Estudante SESI SENAI",
        "organization_type": null
    },
    "email_domain": {
        "domain": "estudante.sesisenai.org.br",
        "domain_age": 2303,
        "is_live_site": true,
        "registrar": "",
        "registrar_url": null,
        "date_registered": "2019-07-08",
        "date_last_renewed": "2024-06-27",
        "date_expires": "2029-07-08",
        "is_risky_tld": false
    },
    "email_risk": {
        "address_risk_status": "low",
        "domain_risk_status": "medium"
    },
    "email_breaches": {
        "total_breaches": 0,
        "date_first_breached": null,
        "date_last_breached": null,
        "breached_domains": []
    }
}

# Rodar ela:
 - Somente colocar este código para rodar:
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, 'https://emailreputation.abstractapi.com/v1/?api_key=8ab3a072073f4018b6c30d31a6345052&email=arthur_o_soares@estudante.sesisenai.org.br');
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
   $data = curl_exec($ch);
   curl_close($ch);
   echo $data;
- Não achei uma limitação pro meu projeto aplicado, mas pode ser uma delas, o plano gratuito, que não aceita muitos requisições por segundo, algo resolvido no plano pago.

# Testes
- Email válido:
<img width="342" height="655" alt="image" src="https://github.com/user-attachments/assets/11353851-0a1a-4f8c-9607-f35e1414cd84" />
<img width="1418" height="546" alt="image" src="https://github.com/user-attachments/assets/04379679-cc58-4906-8911-a4539906a580" />

- Email inválido:
<img width="342" height="505" alt="image" src="https://github.com/user-attachments/assets/80a016ed-5eb9-4a77-ae86-f0b17d288fba" />
<img width="437" height="149" alt="image" src="https://github.com/user-attachments/assets/613628df-ecd7-452c-9c36-98b7abf01bcc" />
<img width="1326" height="637" alt="image" src="https://github.com/user-attachments/assets/4e38dc22-751c-454e-9ad4-40c763f48001" />
