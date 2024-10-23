<?php

namespace App\Entity\Enum;

enum Status: string
{
    case OPEN = "OPEN";
    case IN_PROGRESS = "IN_PROGRESS";
    case RESOLVE = "RESOLVE";
    case CLOSE = "CLOSE";
}
