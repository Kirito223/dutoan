<?php

namespace App\Http\Controllers;

use App\Helpers\SessionHelper;
use App\Models\Template;
use App\Models\Templatedetail;
use App\Models\Templateuse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TemplateController extends Controller
{
    private $sessionHelper;
    public function __construct()
    {
        $this->sessionHelper = new SessionHelper();
    }
    public function index()
    {
        return view('templates\index');
    }
    public function detailView()
    {
        return view('templates\templateDetail');
    }
    public function all(Request $request)
    {
        $list = null;
        if ($request->has('all')) {
            $list = Templateuse::where('templateuse.department', $this->sessionHelper->DepartmentId())
                ->join('template', 'template.id', 'templateuse.template')
                ->join('department', 'department.id', 'templateuse.department')
                ->select('template.id', 'department.name as creator', 'template.date', 'template.number', 'template.kind')
                ->get();
        } else {
            $list = Templateuse::where('templateuse.department', $this->sessionHelper->DepartmentId())
                ->join('template', 'template.id', 'templateuse.template')
                ->join('department', 'department.id', 'templateuse.department')
                ->select('template.id', 'department.name as creator', 'template.date', 'template.name',  'template.number', 'template.kind')
                ->paginate(20);
        }
        return response()->json($list);
    }

    public function store(Request $request)
    {
        try {
            $template = new Template();
            $template->name = $request->name;
            $template->date = Carbon::now();
            $template->time = $request->time;
            $template->number = $request->number;
            $template->department = $this->sessionHelper->DepartmentId();
            if ($template->save()) {
                $listEvaluation = json_decode($request->evaluation);
                foreach ($listEvaluation as $evaluation) {
                    $templateDetail = new Templatedetail();
                    $templateDetail->template = $template->id;
                    $templateDetail->evaluation = $evaluation;
                    $templateDetail->save();
                }

                $users = json_decode($request->user);
                foreach ($users as $user) {
                    $templateUser = new Templateuse();
                    $templateUser->template = $template->id;
                    $templateUser->department = $user;
                    $templateUser->save();
                }
                return response()->json(['msg' => 'ok', 'data' => 'lưu thành công'], Response::HTTP_OK);
            } else {
                return response()->json(['msg' => 'ok', 'data' => 'lưu thất bại'], Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $th) {
            print($th);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $template = Template::find($id);
            $template->name = $request->name;
            $template->date = Carbon::now();
            $template->time = $request->time;
            $template->number = $request->number;
            $template->department = $this->sessionHelper->DepartmentId();
            if ($template->save()) {
                $listEvaluation = json_decode($request->evaluation);
                foreach ($listEvaluation as $evaluation) {
                    $templateDetail = new Templatedetail();
                    $templateDetail->template = $template->id;
                    $templateDetail->evaluation = $evaluation;
                    $templateDetail->save();
                }

                $users = json_decode($request->user);
                foreach ($users as $user) {
                    $templateUser = new Templateuse();
                    $templateUser->template = $template->id;
                    $templateUser->department = $user;
                    $templateUser->save();
                }
                return response()->json(['msg' => 'ok', 'data' => 'lưu thành công'], Response::HTTP_OK);
            } else {
                return response()->json(['msg' => 'ok', 'data' => 'lưu thất bại'], Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $th) {
            print($th);
        }
    }

    public function destroy($id)
    {
        try {
            $template = Template::find($id);
            $template->delete();
            $templateDetail = Templatedetail::where('template', $id)->get();
            foreach ($templateDetail as $templateItem) {
                $templateItem->delete();
            }
            $templateUser = Templateuse::where('template', $id)->get();
            foreach ($templateUser as $item) {
                $item->delete();
            }
        } catch (\Throwable $th) {
            print($th);
        }
    }
}
