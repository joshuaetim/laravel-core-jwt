<?php

namespace App\Handlers\Admin;

use Firebase\JWT\JWT;
use DateTimeImmutable;

class AuthHandler
{
    /**
     * Handles operations related to admin authentication
     */

    // generate token
    public function GenerateToken($user)
    {
        $secretKey  = env('JWT_KEY');
        $tokenId    = base64_encode(random_bytes(16));
        $issuedAt   = new DateTimeImmutable();
        $expire     = $issuedAt->modify('+6 minutes')->getTimestamp();      // Add 60 seconds
        $serverName = "your.pbn.name";
        $userID   = $user->id;                                           // Retrieved from filtered POST data

        // Create the token as an array
        $data = [
            'iat'  => $issuedAt->getTimestamp(),    // Issued at: time when the token was generated
            'jti'  => $tokenId,                     // Json Token Id: an unique identifier for the token
            'iss'  => $serverName,                  // Issuer
            'nbf'  => $issuedAt->getTimestamp(),    // Not before
            'exp'  => $expire,                      // Expire
            'data' => [                             // Data related to the signer user
                'userID' => $userID,            // User name
            ]
        ];

        // Encode the array to a JWT string.
        $token = JWT::encode(
            $data,      //Data to be encoded in the JWT
            $secretKey, // The signing key
            'HS512'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
        );
        return $token;
    }
}