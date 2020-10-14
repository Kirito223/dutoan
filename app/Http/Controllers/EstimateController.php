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
