<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Link extends Model
{
    protected $fillable = ['title', 'link'];
    protected $cache_key = 'larabbs_links';
    protected $cache_expire_in_minutes = 1440;

    public function getAllCached()
    {
        //尝试从缓存中取出 cache_key 对应的数据, 如果能取到 直接返回
        //不能取到  查询数据  加以缓存
        return Cache::remember($this->cache_key, $this->cache_expire_in_minutes, function (){
            return $this->all();
        });
    }
}
