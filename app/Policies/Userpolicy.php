<?php

namespace App\Policies;

use App\Models\User;

class Userpolicy
{
  public function ViewAnyUser(User $user){
    return $user->role()->id=== 1;

  }
  public function view(user $user, User $model){
    return $user->id===$model->id|| $user->role()->id===1;
  }

  public function create(?user $user){
    return true;
  }
  public function update(user $user, user $model){
    return $user->id===$model->id||$user->role->id===1;

  }
  public function delete(user $user){
    return $user->role()->id===1;
  }
}
