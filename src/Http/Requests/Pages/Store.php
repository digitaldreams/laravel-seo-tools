<?php

namespace SEO\Http\Requests\Pages;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'path' => 'required|unique:seo_pages,path|max:255',
            'route_name' => 'nullable|max:150',
            'robot_index' => 'nullable|max:50',
            'robot_follow' => 'nullable|max:50',
            'canonical_url' => 'nullable|max:255',
            'title' => 'required|max:70',
            'description' => 'required|max:170',
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
