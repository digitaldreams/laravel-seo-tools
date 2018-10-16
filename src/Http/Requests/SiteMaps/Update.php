<?php

namespace SEO\Http\Requests\SiteMaps;

use Illuminate\Foundation\Http\FormRequest;
use SEO\Models\Setting;

class Update extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('index', Setting::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'page_id.*' => 'required|exists:seo_pages,id',
            'change_frequency.*' => 'required',
            'priority.*' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [

        ];
    }

}
