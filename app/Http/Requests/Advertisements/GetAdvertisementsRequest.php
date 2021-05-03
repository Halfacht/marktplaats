<?php

namespace App\Http\Requests\Advertisements;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetAdvertisementsRequest extends FormRequest
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
        return [
            'categories' => ['nullable', 'array'],
			'categories.*' => ['integer'],
			'fromPostcode' => ['nullable', Rule::exists('postcodes', 'postcode')],
			'maxDistance' => ['nullable', 'integer'],
        ];
    }

	protected function prepareForValidation()
    {
        $this->merge([
            'categories' => $this->categories ? explode(',', $this->categories) : null,
        ]);
    }
}
