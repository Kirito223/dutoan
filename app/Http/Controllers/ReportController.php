<?php

namespace App\Http\Controllers;

use App\Consts\Kind;
use App\Helpers\SessionHelper;
use App\Models\Estimate;
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

    public function viewListApproval()
    {
        return view('report\listApproval');
    }

    public function viewAproval($id)
    {
        $report = Report::where('id', '=', $id)
            ->with('department')->first();
        $kind = "Năm";
        switch ($report->kind) {
            case Kind::$PRECIOUS:
                $kind = "Quý";
                break;
            case Kind::$MONTH:
                $kind = "Tháng";
                break;

            default:
                $kind = "Năm";
                break;
        }

        $estimateList = array();
        $estimate = json_decode($report->estimate);
        foreach ($estimate as $es) {
            $find = Estimate::find($es);
            array_push($estimateList, $find);
        }
        return view('report\approval', ['report' => $report, 'estimate' => $estimateList, 'kind' => $kind, 'id' => $id]);
    }


    public function viewDetail($id)
    {
        $report = Report::where('id', '=', $id)
            ->with('department')->first();
        $kind = "Năm";
        switch ($report->kind) {
            case Kind::$PRECIOUS:
                $kind = "Quý";
                break;
            case Kind::$MONTH:
                $kind = "Tháng";
                break;

            default:
                $kind = "Năm";
                break;
        }

        $estimateList = array();
        $estimate = json_decode($report->estimate);
        foreach ($estimate as $es) {
            $find = Estimate::find($es);
            array_push($estimateList, $find);
        }
        return view('report\viewDetail', ['report' => $report, 'estimate' => $estimateList, 'kind' => $kind]);
    }

    public function approvalReport($id)
    {
        try {
            $report = Report::find($id);
            $report->status = Kind::$APPROVAL;
            $report->signer = $this->sessionHelper->DepartmentId();
            if ($report->save()) {
                $send = Reportsend::where('report', $id)
                    ->where('to', $this->sessionHelper->DepartmentId())->first();
                $notice = new NoticeController();
                $notice->sendNotice($report->name . " đã được phê duyệt", $report->name . ' đã được phê duyệt', [$send->from]);
                return response()->json(['msg' => 'ok', 'data' => 'Đã phê duyệt báo cáo'], Response::HTTP_OK);
            } else {
                return response()->json(['msg' => 'fail', 'data' => 'Có lỗi xảy ra, vui lòng thực hiện lại sau'], Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $th) {
            print $th;
        }
    }
    public function rejectReport($id)
    {
        try {
            $report = Report::find($id);
            $report->status = Kind::$REJECT;
            $report->signer = $this->sessionHelper->DepartmentId();
            if ($report->save()) {
                $send = Reportsend::where('report', $id)
                    ->where('to', $this->sessionHelper->DepartmentId())->first();
                $notice = new NoticeController();
                $notice->sendNotice($report->name . " đã được phê duyệt", $report->name . ' đã được phê duyệt', [$send->from]);
                return response()->json(['msg' => 'ok', 'data' => 'ok'], Response::HTTP_OK);
            } else {
                return response()->json(['msg' => 'fail', 'data' => 'Có lỗi xảy ra, vui lòng thực hiện lại sau'], Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $th) {
            print $th;
        }
    }

    public function additionalReport(Request $request, $id)
    {
        try {
            $report = Report::find($id);
            $report->status = Kind::$ADDITIONAL;
            if ($report->save()) {
                $notice = new NoticeController();
                $send = Reportsend::where('report', $id)
                    ->where('to', $this->sessionHelper->DepartmentId())->first();
                $notice->sendNotice($request->content, $request->content, [$send->from]);
                return response()->json(['msg' => 'ok', 'data' => 'Đã yêu cầu sửa đổi, bổ sung'], Response::HTTP_OK);
            } else {
                return response()->json(['msg' => 'fail', 'data' => 'Có lỗi xảy ra, vui lòng thực hiện lại sau'], Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $th) {
            print $th;
        }
    }

    public function listApproval()
    {
        $list = Reportsend::where('reportsend.to', '=', $this->sessionHelper->DepartmentId())
            ->with(['report' => function ($query) {
                $query
                    ->where('status', null)
                    ->with('department');
            }])->paginate(20);
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
            $report = Report::find($id);
            if ($report->status == Kind::$APPROVAL) {
                return response()->json(['msg' => 'fail', 'data' => 'Không thể xóa báo cáo đã phê duyệt'], Response::HTTP_OK);
            } else {
                Report::destroy($id);
                $listOldSend = Reportsend::where('report', $id)->get();
                foreach ($listOldSend as $oldSend) {
                    Reportsend::destroy($oldSend->id);
                }
                return response()->json(['msg' => 'ok', 'data' => 'Đã xóa báo cáo'], Response::HTTP_OK);
            }
        } catch (\Exception $th) {
            print($th);
        }
    }
}
