<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AuditResource;
use App\Models\Audit;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AuditsController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $audits = Audit::all();
        return AuditResource::collection($audits);
    }

    public function show(Audit $audit): AuditResource
    {
        return AuditResource::make($audit);
    }
}
