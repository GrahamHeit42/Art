<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PageController extends Controller
{
    public function index()
    {
        view()->share('page_title', 'Pages');
        return view('admin.pages.index');
    }

    public function getPages(Request $request)
    {
        if ($request->ajax()) {
            $pages = Page::all();

            return DataTables::of($pages)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . url("pages/" . $row->id) . '" class="btn btn-warning text-warning p-2">
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
            'message' => 'Something went wrong, Please try again.'
        ]);
    }

    public function show($id = NULL)
    {
        $page = Page::find($id);
        view()->share('page_title', (!empty($id) ? 'Update' : 'Create') . ' Page');

        return view('admin.pages.show', compact('page'));
    }

    public function store(Request $request)
    {
        $pageId = $request->post('id') ?? NULL;

        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        $page = Page::updateOrCreate(
            [
                'id' => $pageId
            ],
            [
                'type' => $request->post('type'),
                'title' => $request->post('title'),
                'content' => $request->post('content'),
                'status' => $request->post('status')
            ]
        );

        if($page) {
            session()->flash('success', 'Page details updated successfully.');
            return redirect(url('pages/') . $page->id);
        }

        session()->flash('error', 'Something went wrong, Please try again.');
        return redirect()->back();
    }
}
