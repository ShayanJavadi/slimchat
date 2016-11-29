<?php
use SMA\Middleware\AuthMiddleware;
use SMA\Middleware\GuestMiddleware;
//setName gives a name so we can point back to it somewhere else
//route for homepage
$app->get('/', 'HomeController:index')->setName('home');
//Guest routes
$app->group('',function(){
  //sign in routes
  $this->get('/signin', 'AuthController:getSignIn')->setName('auth.signin');
  $this->post('/signin', 'AuthController:postSignIn');
  //sign up routes
  $this->get('/signup', 'AuthController:getSignUp')->setName('auth.signup');
  $this->post('/signup', 'AuthController:postSignUp');
})->add(new GuestMiddleware($container));



//authenticated routes
$app->group('', function(){
  //signout routes
  $this->get('/signout', 'AuthController:getSignOut')->setName('auth.signout');
  //changing password routes
  $this->get('/changepassword', 'PasswordController:getChangePassword')->setName('auth.changepassword');
  $this->post('/changepassword', 'PasswordController:postChangePassword');

  //chat room views
  $this->get('/profile', 'ChatRoomController:profile')->setName('profile');
  //creating chatrooms
  $this->get('/create-room', 'ChatRoomController:getCreateRoom')->setName('chat.create-room');
  $this->post('/create-room', 'ChatRoomController:postCreateRoom')->setName('chat.create-room');
  //deleting chatrooms
  $this->get('/delete-room', 'ChatRoomController:getDeleteRoom')->setName('chat.delete-room');
  //joining the chatroom
  $this->get('/chat-room', 'ChatRoomController:getRoom')->setName('chat.chat-room');
  //join owned chatroom
  $this->get('/join-room', 'ChatRoomController:getJoinRoom')->setName('chat.join-room');
  $this->post('/join-room', 'ChatRoomController:postJoinRoom');
})->add(new AuthMiddleware($container));

 ?>
