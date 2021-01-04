<?php

namespace App\Http\Controllers;

use App\Link;
use App\Link_platform;
use App\List_platform;
use App\User;
use App\Text;
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
        $data = Link::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<button id="deletetBtn" class="btn btn-danger" >Hapus</button> '
                    . "<a href='/preview/$row->short_link'" . ' class="btn btn-info ">Lihat</a>'
                    . "<a href='/detail/$row->short_link'" . ' class="btn btn-default ">Detail</a>';
                //    <button id="viewBtn">Detail</button>
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getAllUsers()
    {
        $result = User::all();
        return Datatables::of($result)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<button id="resetBtn" class="btn btn-secondary">Reset Password</button>
                           <button id="deactivateBtn" class="btn btn-danger">Hapus User</button> '
                    . "<a href='getUserDataById/$row->id'" . 'id="viewBtn"  class="btn btn-info">Lihat</button>
                           ';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function getUserDataById(Request $request, $id)
    {
        $dataUser = User::where('id', $id)->first()->toArray();
        return view('components/admin/view/user-profile')->with('data', $dataUser);
    }

    public function getAllPlatforms()
    {
        $result = List_platform::all();
        return Datatables::of($result)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<button id="deleteLogoBtn" class="btn btn-danger">Hapus</button> 
                <button id="editLogoBtn" class="btn btn-info">Edit </button>
                           ' . ($row->published ? 
                           "<a href='/publishing' id='editLogoBtn' class='btn btn-success'>Publish </a>"
                           : "<a href='/publishing' id='editLogoBtn' class='btn btn-warning'>Hide </a>" );
                        //    <a href='/preview/$row->short_link'" . ' class="btn btn-info ">Lihat</a>
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getAllTexts()
    {
        $listText = Text::all();
        return Datatables::of($listText)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<button id="deleteTextBtn" class="btn btn-danger">Hapus </button> 
                ';
                // <button id="editTextBtn" class="btn btn-info">Edit</button>
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
        return response()->json([
            `'success'  => 'action success'`
        ]);
    }

    function editPlatform(Request $request)
    {
        // echo request()->headers->get("X-Requested-With");
        // if ($request->ajax()) {

        $data = $request->all();
        if ('XMLHttpRequest' == request()->headers->get("X-Requested-With")) {
            $data = $request->all();
            // return error kalau user memilih mengkosongkan gambar
            // karena harus ada gambar
            if (!$request->hasFile('image')) {
                return response()->json([
                    'error'  => 'you have to choose a logo to be uploaded'
                ], 400);
            }
            //validasi ukuran type image
            $request->validate(['image' => 'required|image|mimes:svg,jpg,JPG|max:1024',]);

            if ($request->file('image')) {
                //BAGIAN upload to cloud kalau ada gambar baru
                $uploadedFileUrl = \Cloudinary::upload(
                    $request->file('image')->getRealPath(),
                    [
                        'folder' => 'assets/logo',
                    ]
                );

                $namaImage =  $uploadedFileUrl->getPublicId();
                // $namaImage = 'assets/logo/fqmkqcwgsoldqfkarjta';
                //BAGIAN UPDATE DATA 
                // $link_platform = Link_platform::where('id', $data['id'])->first()->get();
                $list_platform = List_platform::find($data['id']);
                $list_platform->logo_image_path = $namaImage;
                $list_platform->updatedAt = date("Y-m-d");
                $list_platform->save();

                return response()->json([
                    'success'  => 'action success'
                ]);
            }
            // jika user mendiamkan preview gambar, artinya gambar tdk diganti, tetap yang lama
            // tidak ada perubahan di cloud dan database
            else if (!$request->file('image') && $data['userErasingImage'] === 'false') {
                return response()->json([
                    'success'  => 'nothing changed'
                ]);
            }
        }
    }

    function addText(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            //validasi


            // if array has different length, meaning some field at some [index] of array is null
            // this a little prevention from user bypassing front end validation 
            if (!$data['text']) {
                return response()->json([
                    'failed'  => 'Please fill all field'
                ], 400);
            }

            //create object dulu 
            $text = new Text;
            $text->text = $data['text'];
            $text->createdAt = date("Y-m-d");
            $text->updatedAt = date("Y-m-d");
            $text->save();
            return response()->json([
                'success'  => 'action success'
            ], 200);
        }
    }

    function deletePlatform(Request $request)
    {

        $data = $request->all();
        // $logo_image_path = List_platform::where('id', $data['id'])->first()->logo_image_path;
        $list_platform = List_platform::find($data['id']);
        $dataExist = Link_platform::where('jenis_platform', $list_platform['platform_name'])->first();
        // jika ada record yang berkaitan, tidak boleh dihapus
        if ($dataExist) {
            return response()->json(['error' => 'Cannot delete Platform that is being used in a Link by User(s)'], 400);
        }
        $logo_image_path = $list_platform->logo_image_path;
        //delete record di db
        $list_platform->delete();
        //delete file di server
        $deleteResult = \Cloudinary::destroy($logo_image_path);
        if (!$deleteResult) {
            return response()->json(['error' => 'Error hen deleting on cloud'], 500);
        }
        return response()->json(['success' => 'Data is deleted'], 200);
    }

    //ini fungsi dummy, hanya untuk percobaan
    function datatables(Request $request)
    {
        // dd("asd");
        if ($request->ajax()) {
            $data = Link::select('*');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button id="deletetBtn">Hapus</button>
                           <button id="viewBtn">Detail</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    function deleteLink(Request $request)
    {
        $data = $request->all();
        $link = Link::find($data['id']);
        $link->delete();
        return response()->json(['success' => 'Data is deleted'], 200);
    }

    function deleteUser(Request $request)
    {
        $data = $request->all();
        $user = User::find($data['id']);
        $user->delete();
        return response()->json(['success' => 'Data is deleted'], 200);
    }

    function getUserLinkList(Request $request, $id_user)
    {

        if ($request->ajax()) {
            $data = Link::where('id_user', $id_user)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn =
                        //    '<button id="viewBtn" class="btn btn-info">Visit</button>'
                        "<a href='/preview/$row->short_link'" . ' class="btn btn-info ">Lihat</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    function deleteLinkModal(Request $request)
    {
        return view('components/admin/partials/modal-delete-link');
    }
    function deletePlatformModal(Request $request)
    {
        return view('components/admin/partials/modal-delete-platform');
    }
    function deleteUserModal(Request $request)
    {
        return view('components/admin/partials/modal-delete-user');
    }
    function deleteTextModal(Request $request)
    {
        return view('components/admin/partials/modal-delete-text');
    }
    function resetPwdModal(Request $request)
    {
        $data = $request->all();
        // dd($data['id']);
        $user = User::where('id', $data['id'])->first(['email', 'id'])->toArray();
        return view('components/admin/partials/modal-reset-password')->with('data', $user);
    }
    function editPlatformModal(Request $request)
    {
        $data = $request->all();
        $platform = List_platform::where('id', $data['id'])->first()->toArray();
        // dd($platform);
        return view('components/admin/partials/modal-edit-platform')->with('data', $platform);
    }

    function resetPassword(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if (!$data['password'] ||  !$data['password2']) {
                return response()->json(['error' => 'Please fill both pasword fields'], 400);
            }
            if ($data['password'] !== $data['password2']) {
                return response()->json(['error' => 'password does not match'], 400);
            }
            if (strlen($data['password']) < 8) {
                // return redirect('/register')->with('error', 'Passwords minimal 8 character');
                return response()->json(['error' => 'Passwords minimal 8 character'], 400);
            }

            $hashed = Hash::make($data['password'], [
                'rounds' => 12,
            ]);

            $user = User::find($data['id']);
            $user->password = $hashed;
            $user->save();

            return response()->json(['success' => 'data is updated'], 200);
        }
    }
}
