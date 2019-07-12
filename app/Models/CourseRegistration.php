<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;

class CourseRegistration extends Model
{
    protected $fillable = [
        'name',
        'company',
        'position',
        'english_level',
        'company_phone',
        'fax',
        'email',
        'mobile',
        'accepted',
        'paid',
        'item_id'
    ];

    public function course()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id', 'item');
    }

    public function getStatusAttribute()
    {
        if(isset($this->accepted)){
            switch ($this->accepted) {
                case 1:
                    return 'Accepted';
                    break;
                case 0:
                    return 'Declined';
                    break;
                default:
                    return 'Wrong';
            }
        }

        return 'Pending';
    }

    public function getPaymentStatusAttribute()
    {
        switch ($this->paid) {
            case 1:
                return 'Paid';
                break;
            case 0:
                return 'Not Paid';
                break;
            default:
                return 'Wrong';
        }
    }
}
