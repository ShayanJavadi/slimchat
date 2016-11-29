<?php

namespace SMA\Controllers;

use SMA\Models\User;
use SMA\Controllers\Controller;
use Slim\views\Twig as View;

class HomeController extends Controller
{
  public function index($request, $response)
  {

    // $user = User::where('email', 'shayan@gmail.com')->first();
    // var_dump($user->email);
    // die();

    return $this->view->render($response, 'home.twig');
  }

}


 ?>
