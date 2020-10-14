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

    public function loadTemplate($template)
    {
        $list = Templatedetail::where('template', $template)
            ->join('evaluationcriteria', 'evaluationcriteria.id', 'templatedetail.evaluation')
            ->join('unit', 'unit.id', 'evaluationcriteria.unit')
            ->select('unit.name as unit', 'evaluationcriteria.id', 'evaluationcriteria.path',  'evaluationcriteria.name', 'evaluationcriteria.parentId')
            ->get();

        $list = $this->buildTree($list);
        return $list;
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

    public function editTemplate($id)
    {
        return view('templates\editTemplate', ['id' => $id]);
    }
    public function detailView()
    {
        return view('templates\templateDetail');
    }
    public function edit($id)
    {
        $template = Template::where('id', $id)
            ->with('Templatedetail')
            ->with(['Templateuse' => function ($query) {
                $query->with('department');
            }])
            ->first();
        return response()->json($template);
    }

    public function all(Request $request)
    {
        $list = null;
        if ($request->has('all')) {
            $list = Templateuse::where('templateuse.department', $this->sessionHelper->DepartmentId())
                ->where('templateuse.deleted_at', null)
                ->join('template', 'template.id', 'templateuse.template')
                ->join('department', 'department.id', 'templateuse.department')
                ->select('template.id', 'template.time',  'department.name as creator', 'template.date', 'template.number', 'template.name')
                ->get();
        } else {
            $list = Templateuse::where('templateuse.department', $this->sessionHelper->DepartmentId())
                ->where('templateuse.deleted_at', null)
                ->join('template', 'template.id', 'templateuse.template')
                ->join('department', 'department.id', 'templateuse.department')
                ->select('template.id', 'template.time',  'department.name as creator', 'template.date', 'template.name',  'template.number')
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

                $templateUser = new Templateuse();
                $templateUser->template = $template->id;
                $templateUser->department = $this->sessionHelper->DepartmentId();
                $templateUser->save();

                foreach ($users as $user) {
                    if ((int)$user != $this->sessionHelper->DepartmentId()) {
                        $templateUser = new Templateuse();
                        $templateUser->template = $template->id;
                        $templateUser->department = $user;
                        $templateUser->save();
                    }
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
                $listEvaluationDel = Templatedetail::where('template', $id)->get();
                foreach ($listEvaluationDel as $value) {
                    $value->delete();
                }
                $listEvaluation = json_decode($request->evaluation);
                foreach ($listEvaluation as $evaluation) {
                    $templateDetail = new Templatedetail();
                    $templateDetail->template = $template->id;
                    $templateDetail->evaluation = $evaluation;
                    $templateDetail->save();
                }

                $users = json_decode($request->user);
                $templateUserDel = Templateuse::where('template', $id)->get();
                foreach ($templateUserDel as $value) {
                    $value->delete();
                }
                $templateUser = new Templateuse();
                $templateUser->template = $template->id;
                $templateUser->department = $this->sessionHelper->DepartmentId();
                $templateUser->save();

                foreach ($users as $user) {
                    if ((int)$user != $this->sessionHelper->DepartmentId()) {
                        $templateUser = new Templateuse();
                        $templateUser->template = $template->id;
                        $templateUser->department = $user;
                        $templateUser->save();
                    }
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
