<?php

namespace App\Enums;

enum RoleEnum: string
{
    case advertiser = 'advertiser';
    case webmaster = 'webmaster';

    public function values(): string
    {
        return match ($this) {
            self::advertiser => self::advertiser->value,
            self::webmaster => self::webmaster->value,
        };
    }

}
