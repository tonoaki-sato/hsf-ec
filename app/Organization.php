<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    //
    public function update_collective($params) {
        // モデル取得
        $obj = $this->find($params['Organization']['id']);
        // 組織管理のデータセット
        $obj->description = $params['Organization']['description'];
        // 更新
        $obj->save();
        // 返却
        return;
    }
    
}
