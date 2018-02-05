<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($year = null)
    {
        //
        $data = [];
        // ログインユーザー取得
        $user = Auth::user();
        // モデル
        $model = new User();
        // データ取得
        $data['user'] = $model->orderBy('id', 'DESC')->get();
        // 
        return view('user.index', compact('user', 'data'));
    }
}
