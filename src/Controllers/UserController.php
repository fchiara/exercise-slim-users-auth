<?php

namespace App\Controllers;


use App\Serializers\UserSerializer;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController extends BaseController
{
    public function search(Request $request, Response $response) : Response
    {
        $users = $this->container->em->getRepository('App\Models\User')->findByFields($request->getParams());
        $serializer = new UserSerializer();
        $res = [];
        foreach ($users as $u){
            $res[] = $serializer->build($u);
        }
        return $response->withJSON($res);
    }
}