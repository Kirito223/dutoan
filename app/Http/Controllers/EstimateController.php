<?php

namespace App\Http\Controllers;

use App\Consts\Kind;
use App\Helpers\SessionHelper;
use App\Models\Estimate;
use App\Models\Estimatedetail;
use App\Models\Estimatesend;
use App\Models\Notice;
use App\Models\Noticereciver;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EstimateController extends Controller
{

    private $sessionHelper;
    public function __construct()
    {
        $this->sessionHelper = new SessionHelper();
    }
    public function index()
    {
        return view('estimates\index', ['nameDepartment' => $this->sessionHelper->Departmentname(), 'idDepartment' => $this->sessionHelper->DepartmentId()]);
    }

    public function viewListEstimate()
    {
        return view('estimates\list');
    }

    public function all()
    {
        $list = Estimate::where('unit', $this->sessionHelper->DepartmentId())->with('department')
            ->paginate(20);
        return $list;
    }
    public function viewApproval()
    {
        return view('estimates\waitingapproval');
    }
    public function viewDetail($id)
    {
        return view('estimates\viewdetail', ['id' => $id]);
    }

    public function getDetail($id)
    {
        $estimate = Estimate::where('id', $id)->with('template')
            ->with('department')
            ->first();
        $detailEstimate = Estimatedetail::where('estimate', $id)
            ->join('evaluationcriteria', 'evaluationcriteria.id', 'estimatedetail.evaluation')
            ->join('unit', 'unit.id', 'evaluationcriteria.unit')
            ->select('evaluationcriteria.name', 'evaluationcriteria.id', 'evaluationcriteria.parentId', 'unit.name as unit', 'estimatedetail.value')
            ->get();
        $detailEstimate = $this->buildTree($detailEstimate);
        return response()->json(['header' => $estimate, 'body' => $detailEstimate]);
    }


    function buildTree($elements, $parentId = 0)
    {

        $branch = array();
        foreach ($elements as $element) {
            if ($element['parentId '] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[$element['id']] = $element;
                unset($element);
            }
        }
        return $branch;
    }

    public function listEstimateApproval()
    {
        $list = Estimatesend::where('to', $this->sessionHelper->DepartmentId())
            ->where('estimates.accept', null)
            ->join('estimates', 'estimates.id', 'estimatesend.estimate')
            ->join('department', 'department.id', 'estimatesend.from')
            ->select('estimates.id', 'estimates.name', 'estimates.kind', 'estimates.date', 'department.name as creator', 'estimates.accept')
            ->paginate(20);
        return response()->json($list);
    }

    public function estimateApproval($id)
    {
        try {
            $estimate = Estimate::find($id);
            $estimate->accept = Kind::$APPROVAL;
            $estimate->accountsign = $this->sessionHelper->userId();

            if ($estimate->save()) {
                $estimateSend = Estimatesend::where('estimate', $id)
                    ->where('to', $this->sessionHelper->DepartmentId())->first();

                $notice = new Notice();
                $notice->title = $estimate->name . " đã được phê duyệt";
                $notice->content = $estimate->name . "Đã được " . $this->sessionHelper->Departmentname() . " phê duyệt";
                $notice->to = json_encode(array($estimateSend->from));
                $notice->kind = Kind::$APPROVAL;
                $notice->dateSend = Carbon::now();
                $notice->from = $this->sessionHelper->DepartmentId();
                if ($notice->save()) {
                    $noticeReciver = new Noticereciver();
                    $noticeReciver->notice = $notice->id;
                    $noticeReciver->to = $estimateSend->from;
                    if ($noticeReciver->save()) {
                        return response()->json(['msg' => 'ok', 'data' => 'Đã phê duyệt dự toán'], Response::HTTP_OK);
                    }
                }
            } else {
                return response()->json(['msg' => 'fail', 'data' => 'Đã có lỗi xảy ra vui lòng kiểm tra lại'], Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $th) {
            print($th);
            return response()->json(['msg' => 'fail', 'data' => 'Đã có lỗi xảy ra vui lòng kiểm tra lại'], Response::HTTP_BAD_REQUEST);
        }
    }
    public function estimateReject($id)
    {
        try {
            $estimate = Estimate::find($id);
            $estimate->accept = Kind::$REJECT;
            $estimate->accountsign = $this->sessionHelper->userId();
            if ($estimate->save()) {
                $estimateSend = Estimatesend::where('estimate', $id)
                    ->where('to', $this->sessionHelper->DepartmentId())->first();

                $notice = new Notice();
                $notice->title = $estimate->name . " đã bị từ chối";
                $notice->content = $this->sessionHelper->Departmentname() . " đã từ chối phê duyệt dự toán " .  $estimate->name;
                $notice->to = json_encode(array($estimateSend->from));
                $notice->kind = Kind::$REJECT;
                $notice->dateSend = Carbon::now();
                $notice->from = $this->sessionHelper->DepartmentId();
                if ($notice->save()) {
                    $noticeReciver = new Noticereciver();
                    $noticeReciver->notice = $notice->id;
                    $noticeReciver->to = $estimateSend->from;
                    if ($noticeReciver->save()) {
                        return response()->json(['msg' => 'ok', 'data' => 'Đã từ chối phê duyệt dự toán'], Response::HTTP_OK);
                    }
                }
            } else {
                return response()->json(['msg' => 'fail', 'data' => 'Đã có lỗi xảy ra vui lòng kiểm tra lại'], Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $th) {
            print($th);
        }
    }


    public function estimateAddtional(Request $request, $id)
    {
        try {
            $estimate = Estimate::find($id);
            $estimate->accept = Kind::$REJECT;
            $estimate->accountsign = $this->sessionHelper->userId();
            if ($estimate->save()) {
                $estimateSend = Estimatesend::where('estimate', $id)
                    ->where('to', $this->sessionHelper->DepartmentId())->first();
                $notice = new Notice();
                $notice->title = $estimate->name . " cần được sửa đổi bổ sung";
                $notice->content = $request->content;
                $notice->to = json_encode(array($estimateSend->from));
                $notice->kind = Kind::$REJECT;
                $notice->dateSend = Carbon::now();
                $notice->from = $this->sessionHelper->DepartmentId();
                if ($notice->save()) {
                    $noticeReciver = new Noticereciver();
                    $noticeReciver->notice = $notice->id;
                    $noticeReciver->to = $estimateSend->from;
                    if ($noticeReciver->save()) {
                        return response()->json(['msg' => 'ok', 'data' => 'Đã gửi yêu cầu sửa đổi, bổ sung'], Response::HTTP_OK);
                    }
                }
            } else {
                return response()->json(['msg' => 'fail', 'data' => 'Đã có lỗi xảy ra vui lòng kiểm tra lại'], Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $th) {
            print($th);
        }
    }


    public function sendEstimate(Request $request)
    {
        try {
            $listTo = json_decode($request->to);

            $notice = new Notice();
            $notice->title = $this->sessionHelper->Departmentname() . " Gửi yêu cầu phê duyệt dự toán" . $request->estimateName;
            $notice->content = $this->sessionHelper->Departmentname() . " Gửi yêu cầu phê duyệt dự toán" . $request->estimateName;
            $notice->from = $this->sessionHelper->DepartmentId();
            $notice->to = $request->to;
            $notice->kind = Kind::$REQUEST;
            $notice->dateSend = Carbon::now();
            if ($notice->save()) {
                $noticeId = $notice->id;
                foreach ($listTo as $to) {
                    $estimateSend = new Estimatesend();
                    $estimateSend->estimate = $request->estimate;
                    $estimateSend->from = $this->sessionHelper->DepartmentId();
                    $estimateSend->to = $to;
                    if ($estimateSend->save()) {
                        $noticeReciver = new Noticereciver();
                        $noticeReciver->to = $to;
                        $noticeReciver->notice = $noticeId;
                        $noticeReciver->save();
                    }
                }
            }


            return response()->json(['msg' => 'ok', 'data' => 'Gửi dự toán thành công'], Response::HTTP_OK);
        } catch (\Exception $ex) {
            print($ex);
        }
    }
    public function store(Request $request)
    {
        try {
            $estimate = new Estimate();
            $estimate->name = $request->name;
            $estimate->unit = $this->sessionHelper->DepartmentId();
            $estimate->date = Carbon::now();
            $estimate->kind = $request->kind;
            $estimate->template = $request->template;
            if ($estimate->save()) {
                $listValue = json_decode($request->listEvaluation);
                foreach ($listValue as $value) {
                    $estimateDetail = new Estimatedetail();
                    $estimateDetail->estimate = $estimate->id;
                    $estimateDetail->evaluation = $value->id;
                    $estimateDetail->value = $value->value;
                    $estimateDetail->save();
                }
            }
            return response()->json(['msg' => 'ok', 'data' => 'Lưu thành công'], Response::HTTP_OK);
        } catch (\Exception $th) {
            print($th);
        }
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
