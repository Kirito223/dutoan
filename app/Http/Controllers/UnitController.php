<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function index()
    {
        return view('unit\index');
    }

    public function all(Request $request)
    {
        if ($request->has('all')) {
            $list = Unit::where('deleted_at', null)->get();
            return response()->json($list);
        } else {
            $list = Unit::where('deleted_at', null)->paginate(20);
            return response()->json($list);
        }
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), ['name' => 'required'], ['required' => 'Tên không được để trống']);
            if ($validate->fails()) {
                return response()->json(['msg' => 'fail', 'data' => $validate->errors()], Response::HTTP_OK);
            } else {
                $unit = new Unit();
                $unit->name = $request->name;
                if ($unit->save()) {
                    return response()->json(['msg' => 'ok', 'data' => $unit], Response::HTTP_OK);
                } else {
                    return response()->json(['msg' => 'ok', 'data' => 'fail'], Response::HTTP_BAD_REQUEST);
                }
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
            $unit = Unit::find($id);
            $unit->name = $request->name;
            if ($unit->save()) {
                return response()->json(['msg' => 'ok', 'data' => $unit], Response::HTTP_OK);
            } else {
                return response()->json(['msg' => 'ok', 'data' => 'fail'], Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $th) {
            print($th);
        }
    }

    public function destroy($id)
    {
        try {
            $unit = Unit::find($id);
            $unit->delete();
            return response()->json(['msg' => 'ok', 'data' => "delete success"], Response::HTTP_OK);
        } catch (\Exception $th) {
            print($th);
        }
    }
}
