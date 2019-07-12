<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CustomField extends Model
{
    protected $fillable = [
        'type',
        'value'
    ];

    const COLOR = 1;
    const SIZE = 2;

    public static function getName($num, $plural = 0)
    {
        switch ($num) {
            case self::COLOR:
                return $plural ? 'الألوان' : 'لون';
                break;
            case self::SIZE:
                return $plural ? 'القياسات' : 'قياس';
                break;
            default:
                return '';
        }
    }
}
