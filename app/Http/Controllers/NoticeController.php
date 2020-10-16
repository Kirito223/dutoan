<?php

namespace App\Http\Controllers;

use App\Consts\Kind;
use App\Helpers\SessionHelper;
use App\Models\Department;
use App\Models\Notice;
use App\Models\Noticereciver;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use stdClass;

class NoticeController extends Controller
{
    private $sessionHelper;

    public function __construct()
    {
        $this->sessionHelper = new SessionHelper();
    }
    public function index()
    {
        return view('sendNotice\index');
    }

    public function all()
    {
        $list = Notice::paginate(15);
        $temp = json_encode($list);
        $listData = json_decode($temp);

        $TempData = $listData->data;
        $data = array();
        foreach ($TempData as $item) {
            $itemNotice = new stdClass();
            $itemNotice->id = $item->id;
            $itemNotice->title = $item->title;
            $unit = json_decode($item->to);
            $units = '';
            foreach ($unit as $value) {
                $u = Department::find($value);
                $units .= $u->name . ',';
            }
            $itemNotice->unit = $units;
            $itemNotice->dateSend = $item->dateSend;
            array_push($data, $itemNotice);
        }
        $result = new stdClass();
        $result->data = $data;
        $result->total = $listData->last_page;
        return response()->json(['msg' => 'ok', 'data' => $result], Response::HTTP_OK);
    }


    public function sendNotice($title, $content, $sendTo)
    {
        $notice = new Notice();
        $notice->title = $title;
        $notice->content = $content;
        $notice->from = $this->sessionHelper->DepartmentId();
        $notice->to = $sendTo;
        $notice->kind = Kind::$REQUEST;
        $notice->dateSend = Carbon::now();
        if ($notice->save()) {
            $noticeId = $notice->id;
            foreach ($listTo as $to) {
                $noticeReciver = new Noticereciver();
                $noticeReciver->to = $to;
                $noticeReciver->notice = $noticeId;
                $noticeReciver->save();
            }
        }
    }

    public function store(Request $request)
    {
        try {
            $arrFile = array();
            $files = $request->files->get("files");
            if (!is_dir(public_path('upload'))) {
                mkdir(public_path('upload'));
            }

            if ($files != null) {
                foreach ($files as $f) {
                    $f->move(public_path('upload'), $f->getClientOriginalName());
                    array_push($arrFile, $f->getClientOriginalName());
                }
            }
            $notice = new Notice();
            $notice->title = $request->get('title', "");
            $notice->content = $request->get('content');
            $notice->file = json_encode($arrFile);
            $notice->dateSend = Carbon::now();
            $notice->to = $request->get('to');
            $notice->kind = $request->get('kind', 1);
            $notice->from = $this->sessionHelper->DepartmentId();
            if ($notice->save()) {
                $to = json_decode($request->get('to'));

                foreach ($to as $item) {
                    $reciver = new Noticereciver();
                    $reciver->notice = $notice->id;
                    $reciver->to = $item;
                    $reciver->save();
                }

                return response()->json(['msg' => 'ok', 'data' => $notice], Response::HTTP_OK);
            } else {
                return response()->json(['msg' => 'fails', 'data' => 'fails'], Response::HTTP_BAD_REQUEST);
            }
        } catch (Exception $th) {
            print($th);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $arrFile = array();
            $files = $request->files->get("files");

            $notice = Notice::find($id);
            $notice->title = $request->get('title', "");
            $notice->content = $request->get('content');
            if (count($files) > 0) {
                if (!is_dir(public_path('upload'))) {
                    mkdir(public_path('upload'));
                }

                if ($files != null) {
                    foreach ($files as $f) {
                        $f->move(public_path('upload'), $f->getClientOriginalName());
                        array_push($arrFile, $f->getClientOriginalName());
                    }
                }
                $notice->file = json_encode($arrFile);
            }

            $notice->file = json_encode($arrFile);
            $notice->to = $request->get('to');
            $notice->dateSend = Carbon::now();
            $notice->kind = $request->get('kind', 1);
            $notice->from = $this->sessionHelper->DepartmentId();
            if ($notice->save()) {
                $to = json_decode($request->get('to'));
                foreach ($to as $item) {
                    $reciver = new Noticereciver();
                    $reciver->notice = $notice->id;
                    $reciver->to = $item;
                    $reciver->save();
                }
                return response()->json(['msg' => 'ok', 'data' => $notice], Response::HTTP_OK);
            } else {
                return response()->json(['msg' => 'fails', 'data' => 'fails'], Response::HTTP_BAD_REQUEST);
            }
        } catch (Exception $th) {
            return response()->json(['msg' => 'fails', 'data' => $th], Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy($id)
    {
        try {
            Notice::destroy($id);
            return response()->json(['msg' => 'ok', 'data' => $id], Response::HTTP_OK);
        } catch (\Exception $th) {
            return response()->json(['msg' => 'fails', 'data' => $th], Response::HTTP_BAD_REQUEST);
        }
    }


    public function listNoticeReciver()
    {
        $listReciver = Noticereciver::where('noticereciver.to', '=',  $this->sessionHelper->DepartmentId())
            ->join('notice', 'notice.id', 'noticereciver.notice')
            ->join('department', 'department.id',  'notice.from')
            ->select('notice.title', 'notice.id',  'notice.dateSend', 'noticereciver.to',  'department.name')
            ->paginate(15);
        return response()->json($listReciver);
    }


    public function viewNotice($id, $detail)
    {
        if ($detail == 'home') {
            $notice = Notice::where('notice.id', '=', $id)
                ->join('department', 'department.id',  'notice.from')
                ->select('notice.*', 'department.name')
                ->first();
            return view('sendNotice\noticeDetail', ['notice' => $notice, 'listTo' => []]);
        }
        if ($detail == "detail") {
            $notice = Notice::where('notice.id', '=', $id)
                ->join('department', 'department.id',  'notice.from')
                ->select('notice.*', 'department.name')
                ->first();
            $listReciver = json_decode($notice->to);
            $arrReciver = array();
            foreach ($listReciver as $value) {
                $u = Department::find($value);
                array_push($arrReciver, $u->name);
            }
            return view('sendNotice\noticeDetail', ['notice' => $notice, 'listTo' => $arrReciver]);
        }
    }

    public function downloadFile($file)
    {
        return response()->download(public_path('upload/') . $file);
    }
}
