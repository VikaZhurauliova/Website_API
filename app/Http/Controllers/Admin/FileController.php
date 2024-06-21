<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\File\FileUploadFromCKEditorRequest;
use App\Http\Requests\Admin\File\FileUploadRequest;
use App\Http\Resources\Admin\FileResource;
use App\Models\File;
use App\Services\File\Upload\UploadFileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return FileResource::collection(File::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FileUploadRequest $request): FileResource
    {
        $data = $request->validated();
        if (!empty($data['folder'])) {
            Storage::makeDirectory($data['folder']);
        } else {
            $data['folder'] = '';
        }
        $fileOriginalName = $data['file']->getClientOriginalName();
        $filePath = UploadFileService::uploadFile($data['file'], $data['folder']);
        $file = File::create([
            'type' => Storage::mimeType($filePath),
            'name_init' => $fileOriginalName,
            'src' => $filePath
        ]);
        return FileResource::make($file);
    }

    /**
     * Загрузка файла из CKEditor
     */
    public function storeFromCKEditor(FileUploadFromCKEditorRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['folder'] = 'ckeditor';
        Storage::makeDirectory($data['folder']);
        $fileOriginalName = $data['upload']->getClientOriginalName();
        $filePath = UploadFileService::uploadFile($data['upload'], $data['folder']);
        $file = File::create([
            'type' => Storage::mimeType($filePath),
            'name_init' => $fileOriginalName,
            'src' => $filePath
        ]);
        return response()->json(['url' => $file->url]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): FileResource
    {
        return new FileResource(File::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file): Response
    {
        try{
            $file->delete();
        } catch (\Exception $e) {
            abort(500, 'Этот файл нельзя удалить', ['message' => 'Этот файл нельзя удалить']);
        }
        return response()->noContent();
    }
}
