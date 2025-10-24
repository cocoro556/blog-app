<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 認証チェック
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // バリデーション失敗時の日本語のメッセージ
        $messages = [
            'title.required' => 'タイトルは必須です。',
            'content.required' => '内容は必須です。',
        ];
        
        // バリデーション
        $request->validate(
            [
                'title' => 'required',
                'content' => 'required',
                'image_path' => 'nullable',
            ],
            $messages,
        );

        // 画像がアップロードされていれば保存
        $imagePath = null;
        if ($request->hasFile('image_path')) {
            // storage/app/public/posts ディレクトリへ保存
            $imagePath = $request->file('image_path')->store('posts', 'public');
        }

        $data = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
            'image_path' => $imagePath,
        ];

        Post::create($data);

        return redirect()->route('posts.list')->with('success', '新規投稿を作成しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function showAdmin(Post $post)
    {
        return view('admin.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // バリデーション失敗時の日本語のメッセージ
        $messages = [
            'title.required' => 'タイトルは必須です。',
            'content.required' => '内容は必須です。',
        ];
        
        // バリデーション
        $request->validate(
            [
                'title' => 'required',
                'content' => 'required',
                'image_path' => 'nullable',
            ],
            $messages,
        );

        // 画像がアップロードされていれば保存、されていなければ既存の画像を保持
        $imagePath = $post->image_path; // 既存の画像パスを保持
        if ($request->hasFile('image_path')) {
            // 古い画像を削除（オプション）
            if ($post->image_path && \Storage::disk('public')->exists($post->image_path)) {
                \Storage::disk('public')->delete($post->image_path);
            }
            // storage/app/public/posts ディレクトリへ保存
            $imagePath = $request->file('image_path')->store('posts', 'public');
        }

        $data = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image_path' => $imagePath,
        ];

        $post->fill($data)->save();

        return redirect()->route('admin.list')->with('success', '投稿を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.list')->with('success', '投稿を削除しました');
    }

    // 投稿一覧管理者画面
    public function list()
    {
        $posts = Post::all();
        return view('admin.list', compact('posts'));
    }

    // 管理画面のダッシュボード
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
