<?php

namespace Webkul\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Webkul\Core\Filesystem\FileStorer;

class TinyMCEController extends Controller
{
    /**
     * Storage folder path.
     *
     * @var string
     */
    private string $storagePath = 'tinymce';

    /**
     * Return controller instance.
     */
    public function __construct(protected FileStorer $fileStorer) {}

    /**
     * Upload file from TinyMCE.
     */
    public function upload(Request $request)
    {
        if (! auth('admin')->check()) {
            return response()->json([
                'error' => 'Unauthorized',
            ], 403);
        }

        try {
            $media = $this->storeMedia($request);

            if (! empty($media)) {
                return response()->json([
                    'location' => $media['file_url'], 
                ]);
            }

            return response()->json([], 400);

        } catch (\Throwable $e) {

            Log::error('TinyMCE Upload Error', [
                'message' => $e->getMessage(),
                'user_id' => auth('admin')->id(),
                'ip'      => $request->ip(),
            ]);

            return response()->json([
                'error' => 'Upload failed',
            ], 500);
        }
    }

    /**
     * Store media securely.
     */
    private function storeMedia(Request $request): array
    {
        if (! $request->hasFile('file')) {
            return [];
        }

        $request->validate([
            'file' => [
                'required',
                'image', 
                'mimes:jpg,jpeg,png,webp,gif',
                'max:5120',
            ],
        ]);

        $file = $request->file('file');

        $extension = strtolower($file->getClientOriginalExtension());

        $blockedExtensions = ['php', 'phtml', 'php5', 'phar'];

        if (in_array($extension, $blockedExtensions)) {

            Log::warning('Blocked TinyMCE upload attempt', [
                'user_id'   => auth('admin')->id(),
                'ip'        => $request->ip(),
                'extension' => $extension,
            ]);

            abort(403, 'Invalid file type');
        }

        $filename = Str::uuid() . '.' . $extension;
        $path = $file->storeAs(
            'public/' . $this->storagePath,
            $filename
        );

        return [
            'file'      => $path,
            'file_name' => $filename,
            'file_url'  => Storage::url($path),
        ];
    }
}
