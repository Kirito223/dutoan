<?php

namespace App\Http\Controllers;

use App\Helpers\SessionHelper;
use App\Models\Evaluationcriterion;
use Doctrine\DBAL\Abstraction\Result;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EvaluationCriterionController extends Controller
{
    private $sessionHelper;
    public function __construct()
    {
        $this->sessionHelper = new SessionHelper();
    }
    public function index()
    {
        return view('evaluationCriterion\index');
    }

    public function all()
    {
        $result = Evaluationcriterion::where('deleted_at', null)->where('department', $this->sessionHelper->DepartmentId())->get();
        $result = $this->buildTree($result);
        return response()->json($result);
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
    public function store(Request $request)
    {
        try {
            $evaluation = new Evaluationcriterion();
            $evaluation->name = $request->name;
            if ($request->parent != null) {
                $evaluation->parentId = $request->parent;
                $pathParent = Evaluationcriterion::find($request->parent);
                $evaluation->path = $pathParent->path . '-' . $pathParent->id;
            } else {
                $evaluation->parentId = null;
                $evaluation->path = null;
            }
            $evaluation->department = $this->sessionHelper->DepartmentId();
            if ($evaluation->save()) {
                return response()->json(['msg' => 'ok', 'data' => 'ok'], Response::HTTP_OK);
            } else {
                return response()->json(['msg' => 'ok', 'data' => 'fails'], Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $th) {
            print($th);
        }
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
        try {
            $evaluation = Evaluationcriterion::find($id);
            $evaluation->name = $request->name;
            if ($request->parent != null) {
                $evaluation->parentId = $request->parent;
                $pathParent = Evaluationcriterion::find($id);
                $evaluation->path = $pathParent->path . '-' . $pathParent->id;
            } else {
                $evaluation->parentId = null;
                $evaluation->path = null;
            }
            if ($evaluation->save()) {
                return response()->json(['msg' => 'ok', 'data' => 'ok'], Response::HTTP_OK);
            } else {
                return response()->json(['msg' => 'fail', 'data' => 'fail'], Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $th) {
            print($th);
        }
    }

    public function destroy($id)
    {
        try {
            $evaluationParent = Evaluationcriterion::find($id);
            $evaluationParent->delete();
            $child = Evaluationcriterion::where('parentId', '=', $id)->get();
            foreach ($child as $c) {
                $c->delete();
            }
            return response()->json(['msg' => 'ok', 'data' => 'ok'], Response::HTTP_OK);
        } catch (\Exception $th) {
            print($th);
        }
    }
}
