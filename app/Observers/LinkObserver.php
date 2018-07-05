<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/7/5
 * Time: 17:37
 */

namespace App\Observers;
use App\Models\Link;
use Cache;

class LinkObserver
{
    //保存时清空 cache_key 对应的缓存
    public function saved(Link $link)
    {
        Cache::forget($link->cache_key);
    }
}