<?php

namespace App\Helpers;

use App\Exceptions\ExpiredJwtTokenException;
use App\Exceptions\InvalidJwtTokenException;

class Jwt
{
    private $appSecret = '423c2cbbdb529a30e472e847b0edd721ab88ee8e-';
    private $algorithm = 'HS256';
    private $type = 'JWT';
    private $hash = 'sha256';
    private $context;
    private $expire;
    private $renew;

    /**
     * constructor
     * @param int $context token context
     * @param int $expire token expiration time
     * @param int $renew token renew time
     */
    public function __construct(
        string $context = 'user',
        int $expire = 900,
        int $renew = 600
    ) {
        $this->context = $context;
        $this->expire = $expire;
        $this->renew = $renew;
    }

    /**
     * method to mount and get the header part
     * @return string $header base64 header
     */
    private function getHeader() :string
    {
        $header = [
            'alg' => $this->algorithm,
            'typ' => $this->type,
        ];
        $header = json_encode($header);
        $header = base64_encode($header);
        return $header;
    }

    /**
     * method to mount and get the payload part
     * @param string $audience audience name
     * @param int $subject subject id
     * @return string $payload base64 payload
     */
    private function getPayload(
        string $audience,
        int $subject
    ) :string {
        $payload = [
            'aud' => $audience,
            'exp' => $this->expire,
            'iat' => time(date('Y-m-d H:i:s')),
            'iss' => 'myeduzz-api-'.$this->context,
            'sub' => $subject,
        ];
        $payload = json_encode($payload);
        $payload = base64_encode($payload);
        return $payload;
    }

    /**
     * method to mount and get the signature part
     * @param string $header header base64
     * @param string $payload payload base64
     */
    private function getSignature(
        string $header,
        string $payload
    ) :string {
        $signature = hash_hmac(
            $this->hash,
            $header.'.'.$payload,
            $this->appSecret.$this->context,
            true
        );
        $signature = base64_encode($signature);
        return $signature;
    }

    /**
     * method to split in parts a received token
     * @param string $token received token
     * @return array $parts parts of token
     */
    private function splitParts(
        string $token
    ) :array {
        $part = explode('.', $token);
        $parts = [
            'header' => $part[0],
            'payload' => $part[1],
            'signature' => $part[2],
        ];
        return $parts;
    }

    /**
     * method actual expire time
     * @return int $header base64 header
     */
    public function getexpire() :int
    {
        return $this->expire;
    }

    /**
     * method to generate token
     * @param string $audience token audience
     * @param int $subject token subject
     * @return string $token generated token
     */
    public function generate(
        string $audience,
        int $subject = 0
    ) :string {
        $header = $this->getHeader();
        $payload = $this->getPayload($audience, $subject);
        $signature = $this->getSignature($header, $payload);
        
        $token = $header.'.'.$payload.'.'.$signature;
        return $token;
    }

    /**
     * method to check if is a valid token
     * @param string $token token to validate
     * @throws InvalidJwtTokenException
     * @return bool
     */
    public function isValid(
        string $token
    ) :bool {
        $correctFormat = preg_match('^([a-zA-Z0-9_=]{4,})\.([a-zA-Z0-9_=]{4,})\.([a-zA-Z0-9_\-\+\/=]{4,})^', $token);
        if (!$correctFormat) {
            throw new InvalidJwtTokenException();
        }

        $part = $this->splitParts($token);
        $valid = $this->getSignature($part['header'], $part['payload']);

        if ($part['signature'] !== $valid) {
            throw new InvalidJwtTokenException();
        }
        return true;
    }

    /**
     * method to check if token is on time
     * @param string $token token to validate
     * @throws InvalidJwtTokenException
     * @throws ExpiredJwtTokenException
     * @return bool
     */
    public function isOnTime(
        string $token
    ) :bool {
        $payload = $this->decodePayload($token);
        $iat = $payload['iat'] ?? null;
        $exp = $payload['exp'] ?? null;
        if (empty($iat) || empty($exp)) {
            throw new InvalidJwtTokenException();
        }

        $validUntil = date('Y-m-d H:i:s', $iat + $exp);
        $moment = date('Y-m-d H:i:s');
        if ($moment > $validUntil) {
            throw new ExpiredJwtTokenException();
        }
        return true;
    }

    /**
     * method to check if is need refresh token
     * @param string $token token to check
     * @throws InvalidJwtTokenException
     * @return bool
     */
    public function tokenNeedToRefresh(
        string $token
    ) :bool {
        $payload = $this->decodePayload($token);
        $iat = $payload['iat'] ?? null;
        $exp = $payload['exp'] ?? null;
        if (empty($iat) || empty($exp)) {
            throw new InvalidJwtTokenException();
        }

        $almostExpired = date('Y-m-d H:i:s', $iat + $this->renew);
        $moment = date('Y-m-d H:i:s');
        if ($moment > $almostExpired) {
            return true;
        }
        return false;
    }

    /**
     * method to decode token payload
     * @param string $token token to decode
     * @return array $data decoded payload
     */
    public function decodePayload(
        string $token
    ) :array {
        $part = $this->splitParts($token);
        $payload = $part['payload'];

        $data = base64_decode($payload);
        $data = json_decode($data, true);
        return $data;
    }
}
