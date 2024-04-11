<?php

namespace App\Modules\Base\Traits;

trait EnumToArray
{
    public static function toArray()
    {
        $data = [];

        foreach (self::cases() as $case){
            $data[$case->name] = $case->value;
        }

        return $data;
    }

}
