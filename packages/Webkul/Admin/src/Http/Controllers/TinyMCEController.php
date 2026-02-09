<?php

namespace Webkul\Admin\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Webkul\Core\Filesystem\FileStorer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TinyMCEController extends Controller
{
    /**
     * Storage folder path.
     *
     * @var string
     */
    private $storagePath = 'tinymce';

    /**
     * Return controller instance
     */
    public function __construct(protected FileStorer $fileStorer) {}

    /**
     * Upload file from tinymce.
     *
     * @return void
     */
    public function upload()
    {

        if (! auth()->check() || ! auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized');
        }

        $media = $this->storeMedia();

        if (! empty($media)) {
            return response()->json([
                'location' => $media['file_url'],
            ]);
        }

        return response()->json([]);
    }

    /**
     * Store media.
     *
     * @return array
     */
    // public function storeMedia()
    // {
    //     if (! request()->hasFile('file')) {
    //         return [];
    //     }

    //     $path = $this->fileStorer->store(file: request()->file('file'), path: $this->storagePath);

    //     return [
    //         'file'      => $path,
    //         'file_name' => request()->file('file')->getClientOriginalName(),
    //         'file_url'  => Storage::url($path),
    //     ];
    // }


    public function storeMedia(Request $request): array
    {
        if (! $request->hasFile('file')) {
            return [];
        }

        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,webp,gif',
                'max:2048',
            ],
        ]);

        $file = $request->file('file');
        $ext  = strtolower($file->getClientOriginalExtension());

        $blocked = ['php','phtml','php5','phar'];

        if (in_array($ext, $blocked)) {
            Log::warning('Blocked TinyMCE upload attempt', [
                'user_id' => auth()->id(),
                'ip' => $request->ip(),
                'extension' => $ext,
            ]);

            abort(403, 'Invalid file type');
        }
        
        $filename = Str::uuid() . '.' . $ext;

        $path = $file->storeAs(
            'public/' . $this->storagePath,
            $filename
        );

        return [
            'file'      => $path,
            'file_name' => $filename,
            'file_url'  => asset('storage/' . $this->storagePath . '/' . $filename),
        ];
    }

}
