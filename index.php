<?php
header("Content-type: text/html; charset=utf-8"); 
class mycrypt {

    public $pubkey;
    public $privkey;

    function __construct() {
                $this->privkey = file_get_contents('key/rsa_private_key.pem');
                $this->pubkey = file_get_contents('key/rsa_public_key.pem');
    }

    public function encrypt($data) {
		openssl_public_encrypt($data, $encrypted, $this->pubkey);
		return base64_encode($encrypted);
    }

    public function decrypt($data) {
        if (openssl_private_decrypt(base64_decode($data), $decrypted, $this->privkey))
            $data = $decrypted;
        else
            $data = '';

        return $data;
    }

}

$rsa = new mycrypt();
//echo $rsa -> encrypt('大家好才是真的好');
echo $rsa -> decrypt('oND7K8nlRsvjIBfC9oBPe0/2HgRkNUTLbHpT2SUkEDHHy3O5nOBz1nExuiP24Hl0 JEQdpgCkUHM3y9uH1V5EC6X7ibCNiXrQUs3CxCO22IkDYsysu9rqrm2/cA2msi1G ecelZ8GKyHwfjbsjtmMS79KMGjB5R2lycgua4NhQyR4=');
