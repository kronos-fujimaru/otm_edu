<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Topic;

trait TopicFileDownloadTrait {

    public function file($id)
    {
        $user = \Auth::user();
        $topic = Topic::findOrFail($id);
        if ($topic->fromCompany->id == $user->company->id
            || $topic->toCompany->id == $user->company->id ) {

                // http://ameblo.jp/itboy/entry-12040013001.html
                $filePath = storage_path("app") . "/" . $topic->file_path;
                $fileName = $topic->file_name;
                $mimeType = $topic->file_mime_type;

                header("Content-Length: " . filesize($filePath));
                header("Content-Disposition: attachment; filename=\"{$fileName}\"");
                header("Accept-Ranges: bytes");
                header("Content-type: {$mimeType}");

                // 実ファイル呼び出し
                $handle = fopen($filePath, 'rb');
                while (!feof($handle)){
                    echo fread($handle, 4096);
                    ob_flush();
                    flush();
                }
                fclose($handle);
        }else{
            abort(403);
        }
    }

}
