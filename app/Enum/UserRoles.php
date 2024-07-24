<?php

namespace App\Enum;

enum UserRoles: int
{
    case ADMINISTRATOR = 1;
    case DATAENTRY = 2;
    case USER = 3;
}
