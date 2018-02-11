<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiScheduleController extends Controller
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = [
            'group' => $this->_get_group(),
            'item' => $this->_get_item(),
            'option' => $this->_get_option()
        ];
        //
        return response()->json($data);
    }
    /*
     *
     */
    private function _get_group() {
        //
        $res = [];
        // create a data set with groups
        $res = [
            [
                'id' => 0,
                'content' => '幹事会'
            ],
            [
                'id' => 1,
                'content' => '総会'
            ],
        ];
        // 返却
        return $res;
    }
    /*
     *
     */
    private function _get_item() {
        //
        $res = [];
        //
        $res = [
            [
                'id' => 1,
                'group' => 0,
                'content' => '打ち合わせ <span style="color:#97B0F8;">(hoge)</span>',
                'start' => date('2018-02-15 20:00'),
            ],
            [
                'id' => 2,
                'group' => 1,
                'content' => '打ち合わせ <span style="color:#97B0F8;">(hoge2)</span>',
                'start' => date('2018-02-17 20:00'),
            ],
        ];
        // 返却
        return $res;
    }
    /*
     *
     */
    private function _get_option() {
        //
        $res = [];
        //
        $res = [
            'groupOrder' => 'content',
            'min' => date("Y-m-d", strtotime("-2 week")),
            'max' => date("Y-m-d", strtotime("+1 year")),
            'zoomMin' => 1000 * 60 * 60 * 24 * 30,
            'zoomMax' => 1000 * 60 * 60 * 24 * 30,
        ];
        // 返却
        return $res;
    }
    
}
