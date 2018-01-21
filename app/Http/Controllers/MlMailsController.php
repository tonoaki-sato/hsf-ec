<?php

namespace App\Http\Controllers;

use App\User;
use App\MlMail;
use App\MlMailAttachment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * Show the ml_mail list.
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
     * Show the ml_mail ditail.
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
        
        // 添付ファイル取得
        // モデル
        $model = new MlMailAttachment;
        // レコード取得
        $attachments = $model->where('ml_mail_attachments.ml_mail_id', $id)->get();
        // ログインユーザー取得
        $user = Auth::user();
        //
        return view('ml_mails.show', compact('user', 'item', 'attachments'));
    }

    /**
     * DownLoad the attachment file.
     *
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        // モデル
        $model = new MlMailAttachment;
        // リクエストパラメータ取得
        $id = $request->id;
        // レコード取得
        $attachment = $model->where('ml_mail_attachments.id', $id)->first();
        //
        $path = storage_path('app/public/' . $attachment->inner_name);
        //
        $outer_name = $attachment->outer_name;
        //
        $headers = [
            'Content-Type' => $attachment->content_type
        ];
        //
        return response()->download($path, $outer_name, $headers);
    }
}
