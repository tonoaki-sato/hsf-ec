<?php

namespace App\Http\Controllers;

use App\User;
use App\Minute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MinutesController extends Controller
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
        $model = new Minute;
        // データ取得
        $minutes = $model->orderBy('id', 'DESC')->get();
        // 
        return view('minutes.index', compact('user', 'minutes'));
    }

    /**
     * Show the minutes form.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // モデル
        $model = new User();
        // ログインユーザー取得
        $user = Auth::user();
        // ユーザーリスト取得
        $users = $model->all();
        //
        return view('minutes.create', compact('user', 'users'));
    }

    /**
     * Exec the minutes insert.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // モデル
        $model = new Minute;
        // データセット
        $model->title = $request->title;
        $model->start_at = $request->start_at;
        $model->attendees = $request->attendees;
        $model->place = $request->place;
        $model->chairman = $request->chairman;
        $model->secretary = $request->secretary;
        $model->contents = $request->contents;
        // 登録
        $model->save();
        // リダイレクト
        return redirect('minutes');
    }

    /**
     * Show the minutes ditail.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // モデル
        $model = new Minute;
        // リクエストパラメータ取得
        $id = $request->id;
        // レコード取得
        $minute = $model
            ->select('minutes.id', 'title', 'start_at', 'attendees', 'place', 'chairman', 'users_chairman.name as chairman_name', 'secretary', 'users_secretary.name as secretary_name', 'contents')
            ->join('users as users_chairman', 'minutes.chairman', '=', 'users_chairman.id')
            ->join('users as users_secretary', 'minutes.secretary', '=', 'users_secretary.id')
            ->where('minutes.id', $id)->first();
        // ログインユーザー取得
        $user = Auth::user();
        //
        return view('minutes.show', compact('user', 'minute'));
    }

    /**
     * Show the minutes edit form.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        // モデル
        $model = new Minute;
        // リクエストパラメータ取得
        $id = $request->id;
        // プリセットレコード取得
        $minute = $model->where('id', $id)->first();
        
        // モデル
        $model = new User;
        // ユーザーリスト取得
        $users = $model->all();
        // ログインユーザー取得
        $user = Auth::user();
        //
        return view('minutes.edit', compact('user', 'users', 'minute'));
    }
    /**
     * Exec the minutes update.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // モデル
        $model = new Minute;
        // リクエストパラメータ取得
        $id = $request->id;
        // データセット
        $params = [
            'title' => $request->title,
            'start_at' => $request->start_at,
            'attendees' => $request->attendees,
            'place' => $request->place,
            'chairman' => $request->chairman,
            'secretary' => $request->secretary,
            'contents' => $request->contents
        ];
        // 更新
        $model->where('id', $id)->update($params);
        // リダイレクト
        return redirect('/minutes/show/' . $id);
    }

    /**
     * Delete the minutes data.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        // ログインユーザー取得
        $user = Auth::user();
        //
        return view('minutes.edit', compact('user'));
    }
}
