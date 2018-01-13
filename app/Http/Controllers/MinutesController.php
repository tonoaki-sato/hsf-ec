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
        // 議事録取得
        $minute = new Minute;
        $minutes = $minute->all();
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
    public function show()
    {
        // ログインユーザー取得
        $user = Auth::user();
        //
        return view('minutes.show', compact('user'));
    }

    /**
     * Show the minutes edit form.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // ログインユーザー取得
        $user = Auth::user();
        //
        return view('minutes.edit', compact('user'));
    }
}
