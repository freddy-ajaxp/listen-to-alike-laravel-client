<?php

namespace App\Http\Controllers;

use App\Link;
use App\Link_platform;
use App\List_platform;
use App\List_text;
use App\Report;
use App\Reason;
use App\User;
use App\Clickthrough;
use App\Text;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Dotenv\Result\Result;
use Illuminate\Http\Request;
// use App\DynamicField;
// use JD\Cloudder\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notification;
use PhpParser\Node\Expr\List_;
use PhpParser\Node\Stmt\Catch_;
use PhpParser\Node\Stmt\TryCatch;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Validator;

class ListPlatformController extends Controller
{


    function insert(Request $request)
    {
        $referer = request()->headers->get('referer');
        if ($request->ajax()) {
            $data = $request->all();
            //validasi
            if ($request->file('image')) {
                // $request->validate(['image' => 'image|mimes:svg,jpg,JPG,jpeg,JPEG|max:10240',]);
                $validator = Validator::make($request->all(), [
                    'image' => 'image|mimes:svg,jpg,JPG,jpeg,JPEG|max:10240',
                ], $messages = [
                    'image.mimes' => 'format keliru',
                    'image.image' => 'harap upload gambar gambar .',
                    'image.max' => 'Ukuran melebihi kapasitas.',
                ]);
        
                if ($validator->fails()) {
                    print_r($validator->errors());
                    exit();
                    // redirect()
                    // ->back()
                    // ->withErrors($validator->errors());
                }
    
            }

           

            //BAGIAN insert link_platforms
            // $id_platforms = array_map('trim',array_filter(explode(",", $data['id_platforms'])));
            $id_platforms = array_map('trim', explode(",", $data['id_platforms']));
            $data_platform = array_map('trim', array_filter(explode(",", $data['data_platform'])));
            $data_url_platform = array_map('trim', array_filter(explode(",", $data['data_url_platform'])));
            $data_text = array_map('trim', array_filter(explode(",", $data['data_text'])));

            //kalau data platform ==0, return error, karena minimal 1
            if ($data['data_platform'] === null) {
                return response()->json([
                    'error'  => 'Harap isi minimal 1 platform'
                ], 400);
            }

            // if array has different length, meaning some field at some [index] of array is null
            // this a little prevention from user bypassing front end validation 
            if (
                !array_key_exists('link_title', $data)
                || (count($data_platform) !== count($data_url_platform))
                || (count($data_url_platform) !== count($data_text))
                || (count($data_url_platform) !== count($id_platforms))
            ) {
                return response()->json([
                    'error'  => 'Harap lengkapi form'
                ], 400);
            }

            // mengecek apakah input platform & text dari user tersedia di DB
            // ketika user mengisi form, admin bisa menghapus data di DB dan view user blm terupdate
            $platformDiDB = List_platform::whereIn('id', $data_platform)->pluck('id')->toArray();
            $textDiDB = Text::whereIn('id', $data_text)->pluck('id')->toArray();
            // print_r($textDiDB);
            $bedaPltDBdanInput = array_diff($data_platform, $platformDiDB); //array diff yg baru (percobaan mungkin kebalik)
            $bedaTextDBdanInput = array_diff($data_text, $textDiDB);

            //jika beda, berarti data input user tidak sesuai dgn yg ada di DB
            if (
                count($bedaPltDBdanInput) != 0
            ) {
                return response()->json([
                    'error'  => 'Terjadi kesalahan pada pilihan Platform yang anda masukkan, mohon untuk refresh halaman ini'
                ], 500);
            }
            if (
                count($bedaTextDBdanInput) != 0
            ) {
                return response()->json([
                    'error'  => 'Terjadi kesalahan pada pilihan Text yang anda masukkan, mohon untuk refresh halaman ini'
                ], 500);
            }
            //create object dulu 
            $link = new Link;

            //BAGIAN upload to cloud
            if ($request->file('image')) {
                $uploadedFileUrl = \Cloudinary::upload($request->file('image')->getRealPath());
                $idImage =  $uploadedFileUrl->getPublicId();
                $link->image_path = $idImage;
            } else {
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

            $temp = array(); // ini buat apa ya??
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
            'title' => $link->title
        );

        return view('components/user/partials/modal-created')->with(["data" => $dataReturn]); //ini untuk dynamic modal
    }

    function upsert(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();

            //START VALIDATION
            if ($request->file('image')) {
                $request->validate(['image' => 'image|mimes:svg,jpg,JPG|max:10240',]);
            }


            // $id_platforms = array_map('trim',array_filter(explode(", ", $data['id_platforms'])));
            $id_platforms = array_map('trim', explode(",", $data['id_platforms']));
            $data_platform = array_map('trim', array_filter(explode(",", $data['data_platform'])));
            $data_url_platform = array_map('trim', array_filter(explode(",", $data['data_url_platform'])));
            $data_text = array_map('trim', array_filter(explode(",", $data['data_text'])));

            //kalau data platform ==0, return error, karena minimal 1
            if ($data['data_platform'] === null) {
                return response()->json([
                    'error'  => 'Harap isi minimal 1 platform'
                ], 400);
            }
            // if array has different length, meaning some field at some [index] of array is null
            // this a little prevention from user bypassing front end validation 

            if (
                !array_key_exists('link_title', $data)
                || (count($data_url_platform) !==  count($data_platform))
                || (count($data_url_platform) !== count($data_text))
                || (count($data_url_platform) !== count($id_platforms)) //id platform bisa 0 untuk platform baru
            ) {
                return response()->json([
                    'error'  => 'Harap lengkapi form'
                ], 400);
            }

            // mengecek apakah input platform & text dari user tersedia di DB
            // ketika user mengisi form, admin bisa menghapus data di DB dan view user blm terupdate
            $platformDiDB = List_platform::whereIn('id', $data_platform)->pluck('id')->toArray();
            $textDiDB = Text::whereIn('id', $data_text)->pluck('id')->toArray();
            $bedaPltDBdanInput = array_diff($data_platform, $platformDiDB);
            $bedaTextDBdanInput = array_diff($data_text, $textDiDB);
            //jika beda, berarti data input user tidak sesuai dgn yg ada di DB
            if (
                count($bedaPltDBdanInput) != 0
            ) {
                return response()->json([
                    'error'  => 'Terjadi kesalahan pada pilihan Platform yang anda masukkan, mohon untuk refresh halaman ini'
                ], 500);
            }
            if (
                count($bedaTextDBdanInput) != 0
            ) {
                return response()->json([
                    'error'  => 'Terjadi kesalahan pada pilihan Text yang anda masukkan, mohon untuk refresh halaman ini'
                ], 500);
            }

            //create object dulu 
            $link = new Link;
            $link = Link::find($data['id']);

            //user id session != links user id. throw error
            // dd(session()->get('id'));
            // dd($link->id_user);
            if ($link->id_user != session()->get('id')) {
                return response()->json([
                    'error'  => 'Unauthorized Action'
                ], 401);
            }


            // hapus data di DB kalau user memilih mengkosongkan gambar
            // agar di ketika preview menampilkan hitam
            if (!$request->file('image') && $data['userErasingImage'] === 'true') {
                $link->image_path = null;
            }
            // jika user mendiamkan preview gambar, artinya gambar tdk diganti, tetap yang lama
            // tidak ada perubahan di cloud dan database
            else if (!$request->file('image') && $data['userErasingImage'] === 'false') {
            }


            // END  VALIDATION 


            // upload to cloud kalau ada gambar baru
            if ($request->file('image')) {
                $uploadedFileUrl = \Cloudinary::upload($request->file('image')->getRealPath());
                $idImage =  $uploadedFileUrl->getPublicId();
                $link->image_path = $idImage;
            }

            //save LINK
            $video_embed_url = str_replace("watch?v=", "embed/", $data['video_embed_url']);
            $link->video_embed_url = $video_embed_url;
            $link->title = $data['link_title'];
            $link->save();
            //END LINK


            //get old ids from DB
            $listOldPlatformsId = Link_platform::where('id_link', $data['id'])->pluck('id')->toArray();

            // filtered out new platform which has id value of 0
            // $idsToDeleted = array_diff($id_platforms, $listOldPlatformsId); // yg lama, data yg dihapus tidak masuk
            $idsToDeleted = array_diff($listOldPlatformsId, $id_platforms);
            // print_r($id_platforms);
            // print_r($listOldPlatformsId);
            // print_r($idsToDeleted);
            // exit();
            Link_platform::findMany($idsToDeleted)->each(function ($each) {
                $each->delete();
            });

            //data di front yg dihapus, di back tidak dibuang?
            for ($i = 0; $i < count($data_platform); $i++) {
                //kalau menggunakan id di form =0
                if ($id_platforms[$i] != 0) {
                    //kalau menggunakan id di form tanpa value
                    // if($id_platforms[$i]) {
                    Link_platform::where('id', $id_platforms[$i])
                        ->update([
                            'text' => $data_text[$i],
                            'jenis_platform' => $data_platform[$i],
                            'url_platform' => $data_url_platform[$i],
                            'updatedAt' => date("Y-m-d")
                        ]);
                }
                //update
                elseif ($id_platforms[$i] == 0) {
                    // elseif(!$id_platforms[$i]) {

                    $new_data = new Link_platform;
                    $new_data->jenis_platform = $data_platform[$i];
                    $new_data->url_platform = $data_url_platform[$i];
                    $new_data->text = $data_text[$i];
                    $new_data->createdAt = date("Y-m-d");
                    $new_data->updatedAt = date("Y-m-d");
                    $new_data->deletedAt = null;
                    $new_data->id_link = $data['id'];
                    $new_data->save();
                }
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
        // $link->show_status = 2; //ini yg lama, ketika menghapus show_statusnya masih 2
        // $link->save(); //ini yg lama, ketika menghapus show_statusnya masih 2
        $link->delete();
        return response()->json(['success' => 'Data is deleted'], 200);
    }

    function preview(Request $request, $short_link)
    {
        $ip = $request->ip();
        $referer = request()->getHost();

        $link['link'] = Link::where('short_link', $short_link)->get()->toArray();
        if ($link['link'] == null) {
            abort(404);
        }

        if ($link['link'][0]['show_status'] == 2) {
            abort(404, "It seems this page cannot be displayed for violating our Term of Service. If you own this Link, you can contact our administrator. ");
        }

        $result = Visit::where('link_id', $link['link'][0]['id'])->where('ip', $ip)->get()->toArray();

        //if IP had not visited that link
        //and that IP is not Admin's IP or that user's IP
        if (
            ($link['link'][0]['id_user'] != session()->get('id')) &&
            (session()->get('admin') != 1) &&
            ($result == null)
        ) {
            $visit = new Visit;
            $visit->link_id  = $link['link'][0]['id'];
            $visit->ip  = $ip;
            $visit->referer = $referer;
            $visit->createdAt = date("Y-m-d");
            $visit->updatedAt = date("Y-m-d");
            $visit->save();
        }

        $link['platforms'] = Link_platform::withTrashed()->where('id_link', $link['link'][0]['id'])->get(['id', 'jenis_platform', 'url_platform', 'text']);
        $link['video_id'] = substr($link['link'][0]['video_embed_url'], strrpos($link['link'][0]['video_embed_url'], '/') + 1);
        $link['image_path'] = $link['link'][0]['image_path'];

        //check if url for iframe is return 200,
        // Use get_headers() function 
        $vidUrlExist = @get_headers($link['link'][0]['video_embed_url']);

        // Use condition to check the existence of URL 
        if (!($vidUrlExist && strpos($vidUrlExist[0], '200'))) {
            $link['link'][0]['video_embed_url'] = "";
        }

        $reasons = Reason::get();        
        return view('components/user/view/preview')->with(['data' =>  $link, 'reasons' => $reasons]);
    }

    function detail(Request $request, $short_link)
    {
        $ip = $request->ip();
        $id_user = $request->session()->get('id');
        $data['link'] =
            DB::table('links')
            ->select(DB::raw('*, (SELECT count(*) FROM `visits` WHERE `visits`.`link_id` = `links`.`id` AND MONTH(createdAt) = MONTH(CURRENT_DATE()) AND YEAR(createdAt) = YEAR(CURRENT_DATE()))  AS `count` '))
            ->where('short_link', '=', $short_link)
            ->get();

        $data['link']->transform(function ($i) {
            return (array)$i;
        });
        
        //jumlah link 0? berarti link tersebut tidak ada, throw 404
        if ($data['link']->count() === 0) {
            abort(404);
        }

        $data['platform'] = DB::table('link_platforms')
            ->select(DB::raw('*, (SELECT count(*) FROM `clickthroughs` WHERE `clickthroughs`.`link_platform_id` = `link_platforms`.`id`) AS `count`'))
            ->where('id_link', '=', $data['link'][0]['id'])
            ->get()->toArray();


        $data['referer'] = DB::table('visits')
            ->select('referer', DB::raw('COUNT(*) AS `count`'))
            ->groupBy('referer')
            ->where('link_id', '=', $data['link'][0]['id'])
            ->get()->toArray();

 
        //START getting months and years for SELECT
        $yearList = Visit::
                select(DB::raw("DATE_FORMAT(createdAt, '%Y') AS year"))
            ->where('link_id', '=', $data['link'][0]['id'])
            ->groupBy('year')
            ->get()->pluck('year')
            ->toArray();

        $monthList = self::getListOfMonths();
        // dd($monthList);
        //END SELECT

        $curMonth = idate("m");
        $curYear =  idate("Y");
        $chartData = self::countLinkChart($curMonth,$curYear,$data['link'][0]['id']);
        // dd($chartData);
        ['arrDaysInMth' => $arrDaysInMth , 'calendar' => $calendar, 'maxVisit' => $maxVisit] = $chartData;
        return view('components/user/view/detail-link')->with(['data' => $data, 'visits' => $arrDaysInMth, 'calendar' => $calendar, 'maxVisit' => $maxVisit, 'yearList' => $yearList, 'monthList'=> $monthList]);
    }

    //untuk grafik visit Link per date yg diminta
    function countLinkChart($mth, $yer, $idLink){
        $month = $mth ?? date("m");
        $year = $yer ?? date("Y");
        $chart = [];
        // DB::enableQueryLog();
        $allVisit = DB::table('visits')
            ->select('createdAt', DB::raw('count(*) as visit'))
            ->where('link_id', '=', $idLink)
            ->whereMonth('createdAt', $month)
            ->whereYear('createdAt', $year)
            ->groupBy('createdAt')
            ->get();
        // dd(DB::getQueryLog());
        // dd($allVisit);
        
        $visitsInMonth = array_sum($allVisit->pluck('visit')->toArray());
        // dd($allVisit->toArray());
        // echo $month ." " .$year;
        // exit();
        $daysCount = cal_days_in_month(CAL_GREGORIAN, $month, $year); //$bulanDiminta
        $calendar = array_fill(0, $daysCount, 0);
        $arrDaysInMth = array_fill(0, $daysCount, 0);
        for ($i = 1; $i <= count($arrDaysInMth); $i++) {
            foreach ($allVisit as $key => $value) {
                if ($i == Carbon::parse($value->createdAt)->format('d')) {
                    $arrDaysInMth[$i] = $value->visit;
                };
            }
        }

        $chart['arrDaysInMth'] = $arrDaysInMth;
        $chart['calendar'] = $calendar;
        $chart['maxVisit'] = max($arrDaysInMth);
        $chart['visitsInMonth'] = $visitsInMonth;
        return $chart;
    }

    function getCountLinkChart(Request $request){
        $data = $request->all();
        $chartData = self::countLinkChart($data['month'],$data['year'],$data['linkId']);
        return response()->json($chartData);
    }
    function profile(Request $request)
    {
        $id = $request->session()->get('id');
        $data = User::where('id', $id)->first(['id', 'name', 'email', 'admin', 'password'])->toArray();
        return view('components/user/view/profile')->with('data', $data);
    }

    function notifikasi(Request $request)
    {
        $id = $request->session()->get('id');
        $data = User::where('id', $id)->first(['id', 'name', 'email', 'admin', 'password']);
        session(['newNotification' => 0]);
        return view('components/user/view/notifikasi')->with('data', $data);
    }

    function viewCtr(Request $request)
    {
        $data = $request->all();
        $ip = $request->ip();
        $result = Clickthrough::where('link_id', $data['link_id'])->where('link_platform_id', $data['link_platform_id'])->where('ip', $ip)->get()->toArray();

        if ($result == null) {
            $clickthrough = new Clickthrough;
            $clickthrough->link_id  = $data['link_id'];
            $clickthrough->link_platform_id  = $data['link_platform_id'];
            $clickthrough->ip  = $ip;
            $clickthrough->createdAt = date("Y-m-d");
            $clickthrough->updatedAt = date("Y-m-d");
            $clickthrough->save();
        }
    }

    function deleteModal(Request $request)
    {
        $data = $request->all();
        try {
            return view('components/user/partials/modal-delete'); //ini untuk dynamic modal   
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function viewSelect(Request $request)
    {
        $platforms = List_platform::where('published', 1)->get(['id', 'platform_name', 'logo_image_path', 'platform_regex', 'published'])->toArray();
        $text = List_text::get(['id', 'text'])->toArray();
        return view('components/user/partials/select-platform')->with(['platforms' => $platforms, 'texts' => $text, 'emptyLayout' => true]);
    }

    function buttonViewSelect(Request $request)
    {
        $platforms = List_platform::where('published', 1)->get(['id', 'platform_name', 'logo_image_path', 'platform_regex', 'published'])->toArray();
        $text = List_text::get(['id', 'text'])->toArray();
        return view('components/user/partials/button-select-platform')->with(['platforms' => $platforms, 'texts' => $text, 'emptyLayout' => true]);
    }

    function addModal(Request $request)
    {
        $data = $request->all();
        $platforms = List_platform::where('published', 1)->get(['id', 'platform_name', 'logo_image_path', 'platform_regex', 'published'])->toArray();
        $text = List_text::get(['id', 'text'])->toArray();
        try {
            return view('components/user/partials/modal-add')->with(['platforms' => $platforms, 'texts' => $text, 'emptyLayout' => true]); //ini untuk dynamic modal   
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function savePreSignup(Request $request)
    {
        //save presgnup Links guest made
        $data = $request->all();
        $shortlinks = array_column(json_decode($data['links']), 'link');
        $idUser = $request->session()->get('id');
        Link::where('short_link', $shortlinks)->update(['id_user' => $idUser]);;
    }


    function customModal(Request $request)
    {
        try {
            return view('components/user/partials/modal-custom'); //ini untuk dynamic modal   
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function report(Request $request)
    {
        $data = $request->all();
        $ip = $request->ip();
        $ipReporterExist = Report::where('ip_reporter', $ip)->where('link', $data['idLink'])->first();
        if($ipReporterExist){
            return response()->json([
                'success'  => 'Laporan Anda sebelumnya telah kami terima dan telah menjadi bahan pertimbangan kami.'
            ], 200);
        }
        $new_data = new Report;
        $new_data->link = $data['idLink'];
        $new_data->ip_reporter = $ip;
        // $new_data->reason = $data['reasons'][$i];
        $new_data->additional_reason = $data['messageText'];
        $new_data->createdAt = date("Y-m-d");
        $new_data->updatedAt = date("Y-m-d");
        $new_data->save();
        // $new_data->reasons()->attach($new_data->id);
        $new_data->reasons()->attach($data['reasons']);
        return response()->json([
            'success'  => 'Laporan Anda telah kami terima'
        ], 200);
    }
    function getListOfMonths(){

        $data = array (
            array('urutan'=>1, 'bulan' => "Januari"),
            array('urutan'=>2, 'bulan' => "Februari"),
            array('urutan'=>3, 'bulan' => "Maret"),
            array('urutan'=>4, 'bulan' => "April"),
            array('urutan'=>5, 'bulan' => "Mei"),
            array('urutan'=>6, 'bulan' => "Juni"),
            array('urutan'=>7, 'bulan' => "Juli"),
            array('urutan'=>8, 'bulan' => "Agustus"),
            array('urutan'=>9, 'bulan' => "September"),
            array('urutan'=>10, 'bulan' => "Oktober"),
            array('urutan'=>11, 'bulan' => "November"),
            array('urutan'=>12, 'bulan' => "Desember")
        );
        return $data;

    }
    function dummy()
    {
                
    }
}
