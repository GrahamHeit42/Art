<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubjectController extends Controller
{
    public function index()
    {
        return view('admin.subjects.index');
    }

    public function getSubjects(Request $request)
    {
        if ($request->ajax()) {
            $subjects = Subject::all();

            return DataTables::of($subjects)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . url("subjects/" . $row->id) . '" class="btn btn-warning text-warning p-2">
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
        $subject = Subject::find($id);

        return view('admin.subjects.show', compact('subject'));
    }

    public function store(Request $request)
    {
        $subjectId = $request->post('subject_id') ?? NULL;

        $request->validate([
            'title' => 'required|max:255|unique:subjects,' . $subjectId
        ]);

        $subject = Subject::updateOrCreate(
            [
                'title' => $request->post('title')
            ],
            [
                'status' => $request->post('status')
            ]
        );

        if($subject) {
            session()->flash('success', 'Subject details updated successfully.');
            return redirect(url('subjects/') . $subject->id);
        }

        session()->flash('error', 'Something went wrong, Please try again.');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        if($request->ajax())
        {
            $delete = Subject::destroy($request->post('id'));
            if($delete)
            {
                return response()->json([
                    'status' => TRUE,
                    'message' => 'Subject deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => FALSE,
            'message' => 'Something went wrong, Please try again.'
        ]);
    }
}
