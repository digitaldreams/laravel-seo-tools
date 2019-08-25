<?php

namespace SEO\Http\Requests\Pages;

use Illuminate\Foundation\Http\FormRequest;
use SEO\Models\Page;

class BulkUpdate extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('bulkUpdate', Page::class);
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
            'robot_index.*' => 'required|max:50',
            'title.*' => 'required|max:70',
            'description.*' => 'required|max:170',

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
