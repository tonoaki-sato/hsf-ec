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
        // 管理ユーザーの場合
        if ($user->role === \Config::get('const.role_of_secretary')) {
            // データ取得
            $mails = $model->orderBy('id', 'DESC')->get();
        }
        // その他のユーザーの場合
        else {
            // 閲覧禁止メーリングリストを設定
            $not_in_ml = \Config::get('const.ml_secretary');
            // データ取得
            $mails = $model->whereNotIn('ml_mails.ml_name', $not_in_ml)
                ->orderBy('id', 'DESC')
                ->get();
        }
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
        // ログインユーザー取得
        $user = Auth::user();

        // モデル
        $model = new MlMail;
        // リクエストパラメータ取得
        $id = $request->id;
        // レコード取得
        $item = $model->where('ml_mails.id', $id)->first();

        /*
         * 添付ファイル取得
         */
        // モデル
        $model = new MlMailAttachment;
        // レコード取得
        $attachments = $model->where('ml_mail_attachments.ml_mail_id', $id)->get();

        /*
         * 閲覧許可の確認
         */
        // 閲覧禁止メーリングリストを設定
        $not_in_ml = \Config::get('const.ml_secretary');

        // 管理ユーザーの場合
        if ($user->role === \Config::get('const.role_of_secretary')) {
            return view('ml_mails.show', compact('user', 'item', 'attachments'));
        }
        // その他のユーザーで対象メールのメーリングリスト名が閲覧禁止リストにない場合
        elseif (in_array($item->ml_name, $not_in_ml) === false) {
            return view('ml_mails.show', compact('user', 'item', 'attachments'));
        }
        // 不正な閲覧
        throw new Exception('error');
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
