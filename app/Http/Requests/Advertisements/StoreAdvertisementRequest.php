<?php

namespace App\Http\Requests\Advertisements;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreAdvertisementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
			'content' => ['required', 'string'],
			'price' => ['required', 'integer'],
			'category_id' => ['required', Rule::exists('categories', 'id')],
        ];
    }
}
