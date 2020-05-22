<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait Avatarable
{
    public function getNameUser()
    {
        return $this->family . ' ' . $this->name;
    }

    // افزودن عکس به اطلاعات
    public function initializeAvatarable()
    {
        $this->append('avatar');
    }

    // آدرس عکس اواتار
    public function getAvatarAttribute()
    {
        return Cache::rememberForever('avatar' . $this->attributes['id'], function () {
            return "https://ui-avatars.com/api/?name=" . $this->getNameUser() . "&bold=true&background=" . $this->getAvatarBackground() . "&color=" . $this->getAvatarColor();
        });
    }

    // رنگ پس زمینه اواتار
    public function getAvatarBackground()
    {
        return Cache::rememberForever('avatar_background' . $this->attributes['id'], function () {
            return $this->rand_color(2);
        });
    }

    // رنگ متن اواتار
    public function getAvatarColor()
    {
        return Cache::rememberForever('avatar_color' . $this->attributes['id'], function () {
            return $this->rand_color();
        });
    }

    // رنگ رندوم
    public function rand_color($opacity = 1)
    {
        return str_pad(dechex(mt_rand(0xFFFFFF / $opacity, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}
