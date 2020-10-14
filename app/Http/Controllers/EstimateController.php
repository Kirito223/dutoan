<?php

namespace App\Http\Controllers;

use App\Helpers\SessionHelper;
use App\Models\Estimate;
use App\Models\Estimatedetail;
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

    public function all()
    {
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
