<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msgboard extends Model
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

    /**
     * 取得此留言的所有回覆訊息
     *
     * @return HasMany
     */
    public function replies() {
        return $this->hasMany('App\Reply');
    }

    /**
     * 取得留言的上傳圖片
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function uploads() {
        return $this->hasMany('App\Upload');
    }
}
