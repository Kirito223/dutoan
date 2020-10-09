<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NoticeController extends Controller
{
    public function index()
    {
        return view('sendNotice\index');
    }

    public function all()
    {
        $list = Notice::paginate(15);
        return response()->json(['msg' => 'ok', 'data' => $list], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        try {
            $arrFile = array();
            $files = $request->files->get("files");
            if (!is_dir(public_path('upload'))) {
                mkdir(public_path('upload'));
            }

            if ($files != null) {
                foreach ($files as $f) {
                    $f->move(public_path('upload'), $f->getClientOriginalName());
                    array_push($arrFile, $f->getClientOriginalName());
                }
            }
            $notice = new Notice();
            $notice->title = $request->get('title', "");
            $notice->content = $request->get('content');
            $notice->file = json_encode($arrFile);
            $notice->to = $request->get('to');
            $notice->kind = $request->get('kind', 1);
            if ($notice->save()) {
                return response()->json(['msg' => 'ok', 'data' => $notice], Response::HTTP_OK);
            } else {
                return response()->json(['msg' => 'fails', 'data' => 'fails'], Response::HTTP_BAD_REQUEST);
            }
        } catch (Exception $th) {
            print($th);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $arrFile = array();
            $files = $request->files->get("files");

            $notice = Notice::find($id);
            $notice->title = $request->get('title', "");
            $notice->content = $request->get('content');
            if (count($files) > 0) {
                if (!is_dir(public_path('upload'))) {
                    mkdir(public_path('upload'));
                }

                if ($files != null) {
                    foreach ($files as $f) {
                        $f->move(public_path('upload'), $f->getClientOriginalName());
                        array_push($arrFile, $f->getClientOriginalName());
                    }
                }
                $notice->file = json_encode($arrFile);
            }

            $notice->file = json_encode($arrFile);
            $notice->to = $request->get('to');
            $notice->kind = $request->get('kind', 1);
            if ($notice->save()) {
                return response()->json(['msg' => 'ok', 'data' => $notice], Response::HTTP_OK);
            } else {
                return response()->json(['msg' => 'fails', 'data' => 'fails'], Response::HTTP_BAD_REQUEST);
            }
        } catch (Exception $th) {
            return response()->json(['msg' => 'fails', 'data' => $th], Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy($id)
    {
        try {
            Notice::destroy($id);
            return response()->json(['msg' => 'ok', 'data' => $id], Response::HTTP_OK);
        } catch (\Exception $th) {
            return response()->json(['msg' => 'fails', 'data' => $th], Response::HTTP_BAD_REQUEST);
        }
    }
}
