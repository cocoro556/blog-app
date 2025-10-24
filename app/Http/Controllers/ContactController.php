<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function create()
    {
        return view('contacts.create');
    }

    public function complete()
    {
        // セッションにsuccessフラグがない場合は問い合わせページにリダイレクト
        if (!session('contact_success')) {
            return redirect()->route('contact.create')->with('error', '不正なアクセスです。');
        }
        
        // セッションを削除（一度表示したら使えなくする）
        session()->forget('contact_success');
        
        return view('contacts.complete');
    }

    public function store(Request $request)
    {
        
        // バリデーション失敗時の日本語のメッセージ
        $messages = [
            'name.required' => '名前は必須です。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'message.required' => 'メッセージは必須です。',
        ];
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ], $messages);
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        Contact::create($data);

        // セッションに成功フラグを保存
        session(['contact_success' => true]);

        return redirect()->route('contact.complete')->with('success','お問い合わせを送信しました');
    }
}
