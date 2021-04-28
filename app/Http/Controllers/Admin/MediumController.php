<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medium;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MediumController extends Controller
{
    public function index()
    {
        return view('admin.mediums.index');
    }

    public function getMediums(Request $request)
    {
        if ($request->ajax()) {
            $mediums = Medium::all();

            return DataTables::of($mediums)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . url("mediums/" . $row->id) . '" class="btn btn-warning text-warning p-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btm-danger text-danger p-2 delete" data-id="' . $row->id . '">
                                <i class="fas fa-trash-alt"></i>
                            </button>';
                })
                ->rawColumns(['action'])
                ->make(TRUE);
        }

        return response()->json([
            'status' => FALSE,
            'message' => 'Something went wrong, Please try again'
        ]);
    }

    public function show($id = NULL)
    {
        $medium = Medium::find($id);

        return view('admin.mediums.show', compact('medium'));
    }

    public function store(Request $request)
    {
        $mediumId = $request->post('id') ?? NULL;

        $request->validate([
            'title' => 'required|max:255|unique:mediums,' . $mediumId
        ]);

        $medium = Medium::updateOrCreate(
            [
                'title' => $request->post('title')
            ],
            [
                'status' => $request->post('status')
            ]
        );

        if($medium) {
            session()->flash('success', 'Medium details updated successfully.');
            return redirect(url('mediums/') . $medium->id);
        }

        session()->flash('error', 'Something went wrong, Please try again.');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        if($request->ajax())
        {
            $delete = Medium::destroy($request->post('id'));
            if($delete)
            {
                return response()->json([
                    'status' => TRUE,
                    'message' => 'Medium deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => FALSE,
            'message' => 'Something went wrong, Please try again.'
        ]);
    }
}
