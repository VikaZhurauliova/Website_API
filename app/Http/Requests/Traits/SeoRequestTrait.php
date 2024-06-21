<?php

namespace App\Http\Requests\Traits;

trait SeoRequestTrait
{
    protected function addSeoFields(): void
    {
        $seo = $this->seo;
        $seo['url'] = $this->seo_url ?? '/';
        $seo['title'] = $this->seo_title;
        $seo['keywords'] = $this->seo_keywords;
        $seo['description'] = $this->seo_description;
        if (isset($this->isPublished)) $seo['status'] = $this->isPublished ? 1 : null;
        if (!isset($this->seo['id'])) $seo['id'] = null;
        $this->merge([
            'seo' => $seo
        ]);
    }

    protected function addSeoRules(): array
    {
        return [
            'seo' => 'required|array',
            'seo.id' => 'nullable|integer',
            'seo.url' => 'required|string|max:255|unique:seo,url,' . $this->seo['id'] . ',id',
            'seo.title' => 'nullable|string|max:255',
            'seo.keywords' => 'nullable|string|max:255',
            'seo.description' => 'nullable|string|max:255',
            'seo.canonical' => 'nullable|string|max:255',
            'seo.status' => 'sometimes|nullable|integer|in:1',
        ];
    }
}
