<?php

namespace App\Http\Requests\Admin\News;

use App\Http\Requests\Traits\SeoRequestTrait;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class NewsRequest extends FormRequest
{
    use SeoRequestTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->addSeoFields();
    }

    /**
     * @return array{title: string, teaser: string, body: string, status: string, sticky: string, type: string}
     */
    #[ArrayShape(['title' => "string", 'teaser' => "string", 'body' => "string", 'status' => "string", 'sticky' => "string", 'type' => "string"])]
    public function rules(): array
    {
        return array_merge($this->addSeoRules(), [
            'title' => 'nullable|string|max:255',
            'teaser' => 'nullable|string|max:255',
            'body' => 'nullable|string|max:255',
            'status' => 'nullable|in:1',
            'sticky' => 'nullable|in:1',
            'type' => 'nullable|in:1,2',
            'categories' => 'array|required',
            'categories.*' => 'integer|exists:category_for_news,id',
            'image_title' => 'nullable|string',
            'image_alt' => 'nullable|string',
            'image_src' => 'nullable|string',
        ]);
    }
}
