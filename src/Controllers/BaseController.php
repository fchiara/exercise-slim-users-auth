<?php

namespace App\Controllers;


use Slim\Container;

class BaseController
{
    /** @var  Container */
    protected $container;

    /**
     * BaseController constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

}