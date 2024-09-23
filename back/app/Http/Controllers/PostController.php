<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\ImageUploader;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(private ImageUploader $imageUploader)
    {
    }

    public function index()
    {
        $items = Post::all();

        return response()->json([
            'status' => true,
            'posts' => PostResource::collection($items)
        ]);
    }

    public function show($id)
    {
        $item = Post::findOrFail($id);

        return response()->json([
            'status' => true,
            'post' => PostResource::make($item)
        ]);
    }

    public function store(Request $request)
    {
        if ($request->file('files') !== null) {
            $files = $request->file('files');

            if ($files && count($files) > 0) {
                $status = $this->imageUploader->upload($files);

                return response()->json([
                    'status' => $status,
                    'message' => $status ? 'Успешно' : 'Ошибка'
                ], $status ? 201 : 500);
            }

        }

        return response()->json([
            'status' => false,
        ], 422);
    }
}
