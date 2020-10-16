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

    public function all()
    {
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
            if ($report->save()) {
                $toList = json_decode($report->department);
                foreach ($toList as $to) {
                    $reportSend = new Reportsend();
                    $reportSend->report = $report->id;
                    $reportSend->from = $this->sessionHelper->DepartmentId();
                    $reportSend->to = $to;
                    $reportSend->save();
                    $sendNotice->sendNotice($this->sessionHelper->Departmentname() . " gửi yêu cầu phê duyệt báo cáo " . $request->name, $this->sessionHelper->Departmentname() . " gửi yêu cầu phê duyệt báo cáo " . $request->name, $to);
                }
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

            $report = new Report();
            $report->name = $request->name;
            $report->date = Carbon::now();
            $report->creator = $this->sessionHelper->DepartmentId();
            $report->estimate = $request->estimates;
            $report->kind = $request->kind;
            if ($report->save()) {
                $toList = json_decode($report->department);
                foreach ($toList as $to) {
                    $reportSend = new Reportsend();
                    $reportSend->report = $report->id;
                    $reportSend->from = $this->sessionHelper->DepartmentId();
                    $reportSend->to = $to;
                    $reportSend->save();
                    $sendNotice->sendNotice($this->sessionHelper->Departmentname() . " gửi yêu cầu phê duyệt báo cáo " . $request->name, $this->sessionHelper->Departmentname() . " gửi yêu cầu phê duyệt báo cáo " . $request->name, $to);
                }
            }
            return response()->json(['msg' => 'ok', 'data' => 'Đã gửi báo cáo'], Response::HTTP_OK);
        } catch (\Exception $th) {
            print($th);
        }
    }

    public function destroy($id)
    {
        try {
            //code...
        } catch (\Exception $th) {
            print($th);
        }
    }
}
