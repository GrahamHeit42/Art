<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
                ->editColumn('content', function ($row) {
                    return Str::limit($row->content, 250);
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . url("admin/pages/" . $row->id) . '" class="btn btn-lg text-warning p-2">
                                <i class="fas fa-edit"></i>
                            </a>';
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
        view()->share('page_title', ( ! empty($id) ? 'Update' : 'Create' ) . ' Page');

        return view('admin.pages.show', compact('page'));
    }

    public function store(Request $request)
    {
        $pageId = $request->post('id') ?? NULL;

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $page = Page::updateOrCreate(
            [
                'id' => $pageId
            ],
            [
                'title' => $request->post('title'),
                'content' => $request->post('content'),
                'status' => $request->post('status')
            ]
        );

        if ($page) {
            session()->flash('success', 'Page details updated successfully.');

            return redirect(url('admin/pages/' . $page->id));
        }

        session()->flash('error', 'Something went wrong, Please try again.');

        return redirect()->back();
    }
}
