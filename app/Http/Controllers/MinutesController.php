<?php

namespace App\Http\Controllers;

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
        //
        return view('minutes.index', compact('user'));
    }

    /**
     * Show the minutes form.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        // ログインユーザー取得
        $user = Auth::user();
        //
        return view('minutes.add', compact('user'));
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
