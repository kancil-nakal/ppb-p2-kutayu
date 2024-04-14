<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function template_pbb(){
        $file_path = public_path('excel/template-import-pbb.xlsx');

        return response()->download($file_path, 'template-import-pbb.xlsx');
    }
    public function template_master(){
         $file_path = public_path('excel/template-import-master.xlsx');

        return response()->download($file_path, 'template-import-master.xlsx');
    }
}
