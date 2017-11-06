<?php

namespace App\Controllers;


use Slim\Http\Request;
use Slim\Http\Response;

class UserController extends BaseController
{
    public function search(Request $request, Response $response)
    {
        $users = $this->container->em->getRepository('App\Models\User')->findByFields($request->getParams());
        var_dump($users);
        return $response->withJSON($users);
    }
}