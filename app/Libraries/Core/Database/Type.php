<?php

namespace App\Libraries\Core\Database;

enum Type
{
    case VarChar;
    case Text;
    case Int;
    case BigIncrement;
    case Timestamp;
    case Bool;
    case Geometry;
    case BigInt;
    case Decimal;
}
