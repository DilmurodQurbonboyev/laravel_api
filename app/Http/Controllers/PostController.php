<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $lang = request('lang');
        $perPage = request('perPage');

        $posts = Post::query()
            ->with('translations', function ($query) use ($lang) {
                $query->where('locale', $lang);
            })->paginate($perPage);
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $post = [
            'oz' => [
                'title' => $request->title_oz,
            ],
            'uz' => [
                'title' => $request->title_uz,
            ],
            'ru' => [
                'title' => $request->title_ru,
            ],
            'en' => [
                'title' => $request->title_en,
            ],
            'status' => $request->status,
        ];

        Post::create($post);


        return $post;
    }

    public function show($id)
    {
        $lang = request('lang');
        return Post::find($id)->translate($lang);
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
        return Post::destroy($id);
    }
}
