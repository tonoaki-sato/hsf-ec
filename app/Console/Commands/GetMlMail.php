<?php

namespace App\Console\Commands;

use App\MlMail;
use Illuminate\Console\Command;

class GetMlMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getmlmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get mailing list mail and insert table.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 標準入力取得
        $contents = file_get_contents('php://stdin');
        // 改行コードを統一する
        $contents = str_replace("\r\n", "\n", $contents);
        $contents = str_replace("\r", "\n", $contents);
        // 文字コード判定
        $to_encoding = 'UTF-8';
        $from_encoding = mb_detect_encoding($contents, ["ASCII", "JIS", "UTF-8"]);
        // 文字コード変換
        if ($to_encoding !== $from_encoding) {
            $contents = mb_convert_encoding($contents, $to_encoding, $from_encoding);
        }
        // ライブラリ
        $mail = new \Mail_mimeDecode($contents, "\n");
        $structure = $mail->decode([
            'include_bodies' => true,
        ]);
        // テーブル登録
        // モデル
        $model = new MlMail;
        // データセット
        $model->h_message_id = $structure->headers["message-id"];
        $model->h_date = date("Y-m-d H:i:s", strtotime($structure->headers["date"]));
        $model->h_from = mb_decode_mimeheader($structure->headers["from"]);
        $model->h_subject = mb_decode_mimeheader($structure->headers["subject"]);
        $model->row_data = $contents;
        $model->contents = $structure->body;
        // 登録
        $model->save();
    }
}
