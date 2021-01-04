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
             ->where('show_status', '=', 1) 
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
            $links = Link_platform::where('id_link', $data['id'])->get(['id', 'jenis_platform', 'url_platform', 'text'])->toArray();
            $platforms = List_platform::get(['id','platform_name','logo_image_path','platform_regex', 'published'])->toArray();
            $text = List_text::get(['id','text'])->toArray();
            return view('components/user/partials/modal-edit')->with(["link"=>$link, "result" => $links, "platforms" => $platforms , "texts" => $text ]); //ini untuk dynamic modal   
            // return response()->json($result); //ini untuk static modal
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
