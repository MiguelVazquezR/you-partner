<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCollaborationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'price' => 'required|numeric|min:50',
            'promise_date' => 'required|date|after:yesterday',
            'homework_id' => 'required|numeric|min:1',
            // 'user_id' => CollaborationObserver,
            // 'tax' => CollaborationObserver,
        ];
    }
}
