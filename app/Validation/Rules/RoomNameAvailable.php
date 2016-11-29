<?php

namespace SMA\Validation\Rules;

use SMA\Models\Chatroom;
use Respect\Validation\Rules\AbstractRule;

//make our custom rules using the AbstractRule class
class RoomNameAvailable extends AbstractRule
{
  public function validate($input)
  {
    //if 1 then already taken
    return Chatroom::where('room_name', $input)->count() === 0;
  }
}


 ?>
