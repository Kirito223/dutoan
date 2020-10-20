<?php

namespace App\Http\Controllers;

use App\Helpers\SessionHelper;
use App\Models\Report;
use App\Models\Reportsend;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    private $sessionHelper;

    public function __construct()
    {
        $this->sessionHelper = new SessionHelper();
    }
    public function index()
    {
        return view('report\index');
    }

    public function viewAddNew()
    {
        return view('report\addNew');
    }

    public function editView($id)
    {
        return view('report\edit', ['id' => $id]);
    }

    public function all()
    {
        $list = Report::with('department')->paginate(20);
        return response()->json($list);
    }

    public function show($id)
    {
        $report = Report::find($id);
        $reportSend = Reportsend::where('report', $id)->get();
        return response()->json(['msg' => 'ok', 'data' => ['report' => $report, 'send' => $reportSend]], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        try {
            $sendNotice = new NoticeController();
            $report = new Report();
            $report->name = $request->name;
            $report->date = Carbon::now();
            $report->creator = $this->sessionHelper->DepartmentId();
            $report->estimate = $request->estimates;
            $report->kind = $request->kind;
            $report->content = $request->content;
            if ($report->save()) {
                $toList = json_decode($request->department);
                foreach ($toList as $to) {
                    $reportSend = new Reportsend();
                    $reportSend->report = $report->id;
                    $reportSend->from = $this->sessionHelper->DepartmentId();
                    $reportSend->to = $to;
                    $reportSend->save();
                }
                $sendNotice->sendNotice($this->sessionHelper->Departmentname() . " gửi yêu cầu phê duyệt báo cáo " . $request->name, $this->sessionHelper->Departmentname() . " gửi yêu cầu phê duyệt báo cáo " . $request->name, $toList);
            }
            return response()->json(['msg' => 'ok', 'data' => 'Đã gửi báo cáo'], Response::HTTP_OK);
        } catch (\Exception $th) {
            print($th);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $sendNotice = new NoticeController();
            $report = Report::find($id);
            $report->name = $request->name;
            $report->date = Carbon::now();
            $report->creator = $this->sessionHelper->DepartmentId();
            $report->estimate = $request->estimates;
            $report->kind = $request->kind;
            $report->content = $request->content;
            if ($report->save()) {
                $toList = json_decode($request->department);

                $listOldSend = Reportsend::where('report', $id)->get();
                foreach ($listOldSend as $oldSend) {
                    Reportsend::destroy($oldSend->id);
                }

                foreach ($toList as $to) {
                    $reportSend = new Reportsend();
                    $reportSend->report = $id;
                    $reportSend->from = $this->sessionHelper->DepartmentId();
                    $reportSend->to = $to;
                    $reportSend->save();
                }
                $sendNotice->sendNotice($this->sessionHelper->Departmentname() . " gửi yêu cầu phê duyệt báo cáo " . $request->name, $this->sessionHelper->Departmentname() . " gửi yêu cầu phê duyệt báo cáo " . $request->name, $toList);
            }
            return response()->json(['msg' => 'ok', 'data' => 'Đã gửi báo cáo'], Response::HTTP_OK);
        } catch (\Exception $th) {
            print($th);
        }
    }

    public function destroy($id)
    {
        try {
            Report::destroy($id);
            $listOldSend = Reportsend::where('report', $id)->get();
            foreach ($listOldSend as $oldSend) {
                Reportsend::destroy($oldSend->id);
            }
            return response()->json(['msg' => 'ok', 'data' => 'Đã gửi báo cáo'], Response::HTTP_OK);
        } catch (\Exception $th) {
            print($th);
        }
    }
}
