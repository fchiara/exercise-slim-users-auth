<?php

$app->post('/login', 'AuthController:login');
$app->get('/users', 'UserController:search');
