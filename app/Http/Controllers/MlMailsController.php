<?php

namespace App\Http\Controllers;

use App\User;
use App\MlMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MlMailsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the minutes list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ログインユーザー取得
        $user = Auth::user();
        // モデル
        $model = new MlMail;
        // データ取得
        $mails = $model->orderBy('id', 'DESC')->get();
        // 
        return view('ml_mails.index', compact('user', 'mails'));
    }

    /**
     * Show the minutes ditail.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // モデル
        $model = new MlMail;
        // リクエストパラメータ取得
        $id = $request->id;
        // レコード取得
        $item = $model->where('ml_mails.id', $id)->first();
        // ログインユーザー取得
        $user = Auth::user();
        //
        return view('ml_mails.show', compact('user', 'item'));
    }
}
