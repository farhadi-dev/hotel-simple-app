<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'room_number' => [
                'required',
                'string',
                Rule::unique('rooms')->where(function ($query) {
                    return $query->where('hotel_id', $this->hotel_id);
                }),
            ],
            'room_type' => 'required|string',
            'floor_number' => [
                'required',
                'string',
            ],
            'hotel_id' => 'required|integer|exists:hotels,id',
            'reservation_status' => 'required|boolean',        ];
    }
}
