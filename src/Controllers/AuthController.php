<?php

namespace App\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Respect\Validation\Validator as V;
use Slim\Http\Request;
use Slim\Http\Response;
use Tuupola\Base62;

class AuthController extends BaseController
{
    const KEY_PARAM_PASSWORD = 'password';
    const KEY_PARAM_USERNAME = 'username';

    public function login(Request $request, Response $response) : Response
    {
        $users = $this->container->em
            ->getRepository('App\Models\User')
            ->findBy([self::KEY_PARAM_USERNAME => $request->getParam(self::KEY_PARAM_USERNAME)]);

        $pwd = $request->getParam(self::KEY_PARAM_PASSWORD);
        $validUser = array_filter($users, function (User $user) use ($pwd) {
            return password_verify($pwd, $user->getPassword());
        });

        if (count($validUser) != 1) {
            return $response->withJson('invalid user', 403);
        }

        $now = new \DateTime();
        $future = new \DateTime("+10 minutes");
        $server = $request->getServerParams();
        $jti = (new Base62)->encode(random_bytes(16));
        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "jti" => $jti,
            "sub" => $server["PHP_AUTH_USER"]
        ];
        $secret = "123456789helo_secret";
        $token = JWT::encode($payload, $secret, "HS256");
        $data["token"] = $token;
        $data["expires"] = $future->getTimeStamp();

        return $response->withStatus(201)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
}