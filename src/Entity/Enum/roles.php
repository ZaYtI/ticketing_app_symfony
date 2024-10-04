<?php

namespace App\Entity\Enum;

enum Roles: string
{
    case ADMIN = "ADMIN";
    case SUPPORT = "SUPPORT";
    case USER = "USER";
}
