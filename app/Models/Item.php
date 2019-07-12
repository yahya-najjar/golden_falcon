<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use Kalnoy\Nestedset\NodeTrait;

class Item extends Model
{
    use Translatable;
    use NodeTrait;

    const SLIDER = 1;
    const Category = 2;
    const Product = 3;
    const About = 4;

    protected $fillable = [
        'image',
        'active',
        'home',
        'link',
        'date',
        'view_in_home',
        'colors',
        'sizes',
        'code_number',
    ];

    protected $casts = [
        'colors' => 'array',
        'sizes' => 'array',
    ];

    public $translatedAttributes = [
        'title',
        'content'
    ];

    public function scopeActive($query)
    {
        return $query->whereActive(1);
    }

    public function scopeHome($query)
    {
        return $query->whereHome(1);
    }

    public static function getName($num, $plural = 0)
    {
        switch ($num) {
            case self::SLIDER:
                return $plural ? 'الصور' : 'صورة';
                break;
            case self::Category:
                return $plural ? 'الفئات' : 'فئة';
                break;
            case self::Product:
                return $plural ? 'المنتجات' : 'منتج';
                break;
            default:
                return '';
        }
    }

    public function images()
    {
        return $this->hasMany(AlbumImage::class);
    }

    public function products()
    {
        return $this->descendants()->active()->whereType(self::Product);
    }

    public function scopeHasProducts($query)
    {
        return $query->whereType(self::Category)->whereHas('descendants', function ($q) {
            $q->whereType(self::Product)->active();
        })->withDepth()->having('depth', '=', 0);
    }

    public function scopeHasProductsHomeMenu($query)
    {
        return $query->whereType(self::Category)->whereHas('descendants', function ($q) {
            $q->whereType(self::Product)->active();
        })->with([
            'children' => function ($q) {
                $q->whereHas('descendants', function ($q) {
                    $q->whereType(self::Product)->active();
                });
            }
        ])->withDepth()->having('depth', '=', 0);
    }

    public function scopeHasProductsHome($query)
    {
        return $query->whereType(self::Category)->whereHas('descendants', function ($q) {
            $q->whereType(self::Product)->active();
        });
    }


}
