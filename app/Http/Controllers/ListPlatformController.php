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

            //BAGIAN upload to cloud
            // $uploadedFileUrl = \Cloudinary::upload($request->file('image')->getRealPath());  
            // $idImage =  $uploadedFileUrl->getPublicId();

            //BAGIAN CREATE DATA LINK

            $link = new Link;
            // $student->image_path = $idImage;
            $link->id_user = $request->session()->get('id');
            $link->short_link = $this->generateId(Str::random(9));
            $link->video_embed_url = $data['video_embed_url'];
            $link->title = $data['link_title'];
            $link->createdAt = date("Y-m-d");
            $link->updatedAt = date("Y-m-d");
            $link->save();



            //BAGIAN insert link_platforms
            $data_platform = explode(", ", $data['data_platform']);
            $data_url_platform = explode(", ", $data['data_url_platform']);
            $data_text = explode(", ", $data['data_text']);

            // if array has different length, meaning some field at some [index] of array is null
            // this a little prevention from user bypassing front end validation 
            if ((count($data_platform) !== count($data_url_platform)) || (count($data_url_platform) !== count($data_text))) {
                return response()->json([
                    `'failed'  => 'Data is incorrect, please complete all data including "Platform", "URL" and "Button Text"'`
                ]);
            }

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
            // print_r($link->short_link);
            // print_r($link->video_embed_url);
            // print_r($link->title);
            
            
            // exit();
        }
        $dataReturn = array(
            'link' => $link->short_link, 
            'slug' => $link->video_embed_url,
            'title' => $link->title
         );
        // dd($data_platform, $data_url_platform, $data_text); //debug all data
        // return Response()->json(array('success'=>true,'result'=>$uploadedFileUrl->getPublicId()));        
        return Response()->json(array('success'=>true,'result'=>$dataReturn));        
    
    }

    function upsert(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            //BAGIAN upload to cloud, dikomentar supaya tidak perlu upload2
            // $uploadedFileUrl = \Cloudinary::upload($request->file('image')->getRealPath());  
            // $idImage =  $uploadedFileUrl->getPublicId();

            //BAGIAN UPDATE DATA LINK
            //trial
            $link = Link::find($data['id']);
            // $student->image_path = $idImage;
            $link->video_embed_url = $data['video_embed_url'];
            $link->title = $data['link_title'];
            $link->save();
 
            //BAGIAN update link_platforms
            $id_platforms = explode(", ", $data['id_platforms']);
            $data_platform = explode(", ", $data['data_platform']);
            $data_url_platform = explode(", ", $data['data_url_platform']);
            $data_text = explode(", ", $data['data_text']);

            // print_r($id_platforms);
            // print_r($data_platform);
            // print_r($data_url_platform);
            // print_r($data_text);

            // if array has different length, meaning some field at some [index] of array is null
            // this a little prevention from user bypassing front end validation 
            if ((count($data_platform) !== count($data_url_platform)) || (count($data_url_platform) !== count($data_text))) {
                return response()->json(['error' => 'Form is not complete'], 400);
            }

            $dataPlatforms= array();
            for($i=0; $i<count($data_platform); $i++){
                $dataPlatforms[$i]['id'] = $id_platforms[$i];
                $dataPlatforms[$i]['jenis_platform'] = $data_platform[$i];
                $dataPlatforms[$i]['url_platform'] = $data_url_platform[$i];
                $dataPlatforms[$i]['text'] = $data_text[$i];
            }

        
            //upsert, only for laravel 8
            // $resultLP= Link_platform::upsert($dataPlatforms, ['id'], ['jenis_platform','url_platform','text']);

            for ($i = 0; $i < count($dataPlatforms); $i++) {
                $link_platform = new Link_platform;
                if($dataPlatforms[$i]['id']){
                    $link_platform = link_platform::find($dataPlatforms[$i]['id']);
                }
                $link_platform->url_platform = $dataPlatforms[$i]['url_platform'];
                $link_platform->jenis_platform = $dataPlatforms[$i]['jenis_platform'];
                $link_platform->text = $dataPlatforms[$i]['text'];
                $link_platform->id_link = $data['id'];
                if(!$dataPlatforms[$i]['id']){
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
            // dd($result);
            return response()->json($result);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // function login(Request $request)
    // {
    //     $data = $request->all();


    //     $result = User::where('email', $data['email'])->get(['name', 'email', 'password'])->toArray();
    //     if (!empty($result)) {
    //         // echo "membandingkan " .$data['password'] ." dan  " .$result[0]['password'];
    //         // exit();
    //         if (Hash::check( $data['password'],$result[0]['password'])) {
                
    //             return response()->json(['success' => 'successful login', 'data' => $result]);
    //         }
    //         else {
    //             return response()->json(['error' => 'Email or Username is invalid'], 401);
    //         }
    //     } else {
    //         return response()->json(['error' => 'Email or Username is invalid'], 401);
    //     }
    // }


    // function register(Request $request)
    // {
    //     $data = $request->all();
    //     $result = User::where('email', $data['email'])->get()->toArray();
    //     if (empty($result)) {
    //         // echo "membandingkan " .$data['password'] ." dan  " .$result[0]['password'];
    //         // exit();

    //         $hashed = Hash::make($data['password'], [
    //             'rounds' => 12,
    //         ]);
    //         echo $hashed;
    //         exit();
    //         $user = new User;
    //         // $student->image_path = $idImage;
    //         $user->email = $data['email'];
    //         $user->password = $hashed;
    //         $user->createdAt = date("Y-m-d");
    //         $user->updatedAt = date("Y-m-d");
    //         $user->save();


    //     } else {
    //         return response()->json(['error' => 'Email is already registered'], 409);
    //     }
    // }

    function deleteLinkById(Request $request)
    {

            $data = $request->all();
            $link = Link::find($data['id']);
            $link->delete();
            return response()->json(['success' => 'Data is deleted'], 200);

    }

    function preview(Request $request, $short_link)
    {
 
            $link['link'] = Link::where('short_link', $short_link)->get();
            $link['platforms'] = Link_platform::where('id_link', $short_link)->get(['id', 'jenis_platform', 'url_platform', 'text']);
            // print_r($link);
            // exit();
            // return response()->json($link);
            return view('layouts/preview')->with('data',$link);
    }
}
