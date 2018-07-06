<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/7/6
 * Time: 10:39
 */

namespace App\Models\Traits;

use Redis;
use Carbon\Carbon;

trait LastActiveAtHelper
{
    protected $hash_prefix = 'last_active_at_';
    protected $field_prefix = 'user_';

    public function recordLastActiveAt()
    {
        //获取今天的日期
        $date= Carbon::now()->toDateString();

        $hash = $this->getHashFromDateString($date);

        $field = $this->getHashField();


        $time = Carbon::now()->toDateTimeString();

        Redis::hSet($hash, $field, $time);
    }

    public function syncUserActiveAt()
    {
        //获取昨天日期
        $yesterday_date = Carbon::yesterday()->toDateString();

        //获取昨日哈希表名字
        $hash = $this->getHashFromDateString($yesterday_date);

        //获取哈希表数据
        $dates = Redis::hGetAll($hash);

        foreach ($dates as $user_id => $value) {
            $user_id = str_replace($this->field_prefix, '', $user_id);

            if ($user = $this->find($user_id)) {
                $user->last_active_at = $value;
                $user->save();
            }
        }

        //以保存 删除缓存
        Redis::del($hash);
    }

    public function getLastActivedAtAttribute($value)
    {
        $date = Carbon::now()->toDateString();

        $hash = $this->getHashFromDateString($date);

        $field = $this->getHashField();

        $datetime = Redis::hGet($hash,$field) ? : $value;

        if ($datetime) {
            return new Carbon($datetime);
        } else {
            return $this->created_at;
        }
    }

    public function getHashFromDateString($dateString)
    {
        return $this->hash_prefix . $dateString;
    }

    public function getHashField()
    {
        return $this->field_prefix . $this->id;
    }
}