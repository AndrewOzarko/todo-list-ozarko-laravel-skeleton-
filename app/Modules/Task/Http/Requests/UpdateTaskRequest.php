<?php

namespace App\Modules\Task\Http\Requests;

use App\Ship\Parents\Request;

class UpdateTaskRequest extends Request
{
    protected $urlParameters = [];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer|exists:tasks,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'category_id' => 'required|integer|exists:categories,id'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}