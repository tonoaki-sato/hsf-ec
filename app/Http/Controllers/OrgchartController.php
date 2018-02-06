<?php

namespace App\Http\Controllers;

use App\OrgchartNode;
use App\OrgchartEdge;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OrgchartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth');
        // ログインユーザー取得
        $user = Auth::user();
        return view('orgchart.index', compact('user'));
    }

    /**
     * Get the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        // モデル:ノード
        $model_node = new OrgchartNode;
        // データ取得
        $nodes = $model_node
                ->select(['id', 'label', 'x', 'y'])
                ->get()
                ->toArray();
        // モデル:エッジ
        $model_edge = new OrgchartEdge;
        // データ取得
        $edges = $model_edge
                ->select(['id', 'from', 'to'])
                ->get()
                ->toArray();
        //
        $data = [
            'nodes' => $nodes, 'edges' => $edges
        ];
        //
        return response()->json($data);
    }

    /**
     * Save the node data to data-store.
     *
     * @return \Illuminate\Http\Response
     */
    public function save_node(Request $request)
    {
        // 既存レコードのモデル取得
        $model = \App\OrgchartNode::where('id', $request->id)->first();
        // 既存レコードがない場合、空のモデルを生成
        if (empty($model) === true) {
            $model = new OrgchartNode();
        }
        // データセット
        $model->label = $request->label;
        $model->x = $request->x;
        $model->y = $request->y;
        // 保存
        $model->save();
        //
        return response()->json($model);
    }

    /**
     * Push the edge data to data-store.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_edge(Request $request)
    {
        // モデル
        $model = new OrgchartEdge;
        // データセット
        $model->from = $request->from;
        $model->to = $request->to;
        // 登録
        $model->save();
        //
        return response()->json(['result' => 'success']);
    }

    /**
     * Delete the node data from data-store.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete_node(Request $request)
    {
        // モデル
        $model = new OrgchartNode;
        // 削除
        $model->destroy($request->id);
        //
        return response()->json(['result' => 'success']);
    }

    /**
     * Delete the edge data from data-store.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete_edge(Request $request)
    {
        // モデル
        $model = new OrgchartEdge;
        // 削除
        $model->destroy($request->id);
        //
        return response()->json(['result' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_node($id)
    {
        //
        $data = [];
        // モデル
        $model_node = new OrgchartNode;
        // データ取得
        $data['node'] = $model_node->where('id', $id)
                         ->first()
                         ->toArray();
        // データ取得
        $data['member'] = '';
        // 返却
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
