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
                ->editColumn('image_url', function ($subject) {
                    if ($subject->image_url !== NULL) {
                        return '<img src="' . $subject->image_url . '" width="70px" height="70px"/>';
                    } else {
                        return '';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . url("admin/subjects/" . $row->id) . '" class="btn btn-lg text-warning p-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-lg text-danger p-2 delete" data-id="' . $row->id . '">
                                <i class="fas fa-trash-alt"></i>
                            </button>';
                })
                ->rawColumns(['action', 'image_url'])
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

        view()->share('page_title', (!empty($id) ? 'Update' : 'Create') . ' Subject');

        return view('admin.subjects.show', compact('subject'));
    }

    public function store(Request $request)
    {
        $subjectId = $request->post('id') ?? NULL;

        $request->validate([
            'title' => 'required|max:255|unique:subjects,title,' . $subjectId
        ]);

        $image_path = NULL;
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('subjects', $fileName);
            $image_path = 'storage/subjects/' . $fileName;
        }

        $subject = Subject::updateOrCreate(
            [
                'id' => $subjectId
            ],
            [
                'title' => $request->post('title'),
                'image_path' => $image_path,
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
    public function deleteImage(Request $request)
    {
        if ($request->ajax()) {
            $subject = Subject::find($request->post('id'));
            $subject->image_path = NULL;
            $save = $subject->save();
            if ($save) {
                return response()->json([
                    'status' => TRUE,
                    'message' => 'Subject image deleted successfully.'
                ]);
            }
        }

        return response()->json([
            'status' => FALSE,
            'message' => 'Something went wrong, Please try again.'
        ]);
    }
}
