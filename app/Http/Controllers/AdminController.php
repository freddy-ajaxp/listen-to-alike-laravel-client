<?php

namespace App\Http\Controllers;

use App\Link;
use App\Link_platform;
use App\List_platform;
use App\User;
use App\Text;
use App\Report;
use App\Reason;
use App\Reason_report;
use App\Notification;
use Carbon\Carbon;
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
    public function getAllLinks(Request $request)
    {
        // DB::enableQueryLog(); 
        $data = $request->all();
        $data = Link::withTrashed()->with('Link_platform')
        // ->when($data['filter'], function ($query) use ($data) {
        //     return $query->where('role_id', $data);
        // })
        ->get();
        // dd(DB::getQueryLog());
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<button id="deletetBtn" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</button> '
                    . "<a href='/m/$row->short_link'" . ' class="btn btn-info"><i class="far fa-eye"></i> Lihat</a>'
                    . "<a href='/detail/$row->short_link'" . ' class="btn btn-secondary"><i class="fas fa-info"></i> Detaill</a>'                    
                    ;
                //    <button id="viewBtn">Detail</button>
                return $btn;
            })
            ->addColumn('platforms', function ($row) {
                $toReturn = '';
                $data = [];
                // $first_names = array_column($row->link_platform, 'first_name');
                // print_r($row->link_platform[0]->list_platform->get(['platform_name'])->toArray());
                // print_r($row->link_platform->list_platform);
                foreach ($row->link_platform as $object)
                {
                  $toReturn .= $object->list_platform->platform_name;
                  array_push($data, $object->list_platform->platform_name);
                  
                }
                // exit();
                return (join(', ', $data));
                return $row->link_platform;

            })
            ->rawColumns(['action', 'platforms'])
            ->make(true);
    }

    

    public function getAllUsers()
    {
        $result = User::all();
        
        return Datatables::of($result)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = "";
                if($row->admin !=  2){
                    $btn = '<button id="resetBtn" class="btn btn-secondary">Reset Password</button> ';
                }
                

                    $btn = "<a href='getUserDataById/$row->id'" . 'id="viewBtn"  class="btn btn-info"><i class="far fa-eye"></i> Lihat</button> </a> ' ;
                
                    if (Session::get('admin') == 2) {
                        $disabled= "";
                        if($row->admin ==  2){
                            $disabled = ' disabled '; 
                        }

                        if($row->admin !=  2){
                            $btn .= '
                            <div class="dropdown">
                            <button ' .$disabled .' class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-edit"></i> Set Privilegee
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" name="set-privilige" data-privilige="user" >User</a>
                              <a class="dropdown-item" name="set-privilige" data-privilige="admin">Admin </a>
                            </div>
                          </div>';
                        }
                        

                    }                    
                    ;
                    if($row->admin !=  2){
                        $btn .= '<button id="deactivateBtn" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus User</button> ';
                    }

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getAllReports()
    {
        // $allReports = Report::select(DB::raw('*, count(`link`)'))->groupBy('link'); //ini yg lama, report yg di gorup
         $allReports  = Report::get();
        return Datatables::of($allReports)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn='';
                if($row->links->show_status == 1){
                    $btn = "<button href='admin/publishing' id='banBtn' class='btn btn-danger' title='Menkonfirmasi laporan dan memblokir Link Terkait'><i class='fas fa-ban'></i> Ban Link</button>";
                } 
                else{
                    $btn = "<button href='admin/publishing' id='pulihkanBtn' class='btn btn-success' title='Menormalkan status Link sehingga dapat dikunjungi kembali' ><i class='fas fa-undo'></i> Pulihkan Link</button>";
                }          
                // $btn .= " <button id='reportInfoBtn' class='btn btn-info'>Lihat Laporan</button>";
                return $btn;    
            })
            ->addColumn('shortLink', function ($row) {
                return $row->links->short_link;    
            })
            ->addColumn('date', function ($row) {
                return Carbon::parse($row->createdAt)->format('d-M-Y'); 
            })
            ->addColumn('reasons', function ($row) {

                //ini yg awal, works
                if(!$row->reasons->toArray()){ 
                    return "Tidak ada laporan";
                }

                $reasons = "";
                foreach($row->reasons as $key => $value) {
                    # code...
                    $reasons .= 
                    "<span class='badge badge-dark'>$value->reason</span> ";
                }
                
                
                return $reasons;
                
            })
            ->rawColumns(['action', 'reasons'])
            ->make(true);
    }

    public function getReportByLink(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $allReports = Report::where('link', $data['linkId'])->get();
        // print_r(($allReports));
        // exit();
        // Report::get();//yg lama, it works
        return Datatables::of($allReports)
            ->addIndexColumn()
            ->addColumn('shortLink', function ($row) {
                return $row->additional_reason;    
            })
            ->make(true);
    }


    public function getUserDataById(Request $request, $id)
    {
        $dataUser = User::where('id', $id)->first()->toArray();
        return view('components/admin/view/user-profile')->with('data', $dataUser);
    }

    public function getAllPlatforms()
    {
        $result = List_platform::withTrashed()->get();
        return Datatables::of($result)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<button id="deleteLogoBtn" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</button> 
                <button id="editLogoBtn" class="btn btn-info"><i class="far fa-edit"></i> Edit </button>
                           ' . ($row->deletedAt ? 
                           "<button href='admin/publishing' id='publishLogoBtn' class='btn btn-success'><i class='far fa-eye'></i> Publish </button>"
                           : 
                           "<button href='admin/publishing' id='hideLogoBtn' class='btn btn-warning'><i class='fas fa-eye-slash'></i> Hide</button>"
                            );
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getAllReasons()
    {
        $result = Reason::get();
        return Datatables::of($result)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<button id="deleteReasonBtn" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</button> 
                <button id="editReasonBtn" class="btn btn-info"><i class="far fa-edit"></i> Edit</button>';
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
                $btn = '<button id="deleteTextBtn" data-id=' ."'$row->id'" .'class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus </button> 
                ';
                // <button id="editTextBtn" class="btn btn-info">Edit</button>
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    function addPlatform(Request $request)
    {
            $data = $request->all();
            if (!$request->hasFile('image')) {
                return response()->json([
                    'error'  => 'you have to choose a new logo to be uploaded'
                ], 400);
            }
            else{
                //validasi ukuran type image
                $request->validate(['image' => 'required|image|mimes:svg,png|max:1024',]);
            }

            //BAGIAN upload to cloud
            $uploadedFileUrl = \Cloudinary::upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'assets/logo',
                ]
            );
            $namaImage =  $uploadedFileUrl->getPublicId();
            $extensiFile =  $uploadedFileUrl->getExtension();
            //BAGIAN CREATE DATA 
            $list_platform = new List_platform();
            $list_platform->platform_name = $data['platform_name'];
            $list_platform->logo_image_path = $namaImage .'.' .$extensiFile;
            $list_platform->platform_regex = $data['platform_url'];
            $list_platform->createdAt = date("Y-m-d");
            $list_platform->updatedAt = date("Y-m-d");
            $list_platform->save();
        
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
                    'error'  => 'you have to choose a new logo to be uploaded'
                ], 400);
            }
            else{
                //validasi ukuran type image
                $request->validate(['image' => 'image|mimes:svg,png|max:1024',]);
            }
            
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

    function addReason(Request $request)
    {
            $data = $request->all();
            //validasi
            // if array has different length, meaning some field at some [index] of array is null
            // this a little prevention from user bypassing front end validation 
            if (!isset($data['text']) || !isset($data['reason'])) {
                return response()->json([
                    'error'  => 'Please fill all field'
                ], 400);
            }
            $dataExist = Reason::where('reason', $data['reason'])->first();
            if($dataExist){
                return response()->json([
                    'error'  => 'Kategori yang anda masukkan sudah ada di database, silahkan menggunakan nama yang lain'
                ], 400);
            }

            //create object dulu 
            $reason = new Reason;
            $reason->reason = $data['reason'];
            $reason->text = $data['text'];
            $reason->createdAt = date("Y-m-d H:i:s");
            $reason->updatedAt = date("Y-m-d H:i:s");
            $reason->save();
            return response()->json([
                'success'  => 'action success'
            ], 200);
    }
    
    function editReason(Request $request)
    {
            $data = $request->all();

            if (!isset($data['text']) || !isset($data['reason'])) {
                return response()->json([
                    'error'  => 'Please fill all field'
                ], 400);
            }

            $reason = Reason::find($data['id']);
            $reason->reason = $data['reason'];
            $reason->text = $data['text'];
            $reason->updatedAt = date("Y-m-d H:i:s");
            $reason->save();
            return response()->json([
                'success'  => 'data berhasil diubah'
            ], 200);



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
                    'error'  => 'Please fill all field'
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
        $list_platform = List_platform::withTrashed()->where('id',$data['id'])->first();
        $dataExist = Link_platform::withTrashed()->where('jenis_platform', $data['id'])->first();
    
        // jika ada record yang berkaitan, tidak boleh dihapus
        if ($dataExist) {
            return response()->json(['error' => 'Cannot delete Platform that is being used in a Link by User(s)'], 400);
        }

        $logo_image_path = $list_platform->logo_image_path;

        //delete record di db
        $list_platform->forceDelete();
        //delete file di server
        $deleteResult = \Cloudinary::destroy($logo_image_path);
        if (!$deleteResult) {
            return response()->json(['error' => 'Error when deleting image on cloud'], 500);
        }
        return response()->json(['success' => 'Data is deleted'], 200);
    }

    function deleteReason(Request $request)
    {

        $data = $request->all();
        $dataExist = Reason_report::where('reason_id',$data['id'])->first();
        // jika ada record yang berkaitan, tidak boleh dihapus
        if ($dataExist) {
            return response()->json(['error' => 'Cannot delete Reason because it is already submitted in atleast 1 report '], 400);
        }
        $reason = Reason::withTrashed()->where('id',$data['id'])->first();
        $reason->delete();
    
        return response()->json(['success' => 'Data is deleted'], 200);
    }


    function deleteText(Request $request){
        $data = $request->all();
        $dataExist = Link_platform::where('text', $data['id'])->first();
        // jika ada record yang berkaitan, tidak boleh dihapus
        if ($dataExist) {
            return response()->json(['error' => 'Cannot delete Text that is being used in a Link by User(s)'], 400);
        }

        try { 
            $text = Text::find($data['id']);
               $text->delete();
             return response()->json(['success' => 'Text is deleted'], 200);
            //Your code
           } catch(\Illuminate\Database\QueryException $ex){ 
            //  put error loggin here
             return response()->json(['error' => 'An error occurred'], 500);
           }
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
        $link = Link::withTrashed()->where('id', $data['id'])->first();
        $link->forceDelete();
        return response()->json(['success' => 'Data is deleted permanently'], 200);
    }

    function banLink(Request $request)
    {
        $data = $request->all();
        if(!$data['banReason']){
            return response()->json(['error' => 'Please specify reason'], 400);
        }
    
        $report = Report::where('id', $data['idReport'])->first();
        $report->validated = 1;
        $report->save();
        $link = Link::find($report->link);
        $link->show_status = 2;
        $link->save();

        $userId = Link::where('id', $data['idLink'])->first('id_user')->value('id_user');
        $notif = new Notification();
        $notif->data = $data['banReason'];
        $notif->notifiable_id = $userId;
        $notif->created_at = date("Y-m-d H:i:s");
        $notif->updated_at = date("Y-m-d H:i:s");
        $notif->save();
        return response()->json(['success' => 'Link is now banned'], 200);
    }

    function pulihkanLink(Request $request)
    {
        $data = $request->all();
        $report = Report::where('id', $data['idReport'])->first();
        $report->validated = 0;
        $report->save();
        $link = Link::find($report->link);
        $link->show_status = 1;
        $link->save();
        return response()->json(['success' => 'Link is now restored'], 200);
    }
    
    function setPrivilege(Request $request)
    {
        
        $data = $request->all();
        $user = User::find($data['id']);
        switch ($data['privilege']) {
            case 'user' :
                $user->admin= 0;
                break;
            case 'admin':
                $user->admin= 1;
                break;
        }
        $user->save();
        
        return response()->json(['success' => 'Action Success'], 200);
    }

    function publishPlatform(Request $request)
    {
        $data = $request->all();
        $link = List_platform::withTrashed()->where('id', $data['id'])->first();

        $link->restore();
        return response()->json(['success' => 'Data is restored'], 200);
    }
    function hidePlatform(Request $request)
    {
        $data = $request->all();
        $link = List_platform::withTrashed()->where('id', $data['id'])->first();
        $link->delete();
        return response()->json(['success' => 'Data is deleted'], 200);
    }

    function deleteUser(Request $request)
    {
        $data = $request->all();

        // jika ada record yang berkaitan, tidak boleh dihapus
        $dataExist = Link::withTrashed()->where('id_user', $data['id'])->first();
        if ($dataExist) {
            return response()->json(['error' => 'User tersebut memiliki Link dan tidak dapat dihapus'], 400);
        }

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
                        "<a href='/m/$row->short_link'" . ' class="btn btn-info ">Lihat</a>';
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
    function deleteReasonModal(Request $request)
    {
        return view('components/admin/partials/modal-delete-reason');
    }

    function deleteUserModal(Request $request)
    {
        return view('components/admin/partials/modal-delete-user');
    }

    function deleteTextModal(Request $request)
    {
        $data = $request->all();
        $data = Text::find($data['idText']);
        return view('components/admin/partials/modal-delete-text')->with('data', $data);
    }

    function banLinkModal(Request $request)
    {
        $data = $request->all();
        $link = Link::where('id', $data['idLink'])->first('short_link', 'title');
        $data = Report::find($data['id']);
        return view('components/admin/partials/modal-ban-link')->with(['idReport' => $data['id'], 'dataLink' => $link]);
    }
    
    function resetPwdModal(Request $request)
    {
        $data = $request->all();
        $user = User::where('id', $data['id'])->first(['email', 'id'])->toArray();
        return view('components/admin/partials/modal-reset-password')->with('data', $user);
    }
    function editPlatformModal(Request $request)
    {
        $data = $request->all();
        $platform = List_platform::withTrashed()->where('id', $data['id'])->first()->toArray();
        // dd($platform);
        return view('components/admin/partials/modal-edit-platform')->with('data', $platform);
    }

    function editReasonModal(Request $request)
    {
        $data = $request->all();
        $reason = Reason::withTrashed()->where('id', $data['id'])->first()->toArray();
        // dd($platform);
        return view('components/admin/partials/modal-edit-reason')->with('data', $reason);
    }

    function reportInfoModal(Request $request)
    {
        $data = $request->all();
        // dd($data['idLink']);
        // $platform = List_platform::withTrashed()->where('id', $data['id'])->first()->toArray();
        // $allReports = Report::select(DB::raw('*, count(`link`)'))->groupBy('link');
        $temp = DB::select("SELECT `reason_id`, COUNT(`reason_id`) `jumlah`, reason.reason
        FROM (SELECT * FROM `reason_report` resrep WHERE resrep.report_id in ( SELECT `id` FROM `report` rep WHERE rep.link = ${data['idLink']})) as `temp`
        JOIN `reason` on temp.reason_id = reason.id
        GROUP BY `reason_id`");
        //convert from stdclass object to arrayu
        $results = json_decode(json_encode($temp), true);
        return view('components/admin/partials/modal-report-info')->with(['reportsInfo'=>$results]);
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
