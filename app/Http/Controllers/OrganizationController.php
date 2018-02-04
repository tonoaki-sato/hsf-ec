<?php

namespace App\Http\Controllers;

use App\User;
use App\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
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
        $model = new Organization();
        // 年数の指定がない場合
        if (empty($year) === true) {
            // 直近の年数取得
        }
        //
        $data['year'] = $year;
        // データ取得
        $organizations = $model->orderBy('id', 'ASC')->get();
        // 
        return view('organization.index', compact('user', 'organizations', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // リクエスト取得
        $input = $request->all();
        // モデル
        $model = new Organization();
        // データセット
        $model->year = (int)$input['year'];
        $model->name = preg_replace("|\s|", "", $input['name']);
        $model->description = (empty($input['description']) === false) ? $input['description'] : '';
        // 登録
        $model->save();
        // リダイレクト
        return redirect(route('organization', ['year' => $input['year']]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // モデル
        $model = new Organization();
        // レコード取得
        $data = $model->find($id);
        // ビュー
        return view('organization.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $input = $request->all();
        //
        $model = new Organization();
        //
        $model->update_collective($input);
        // 
        return redirect(route('organization.edit', ['id' => $input['Organization']['id']]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // モデル
        $model = new Organization();
        // 対象レコード
        $rec = $model->find($id)->toArray();
        // 削除
        $model->destroy($id);
        // リダイレクト
        return redirect(route('organization', ['year' => $rec['year']]));
    }
}
