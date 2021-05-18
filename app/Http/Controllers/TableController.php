<?php

namespace App\Http\Controllers;

use App\Link;
use App\Link_platform;
use App\List_platform;
use App\List_text;
use App\Notification;
use App\Visit;

use App\User;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Dotenv\Result\Result;
use Illuminate\Http\Request;
// use App\DynamicField;
// use JD\Cloudder\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Catch_;
use PhpParser\Node\Stmt\TryCatch;
use Validator;

class TableController extends Controller
{
    
    function getAllLinks(Request $request)
    {
        $data = $request->all();
        $id_user = $request->session()->get('id');
        $data['id_user'] = $id_user;

        if ($request->ajax()) {
            // $data = Link::where('id_user', $data['id_user'])->get();
           
            $data = DB::table('links')
             ->select(DB::raw('*, (SELECT count(*) FROM `visits` WHERE `visits`.`link_id` = `links`.`id`) AS `count`'))
             ->where('id_user', '=', $id_user) 
            //  ->where('show_status', '=', 1) //ini lama, ketika menggunakan show_status untuk menandakan bahwa ia telah dihapus 
             ->whereNull('deletedAt')
            //  ->orderBy('createdAt', 'desc')
            ;

            // dd($data->get()->toArray());
            return Datatables::of($data)
                    ->addIndexColumn()
                    
                    ->editColumn('createdAt', function ($dt) {
                            return [
                                'display' => 
                                //  $dt->createdAt,
                                e(Date('Y-m-d', strtotime( $dt->createdAt))),
                                // 'timestamp' => Date('Y-m-d h:m:s', strtotime$dt->createdAt))
                                'timestamp' => $dt->id
                            ];
                        })
                        // ->filterColumn('createdAt', function ($query, $keyword) {

                        //     $query->whereRaw("DATE_FORMAT(createdAt,'%Y-%m-%d') LIKE ?", ["%$keyword%"]);
     
                        //  })
                        
                        ->addColumn('video_embed_url', function($row){
                            $video_embed_url='';


                            $yt_url = str_replace("embed/", "watch?v=", $row->video_embed_url);    
                            //cek apakah link valid, jika tidak valid maka akan dianggap route oleh laravel
                            if (substr($yt_url, 0, 4) == 'http'){
                                $video_embed_url = "<a href='$yt_url'" . ' target="_blank" >' ."$yt_url" .'</a> ' ;
                            }
                            else {
                                $video_embed_url = "<a href='//$yt_url'" . ' target="_blank" >' ."$yt_url" .'</a> ' ;
                            }
                            return $video_embed_url;
                     })
                        ->addColumn('action', function($row){
                           $btn = '
                           <div class="btn-group" role="group" aria-label="Basic example">
                           <button id="deleteBtn" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> <i class="fas fa-trash-alt"></i> </button>'
                           .'<div class="dropdown">
                           <button  class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="far fa-edit"></i> </button>    
                           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                             <a class="dropdown-item" id="editBtn" name="set-privilige" data-privilige="user" ><i class="far fa-edit"></i>Link</a>
                             <a class="dropdown-item" id="customBtn" name="set-privilige" data-privilige="admin"><i class="far fa-edit"></i>Custom Link </a>
                           </div>
                         </div>'
                           . "<a href='/m/$row->short_link'" . ' target="_blank" class="btn btn-success "><i class="fas fa-eye"></i> </a> ' 
                           . "<a href='/detail/$row->short_link'" . ' target="_blank" class="btn btn-secondary"><i class="fas fa-info"></i></a>'
                           . "<button id='shareBtn' data-url='" .config('constants.site_title')."/m/$row->short_link" ."' class='btn btn-default'><i class='fas fa-copy'></i> </button>
                           </div>"
                           ;
                           return $btn;
                    })
                    ->addColumn('status', function($row){
                        $btn = '';
                        if($row->show_status == 1){
                            $btn= 'normal';
                        }
                        else if ($row->show_status == 2){
                            $btn = "dibanned";
                        }
                        return $btn;
                 })
                //  ->order(function ($query) {
                //     if (request()->has('create_at')) {
                //         dd('asdasd');
                //         $query->orderBy('createdAt', 'desc');
                //     } 
                //     // else {
                //     //     dd(request());
                //     //     $query->orderBy('createdAt', 'desc');
                //     // } 
                // })
                    ->rawColumns(['action', 'video_embed_url'])
                    
                    ->make(true);
        }
    }

    function getAllNotifications(Request $request)
    {
        $data = $request->all();
        $id_user = $request->session()->get('id');
        $data['id_user'] = $id_user;
        // dd();
        if ($request->ajax()) {
            $data = DB::table('notifications')
            ->select()
            ->where('notifiable_id', $id_user) 
            ->get();
            $updateResult = DB::table('notifications')
             ->select()
             ->where('notifiable_id', $id_user)
             ->where('read_at', null) 
            ->update(['read_at' => date("Y-m-d H:i:s")]);
            return Datatables::of($data)->make(true);
        }
    }

    function getAllLinksById(Request $request)
    {
        $data = $request->all();

        $id_user = $request->session()->get('id');
        $data['id_user'] = $id_user;
        try {
            $result = Link::where('id_user', $data['id_user'])->get();
            // $result = DB::table('list_platforms')->get();
            return response()->json(['data'=> $result]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    

    function patchCustomLink(Request $request)
    {

        $data = $request->all();
        $result = Link::withTrashed()->where('id', $data['id'])->first();
        $alreadyExist = Link::withTrashed()->where('short_link', $data['short_link'])->first();


        if($result && ($result->short_link ==  $data['short_link'])){
            return response()->json([
                'error'  => 'Harap masukkan short link yang baru'
            ], 400);
        }

        if($alreadyExist){
            return response()->json([
                'error'  => 'Short Link sudah terpakai'
            ], 400);
        }

        if($result->id_user != session()->get('id')){
            return response()->json([
                'error'  => 'Unauthorized Action'
            ], 401);
        }
        
        if(strlen($data['short_link']) != 8){
            return response()->json([
                'error'  => 'Short Link harus berjumlah 8 karakter'
            ], 400);
        }

        if(preg_match('/\s/', $data['short_link'])){
            return response()->json([
                'error'  => 'Short Link tidak boleh mengandung spasi'
            ], 400);
        }
      
        try {
            // $result = Link::where('id', $data['id'])
            $result->update(['short_link' => $data['short_link']]);
            return response()->json($result);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getLinksById(Request $request)
    {
        $data = $request->all();
        try {
            $link = Link::where('id', $data['id'])->first()->toArray();
            $link_platform = Link_platform::where('id_link', $data['id'])->get(['id', 'jenis_platform', 'url_platform', 'text']);
            $platforms = List_platform::get(['id','platform_name','logo_image_path','platform_regex', 'published'])->toArray();
            $text = List_text::get(['id','text'])->toArray();
            return view('components/user/partials/modal-edit')->with(["link"=>$link, "result" => $link_platform, "platforms" => $platforms , "texts" => $text ]); //ini untuk dynamic modal   
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function dummy(Request $request)
    {
        $data = $request->all();
        try {
            $result = Link_platform::where('id_link', $data['id'])->get(['id', 'jenis_platform', 'url_platform', 'text']);
            return view('components/user/partials/modal-add', compact("result")); //ini untuk dynamic modal   
            // return response()->json($result); //ini untuk static modal
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
