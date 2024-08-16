<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightRequest extends FormRequest
{

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
            'origin' => 'required|string|max:60',
            'destination' => 'required|string|max:60',
            'flight_date' => 'required|date|after_or_equal:today',
            'departure_time' => 'required|date_format:H:i:s',
            'arrival_time' => 'required|date_format:H:i:s',
            'company_name' => 'required|string|max:30',
            'price_usd' => 'required|numeric|min:0',
            'gate' => 'required|string|max:1',
            'is_active' => 'required|boolean',
        ];
    }
}



