<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticlesRequest extends FormRequest
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
            'title'=>['required'],
            'content'=>['required','min:10'],
            'tags'=>['required', 'array'],
        ];
    }

    public function messages()
    {
      return [
        'required'=>':attribute is required',
        'min'=>'attribute is over :min required',
      ];
    }

    public function attribute()
    {
      return [
        'title'=>'article title',
        'content'=>'article content',
      ];
    }


}
