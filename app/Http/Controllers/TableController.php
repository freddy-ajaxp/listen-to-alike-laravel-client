<?php

namespace App\Http\Controllers;

use App\Link;
use App\Link_platform;
use App\List_platform;
use App\List_text;
use App\Visit;

use App\User;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Dotenv\Result\Result;
use Illuminate\Http\Request;
// use App\DynamicField;
// use JD\Cloudder\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;
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
             ->get();

            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<button id="editBtn" class="btn btn-primary">Edit</button> 
                           <button id="deleteBtn" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Delete</button>
                           <button id="customBtn" class="btn btn-info">Customize</button> '
                           . "<a href='/preview/$row->short_link'" . ' target="_blank" class="btn btn-success ">Lihat</a> ' 
                           . "<a href='/detail/$row->short_link'" . ' target="_blank" class="btn btn-default ">Detail</a>';
                        //    <button id="viewBtn" class="btn btn-success">Visit</button>
                           return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
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
        $result = Link::where('short_link', $data['short_link'])->first();
        
        if($result){
            return response()->json([
                'failed'  => 'Short Link sudah terpakai'
            ], 400);
        }
        if(strlen($data['short_link']) != 8){
            return response()->json([
                'failed'  => 'Short Link harus berjumlah 8 karakter'
            ], 400);
        }

        if(preg_match('/\s/', $data['short_link'])){
            return response()->json([
                'failed'  => 'Short Link tidak boleh mengandung spasi'
            ], 400);
        }
      
        try {
            $result = Link::where('id', $data['id'])
            ->update(['short_link' => $data['short_link']]);
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

            print($link_platform);
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
