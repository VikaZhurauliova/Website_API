<?php

namespace App\Services\Shop\PageData;

use App\Models\Domain;

interface Builder
{
    public function setPageType(string $urn, mixed $data, array &$return): void;
    public function addSeo(string $urn, mixed $data, array &$return, Domain $domain): void;
    public function addBreadCrumbs(string $urn, mixed $data, array &$return, string $lang, Domain $domain): void;
    public function addPageData(string $urn, mixed $data, array &$return, Domain $domain): void;
    public function addAdminLink(mixed $data, array &$return, Domain $domain): void;

    public static function setAllPageData(string $urn, mixed $data, array &$return, Domain $domain, string $lang): void;
}
