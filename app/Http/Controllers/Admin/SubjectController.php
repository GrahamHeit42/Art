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
        view()->share('page_title', 'Subjects');

        return view('admin.subjects.index');
    }

    public function getSubjects(Request $request)
    {
        if ($request->ajax()) {
            $subjects = Subject::latest()->get();

            return DataTables::of($subjects)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . url("admin/subjects/" . $row->id) . '" class="btn btn-lg text-warning p-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-lg text-danger p-2 delete" data-id="' . $row->id . '">
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

        view()->share('page_title', ( ! empty($id) ? 'Update' : 'Create' ) . ' Subject');

        return view('admin.subjects.show', compact('subject'));
    }

    public function store(Request $request)
    {
        $subjectId = $request->post('id') ?? NULL;

        $request->validate([
            'title' => 'required|max:255|unique:subjects,title,' . $subjectId
        ]);

        $subject = Subject::updateOrCreate(
            [
                'id' => $subjectId
            ],
            [
                'title' => $request->post('title'),
                'status' => $request->post('status')
            ]
        );

        if ($subject) {
            session()->flash('success', 'Subject details updated successfully.');

            return redirect(url('admin/subjects') . '/' . $subject->id);
        }

        session()->flash('error', 'Something went wrong, Please try again.');

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $delete = Subject::destroy($request->post('id'));
            if ($delete) {
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
