<?php

namespace App\Http\Requests\Admin;

use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->type == Item::Category) {
            return [
                'title_ar' => 'required',
            ];
        }
        switch ($this->method()) {
            case 'POST':
                if ($this->type == Item::SLIDER) {
                    return [
                        'image' => 'required|image|mimes:mp4,jpg,png,jpeg,gif',
                    ];
                }
                return [
                    'image' => 'required|image',
                    'title_ar' => 'required',
                    'content_ar' => 'required',
                ];
                break;
            case 'PUT':
            case 'PATCH':
                if ($this->type == Item::SLIDER) {
                    return [
                    ];
                }
                return [
                    'title_ar' => 'required',
                    'content_ar' => 'required',
                ];
                break;
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'title_ar.required' => 'العنوان بالعربية مطلوبة',
            'title_en.required' => 'العنوان بالانجليزية مطلوبة',
            'title_ru.required' => 'العنوان بالروسية مطلوبة',
            'title_fr.required' => 'العنوان بالفرنسية مطلوبة',
            'content_ar.required' => 'المحتوى بالعربية مطلوب',
            'content_fr.required' => 'المحتوى بالفرنسية مطلوب',
            'content_ru.required' => 'المحتوى بالروسية مطلوب',
            'content_en.required' => 'المحتوى بالانجليزية مطلوب',
            'image.required' => 'الصورة مطلوبة',
        ];
    }
}
