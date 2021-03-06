<?php

namespace App\Console\Commands;

use App\MlMail;
use App\MlMailAttachment;
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
        $model->ml_name = $this->_get_ml_name($structure->headers["subject"]);
        $model->h_message_id = $structure->headers["message-id"];
        $model->h_date = date("Y-m-d H:i:s", strtotime($structure->headers["date"]));
        $model->h_from = mb_decode_mimeheader($structure->headers["from"]);
        $model->h_subject = mb_decode_mimeheader($structure->headers["subject"]);
        // コンテンツタイプ取得
        $ctype = strtolower($structure->ctype_primary);
        // 添付なしのメールの場合
        if ($ctype === 'text') {
            // 本文データセット
            $model->contents = $structure->body;
            // 登録
            $model->save();
        }
        // 添付ありのメールの場合
        else {
            // 複数の添付ファイルを想定
            foreach ($structure->parts as $i => $part) {
                // メール本文
                if (isset($part->ctype_parameters['charset']) === true) {
                    $model->contents = $part->body;
                    break;
                }
            }
            // 登録
            $model->save();
            // ID取得
            $ml_mail_id = $model->id;
            // 複数の添付ファイルの情報を登録する
            foreach ($structure->parts as $i => $part) {
                // メール本文は飛ばす
                if (isset($part->ctype_parameters['name']) === false) {
                    continue;
                }
                // 添付ファイル（pdf, MS-excel, MS-word, 画像など）
                $outer_name = $part->ctype_parameters['name'];
                $outer_name = mb_decode_mimeheader($outer_name);
                $inner_name = date("YmdHis") . '_' . str_random(40);
                $body = $part->body;
                $body = base64_decode($body);
                //
                $string = $part->headers['content-type'];
                $length = strpos($string, ';');
                $content_type = substr($string, 0, $length);
                // データセット
                $model = new MlMailAttachment;
                $model->ml_mail_id = $ml_mail_id;
                $model->inner_name = $inner_name;
                $model->outer_name = $outer_name;
                $model->content_type = $content_type;
                // 登録
                $model->save();
                // ファイルを書き込む
                $fh = fopen(storage_path('app/public/' . $inner_name), 'w');
                fwrite($fh, $body);
                fclose($fh);
            }
        }
    }
    /**
     * Make the mailing-list name.
     *
     * @return string
     */
    private function _get_ml_name($subject)
    {
        //
        $res = 'unknown';
        //
        if (preg_match("!^\[(.+):[0-9]+\]!", $subject, $mch) === 1) {
            $res = $mch[1];
        }
        //
        return $res;
    }
}
