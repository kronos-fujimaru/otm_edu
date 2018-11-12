<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DailyReport;
use App\DailyWork;

trait DailyWorkDownloadTrait {

    public function file($id)
    {
        $user = \Auth::user();
        $dailyWork = DailyWork::findOrFail($id);
        $dailyReport = $dailyWork->dailyReport;

        # TODO https://laravel.com/docs/5.1/responses#file-downloads

        if($user->isAdmin()
        || $user->isManagerFor($dailyReport->participant_id)
        || $user->hasReport($dailyReport)) {

                $filePath = storage_path("app") . "/" . $dailyWork->file_url;
                $fileName = $dailyWork->file_name;
                $mimeType = $dailyWork->file_mime_type;

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
