<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrgchartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('orgchart.index');
    }

    /**
     * Get the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        // create an array with nodes
        $nodes = [
            ['id' => 1, 'label' => 'Node 1', 'x' => 0, 'y' => 0],
            ['id' => 2, 'label' => 'Node 2'],
            ['id' => 3, 'label' => 'Node 3'],
            ['id' => 4, 'label' => 'Node 4'],
            ['id' => 5, 'label' => 'Node 5']
        ];
        
        // create an array with edges
        $edges = [
            ['from' => 1, 'to' => 3],
            ['from' => 1, 'to' => 2],
            ['from' => 2, 'to' => 4],
            ['from' => 2, 'to' => 5],
            ['from' => 3, 'to' => 3]
        ];
        
        //
        $data = [
            'nodes' => $nodes, 'edges' => $edges
        ];
        //
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
