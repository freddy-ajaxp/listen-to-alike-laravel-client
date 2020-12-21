<?php

namespace App\Http\Controllers;

use App\Link;
use App\Link_platform;
use App\List_platform;
use App\User;
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

class ListPlatformController extends Controller
{


    function insert(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            //validasi
            //BAGIAN insert link_platforms
            $data_platform = explode(", ", $data['data_platform']);
            $data_url_platform = explode(", ", $data['data_url_platform']);
            $data_text = explode(", ", $data['data_text']);

            //kalau data platform ==0, return error, karena minimal 1
            if ($data['data_platform'] === null) {
                return response()->json([
                    'failed'  => 'Harap isi minimal 1 platform'
                ], 400);
            }

            // if array has different length, meaning some field at some [index] of array is null
            // this a little prevention from user bypassing front end validation 
            if ((count($data_platform) !== count($data_url_platform)) || (count($data_url_platform) !== count($data_text))) {
                return response()->json([
                    'failed'  => 'Data is incorrect, please complete all data including "Platform", "URL" and "Button Text"'
                ], 400);
            }

            //create object dulu 
            $link = new Link;

            //BAGIAN upload to cloud
            if($request->file('image')){
                $uploadedFileUrl = \Cloudinary::upload($request->file('image')->getRealPath());
                $idImage =  $uploadedFileUrl->getPublicId();
                $link->image_path = $idImage;
            }
            else{
                $link->image_path = null;
            }
            

            //BAGIAN CREATE DATA LINK
            $link->id_user = $request->session()->get('id');
            $link->short_link = $this->generateId(Str::random(9));
            $video_embed_url = str_replace("watch?v=", "embed/", $data['video_embed_url']);
            $link->video_embed_url = $video_embed_url;
            $link->title = $data['link_title'];
            $link->createdAt = date("Y-m-d");
            $link->updatedAt = date("Y-m-d");
            $link->save();



            $temp = array();
            //insert loop
            for ($i = 0; $i < count($data_url_platform); $i++) {
                $link_platform = new Link_platform;
                $link_platform->url_platform = $data_url_platform[$i];
                $link_platform->jenis_platform = $data_platform[$i];
                $link_platform->text = $data_text[$i];
                $link_platform->id_link = $link->id;
                $link_platform->createdAt = date("Y-m-d");
                $link_platform->updatedAt = date("Y-m-d");
                $link_platform->save();
                $temp[$i] = $link_platform->id;
            }
        }
        $dataReturn = array(
            'link' => $link->short_link,
            'slug' => $link->video_embed_url,
            'title' => $link->title
        );
        // dd($data_platform, $data_url_platform, $data_text); //debug all data
        // return Response()->json(array('success'=>true,'result'=>$uploadedFileUrl->getPublicId()));        
        return Response()->json(array('success' => true, 'result' => $dataReturn));
    }

    function upsert(Request $request)
    {
        
        if ($request->ajax()) {
            $data = $request->all();
           
            //create object dulu 
            $link = new Link;

            //BAGIAN upload to cloud
            if($request->file('image')){
                $uploadedFileUrl = \Cloudinary::upload($request->file('image')->getRealPath());
                $idImage =  $uploadedFileUrl->getPublicId();
                $link->image_path = $idImage;
            }

            //BAGIAN UPDATE DATA LINK
            //trial
            $link = Link::find($data['id']);
            $link->video_embed_url = $data['video_embed_url'];
            $link->title = $data['link_title'];
            $link->save();

            //BAGIAN update link_platforms
            $id_platforms = explode(", ", $data['id_platforms']);
            $data_platform = explode(", ", $data['data_platform']);
            $data_url_platform = explode(", ", $data['data_url_platform']);
            $data_text = explode(", ", $data['data_text']);

            // if array has different length, meaning some field at some [index] of array is null
            // this a little prevention from user bypassing front end validation 
            if ((count($data_platform) !== count($data_url_platform)) || (count($data_url_platform) !== count($data_text))) {
                return response()->json(['error' => 'Form is not complete'], 400);
            }

            $dataPlatforms = array();
            for ($i = 0; $i < count($data_platform); $i++) {
                $dataPlatforms[$i]['id'] = $id_platforms[$i];
                $dataPlatforms[$i]['jenis_platform'] = $data_platform[$i];
                $dataPlatforms[$i]['url_platform'] = $data_url_platform[$i];
                $dataPlatforms[$i]['text'] = $data_text[$i];
            }

            //upsert, only for laravel 8
            // $resultLP= Link_platform::upsert($dataPlatforms, ['id'], ['jenis_platform','url_platform','text']);

            for ($i = 0; $i < count($dataPlatforms); $i++) {
                $link_platform = new Link_platform;
                if ($dataPlatforms[$i]['id']) {
                    $link_platform = link_platform::find($dataPlatforms[$i]['id']);
                }
                $link_platform->url_platform = $dataPlatforms[$i]['url_platform'];
                $link_platform->jenis_platform = $dataPlatforms[$i]['jenis_platform'];
                $link_platform->text = $dataPlatforms[$i]['text'];
                $link_platform->id_link = $data['id'];
                if (!$dataPlatforms[$i]['id']) {
                    $link_platform->createdAt = date("Y-m-d");
                }
                $link_platform->updatedAt = date("Y-m-d");
                $link_platform->save();
            }
            return response()->json(['success' => 'data is updated'], 200);
        }
    }

    function generateId($slug)
    {
        $result = Link::where('short_link', $slug)->first()['short_link'];
        if ($result === NULL) {
            return $slug;
        } else {
            $this->generateId(Str::random(9));
        }
    }


    function getAllPlatforms()
    {
        try {
            $result = List_platform::selectRaw('platform_name as text, platform_name as alt, platform_name as jenis_platform, logo_image_path as image')->get();
            return response()->json($result);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    function deleteLinkById(Request $request)
    {
        $data = $request->all();
        $link = Link::find($data['id']);
        $link->delete();
        return response()->json(['success' => 'Data is deleted'], 200);
    }

    function preview(Request $request, $short_link)
    {
        $link['link'] = Link::where('short_link', $short_link)->get()->toArray();
        $link['platforms'] = Link_platform::where('id_link', $link['link'][0]['id'])->get(['id', 'jenis_platform', 'url_platform', 'text']);
        $link['video_id'] = strrchr($link['link'][0]['video_embed_url'], 'embed/');
        $link['image_path'] = $link['link'][0]['image_path'];
        // return response()->json($link);
        // return view('layouts/preview')->with('data',$link);
        return view('components/user/view/preview')->with('data', $link);
    }

    function deleteModal(Request $request)
    {
        $data = $request->all();
        try {
            return view('components/user/partials/modal-delete'); //ini untuk dynamic modal   
            // return response()->json($result); //ini untuk static modal
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    function customModal(Request $request)
    {
        try {
            return view('components/user/partials/modal-custom'); //ini untuk dynamic modal   
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}


