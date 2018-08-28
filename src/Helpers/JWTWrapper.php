<?php

use \Firebase\JWT\JWT;
 
/**
 * Gerenciamento de tokens JWT
 */
class JWTWrapper
{
const privateKey = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIICWwIBAAKBgHtKHlZxLM7qb7xC5s7LHpGKmMcHgvfv79Ltp/QRtVqkZIEeqvtS
YQ+beJrOWaePPNxxJz7/4DQigPwwmpspVoZg1UjEtgF11R9ipWHVW44jYGS4fy56
bXS4rn/o8SdEc3uCiB7vbilRYvl7BFyewaoclU5t+gVcH6C+gWpw8u/ZAgMBAAEC
gYBvGWZnPQtE1muj+aGlvdIpEv0DdVhm9pdluvV7ci27paJP3IP1f9GpT8+JqOOP
o/sTJwBXvBqcwG79UwsvQTwPDbHju2zjMXSmjCFPYz8OR5Zh9x/mMy89PTRXDJhP
UXfp82FZGVfZRCsuNwuzub/f2a/UxAuw84lU9N2o6NNuAQJBAM/pV6+4VTIAAu2Y
1s3vBOj6dP/BLw9upceaXx66ahiQ420647KccNrsqb54nZZlpvNSeAZ1QbqoAWh6
fFIJWpkCQQCXzjhz+gHgLRuEfF6wt6xQxGb3H/MeqXr84TgaSxQEAz8LlO99BahN
c/tl0wdRV34uI5ytrfvX5wQN3PG+FsdBAkBPzW3VybgRuAVns0mHw92rmy67WCg7
ESpaofsurTi58ysIKxlo3jlHHp3MuTkrmBrrvFTLjchL396ifpknV+XJAkBcms1v
WmTIh1vQ/zmYXgN9JcKWIGRkIQlIuG9MAt7L79sGyq0pvEjGLul+XTSKl2/+33SV
spv+QgwEFPNXfXfBAkEAo0xXPWQOHS3OBtKOOVONnsh7Z2TkbWE1X7H3uIfWB4hD
kTcRskUAUOqZEOe22rZn5vclBzzGANNFtAYm+ffuBQ==
-----END RSA PRIVATE KEY-----
EOD;

const publicKey = <<<EOD
-----BEGIN PUBLIC KEY-----
MIGeMA0GCSqGSIb3DQEBAQUAA4GMADCBiAKBgHtKHlZxLM7qb7xC5s7LHpGKmMcH
gvfv79Ltp/QRtVqkZIEeqvtSYQ+beJrOWaePPNxxJz7/4DQigPwwmpspVoZg1UjE
tgF11R9ipWHVW44jYGS4fy56bXS4rn/o8SdEc3uCiB7vbilRYvl7BFyewaoclU5t
+gVcH6C+gWpw8u/ZAgMBAAE=
-----END PUBLIC KEY-----
EOD;

    const KEY = '7Fsxc2A865V6'; // chave
 
    /**
     * Geracao de um novo token jwt
     */
    public static function encode(array $options)
    {
        $issuedAt = time();
        $expire = $issuedAt + $options['expiration_sec']; // tempo de expiracao do token
 
        $tokenParam = [
            'iat'  => $issuedAt,            // timestamp de geracao do token
            'iss'  => $options['iss'],      // dominio, pode ser usado para descartar tokens de outros dominios
            'exp'  => $expire,              // expiracao do token
            'nbf'  => $issuedAt - 1,        // token nao eh valido Antes de
            'data' => $options['userdata'], // Dados do usuario logado
        ];
 
        return JWT::encode($tokenParam, self::privateKey,'RS256');
    }
 
    /**
     * Decodifica token jwt
     */
    public static function decode($jwt)
    {
        return JWT::decode($jwt, self::publicKey, ['RS256']);
    }
}

?>