<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 5/26/2015
 * Time: 10:35 AM
 */

namespace App\Http\Controllers\Pdf;


use App\Http\Controllers\Controller;
use App\Models\Uploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Auth;

class DownloadFileController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     * @internal param $loanId
     */
    public function getIndex(Request $request){
        $user = Auth::user();
        $user_id = $user->id;
        $filename = $request->input('file_name');
       // $filePath = $request->input('file_path');
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $path = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.$user_id.DIRECTORY_SEPARATOR.$filename;
        //$contents = Storage::get('/' . $user_id . '/' . $filename);
      // dd($path);
        return response()->download($path, $filename ,[
            'Content-Type' => $ext,
            'Content-Disposition' => 'inline; '.$filename,
        ]);
    }
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     * @internal param $loanId
     */
    public function getFile(Request $request){
        $user = Auth::user();
        $user_id = $user->id;
        $filename = $request->input('file_name');
        dd($filename);
        // $filePath = $request->input('file_path');
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $path = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.$user_id.DIRECTORY_SEPARATOR.$filename;
         // $contents = Storage::get('/' . $user_id . '/' . $filename);
        // dd($path);
        return response()->make(file_get_contents($path), 200 ,[
            'Content-Type' => $ext,
            'Content-Disposition' => 'inline; '.$filename,
        ]);
    }

}