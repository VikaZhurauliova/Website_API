<?php

namespace App\Http\Requests\Admin\Banner;

use Illuminate\Foundation\Http\FormRequest;

class BannerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'date_start' => formatDateFromCalendar($this->dateStart),
            'date_end' => formatDateFromCalendar($this->dateEnd),
            'status' => !empty($this->status) ? 1 : null,
            'is_active' => !empty($this->isActive) ? 1 : null,
            'image_preview' => $this->imagePreview
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'html' => 'nullable|string',
            'delay' => 'nullable|integer',
            'date_start' => 'nullable|date',
            'date_end' => 'nullable|date',
            'status' => 'nullable|in:1',
            'is_active' => 'nullable|in:1',
            'image_preview' => 'nullable|string',
        ];
    }
}
