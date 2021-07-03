<?php

namespace Modules\Iblog\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;
use Modules\Ihelpers\Rules\UniqueSlugRule;
class CreateCategoryRequest extends BaseFormRequest
{
    public function rules()
    {
        return [];
    }

    public function translationRules()
    {
        return [
            'title' => 'required|min:2',
          'slug' => ["required",new UniqueSlugRule("iblog__category_translations"),"min:2"],
          'description' => 'min:2',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [
            'title.required' => trans('iblog::common.messages.title is required'),
            'title.min:2'=> trans('iblog::common.messages.title min 2 '),
          // slug
          'slug.required' => trans('iblog::common.messages.field required'),
          'slug.min:2' => trans('iblog::common.messages.min 2 characters'),
  
          // description
          'description.required' => trans('iblog::common.messages.field required'),
          'description.min:2' => trans('iblog::common.messages.min 2 characters'),
        ];
    }

}