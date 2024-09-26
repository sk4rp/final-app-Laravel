<?php

namespace App\Enums;

enum RoleEnum: string
{
    case advertiser = 'advertiser';
    case webmaster = 'webmaster';
    case admin = 'admin';
}
