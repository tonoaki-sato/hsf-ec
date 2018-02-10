<?php

namespace App\Http\Controllers;

use App\OrgchartNode;
use App\OrgchartEdge;
use App\OrgchartMember;
use App\Member;
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
        //
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
        $model_node = new OrgchartNode();
        // データ取得
        $nodes = $model_node
                ->select(['id', 'label', 'x', 'y'])
                ->get()
                ->toArray();
        // モデル:エッジ
        $model_edge = new OrgchartEdge();
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
        $orgchart_node = new OrgchartNode();
        // ノード削除
        $orgchart_node->destroy($request->id);
        // モデル
        $orgchart_member = new OrgchartMember();
        // ノードメンバー取得
        $members = $orgchart_member
            ->select('id')
            ->where('orgchart_node_id', $request->id)
            ->get()
            ->toArray();
        // ノードメンバーがあれば削除
        if (empty($members) === false) {
            $orgchart_member->destroy($members);
        }
        // 返却
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
        $model_node = new OrgchartNode();
        // ノードデータ取得
        $data['node'] = $model_node->where('id', $id)
                         ->first()
                         ->toArray();
        // ノードメンバー取得
        $model_orgchart_member = new OrgchartMember();
        $data['member'] = $model_orgchart_member->select(
                'orgchart_members.id as orgchart_member_id',
                'members.id',
                'members.name'
            )
            ->join('members', 'orgchart_members.member_id', '=', 'members.id')
            ->where('orgchart_members.orgchart_node_id', $id)
            ->get()
            ->toArray();
        // セレクトオプション取得
        $data['select_option'] = [];
        $model_member = new Member();
        $tmp_a = $model_member->select('id', 'name')->get()->toArray();
        $tmp_a = array_pluck($tmp_a, 'name', 'id');
        $tmp_b = array_pluck($data['member'], 'name', 'id');
        $data['select_option'] = array_diff($tmp_a, $tmp_b);
        // 返却
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_member(Request $request)
    {
        // モデル Member
        $members = new Member();
        // モデル OrgchartMember
        $orgchart_members = new OrgchartMember();
        // リクエストパラメータ取得
        $input = $request->all();
        
        // member.name 指定の場合
        if (empty($input['member']['name']) === false) {
            // Member 登録
            $members->name = $input['member']['name'];
            $members->description = '';
            $members->save();
            // MemberId セット
            $input['orgchartMember']['member_id'] = $members->id;
        }
        // OrgchartMember 登録
        $orgchart_members->member_id = $input['orgchartMember']['member_id'];
        $orgchart_members->orgchart_node_id = $input['orgchartMember']['orgchart_node_id'];
        $orgchart_members->description = '';
        $orgchart_members->save();
        
        // 登録されたメンバーのレコード取得
        $data = $members->where('id', $input['orgchartMember']['member_id'])
              ->first()
              ->toArray();
        // 返却データにOrgchartMemberIdをセット
        $data['orgchart_member_id'] = $orgchart_members->id;
        // 返却
        return response()->json($data);
    }

    /**
     * Delete the orgchart member.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete_member(Request $request)
    {
        // モデル
        $orgchart_members = new OrgchartMember();
        // 削除
        $orgchart_members->destroy($request->id);
        // 返却
        return response()->json(['result' => 'success']);
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
