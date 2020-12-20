<?php

namespace App\Http\Controllers;

use App\Link;
use App\Link_platform;
use App\List_platform;
use App\User;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Dotenv\Result\Result;
// use App\DynamicField;
// use JD\Cloudder\Facades\Cloudinary;
use PhpParser\Node\Stmt\Catch_;
use PhpParser\Node\Stmt\TryCatch;
use Validator;

class AdminController extends Controller
{
    public function getAllLinks()
    {
        // try {
        //     $result = Link::all();
        //     return response()->json(['data' => $result]);
        // } catch (\Throwable $th) {
        //     throw $th;
        // }


            $data = Link::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<button id="deletetBtn" class="btn btn-danger" >Hapus</button> '
                           ."<a href='/preview/$row->short_link'" .' class="btn btn-info ">Lihat</a>';
                        //    <button id="viewBtn">Detail</button>
                           return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        
    }

    public function getAllUsers()
    {
        // try {
        //     $result = User::all();
        //     return response()->json(['data' => $result]);
        // } catch (\Throwable $th) {
        //     throw $th;
        // }
        $result = User::all();
        return Datatables::of($result)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<button id="resetBtn" class="btn btn-secondary">Reset Password</button>
                           <button id="deactivateBtn" class="btn btn-danger">Hapus User</button>
                           <button id="viewBtn" class="btn btn-info">Lihat</button>
                           ';
                        //    <button id="viewBtn">Detail</button>
                           return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    public function getAllPlatforms()
    {
        // try {
        //     $result = List_platform::all();
        //     return response()->json(['data' => $result]);
        // } catch (\Throwable $th) {
        //     throw $th;
        // }
        $result = List_platform::all();
        return Datatables::of($result)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<button id="deleteLogoBtn" class="btn btn-danger">Hapus Logo</button>
                           ';
                           return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    function addPlatform(Request $request)
    {
        // echo request()->headers->get("X-Requested-With");
        // if ($request->ajax()) {
        if ('XMLHttpRequest' == request()->headers->get("X-Requested-With")) {
            $data = $request->all();
            $request->validate(['image' => 'required|image|mimes:svg,jpg,JPG|max:1024',]);
            if (!$request->hasFile('image')) {
                return response()->json([
                    `'failed'  => 'you have to choose a logo to be uploaded'`
                ]);
            }

            //BAGIAN upload to cloud
            $uploadedFileUrl = \Cloudinary::upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'assets/logo',
                ]
            );
            $namaImage =  $uploadedFileUrl->getPublicId();
            // $namaImage = 'assets/logo/fqmkqcwgsoldqfkarjta';

            //BAGIAN CREATE DATA 
            $list_platform = new List_platform();
            $list_platform->platform_name = $data['platform_name'];
            $list_platform->logo_image_path = $namaImage;
            $list_platform->platform_regex = $data['platform_url'];
            $list_platform->createdAt = date("Y-m-d");
            $list_platform->updatedAt = date("Y-m-d");
            $list_platform->save();
        }
        // dd($data_platform, $data_url_platform, $data_text); //debug all data
        // return Response()->json(array('success'=>true,'result'=>$uploadedFileUrl->getPublicId()));        
        return response()->json([
            `'success'  => 'action success'`
        ]);
    }

    function deletePlatform(Request $request)
    {

        $data = $request->all();
        $logo_image_path = List_platform::where('id', $data['id'])->first()->logo_image_path;

        //delete record di db
        $link = List_platform::find($data['id']);
        $link->delete();

        //delete file di server
        $deleteResult = \Cloudinary::destroy($logo_image_path);
        return response()->json(['success' => 'Data is deleted'], 200);
    }

    //ini fungsi dummy, hanya untuk percobaan
    function datatables(Request $request){
        // dd("asd");
        if ($request->ajax()) {
            $data = Link::select('*');

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<button id="deletetBtn">Hapus</button>
                           <button id="viewBtn">Detail</button>';
                           return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    function deleteLink(Request $request){
            $data = $request->all();
            $link = Link::find($data['id']);
            $link->delete();
            return response()->json(['success' => 'Data is deleted'], 200);
    }

    function deleteUser(Request $request){
        $data = $request->all();
        $user = User::find($data['id']);
        $user->delete();
        return response()->json(['success' => 'Data is deleted'], 200);
}
}
