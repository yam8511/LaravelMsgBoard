<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    /**
     * 取得留言者資訊
     *
     * @param $id
     * @return string
     */
    public function user($id)
    {
        $user = User::find($id);
        return $user;
    }
    /**
     * 取得留言者名稱
     *
     * @param $id
     * @return string
     */
    public function username($id)
    {
        $user = User::find($id);
        if($user) {
            return $user->name;
        } else {
            return 'Guest';
        }
    }

    public function Message() {
        return $this->belongsTo('App\Msgboard');
    }
}
