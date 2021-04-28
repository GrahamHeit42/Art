<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Yajra\DataTables\DataTables;

class ContactDetailController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ContactUs::where('is_deleted', 0)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<button class="btn open-modal dlt-btn text-danger p-2" data-toggle="modal" data-target="#modal" data-id="$row->id" data-url="' . url("admin/contact-us/delete", $row->id) . '"><i class="fas fa-trash-alt"></i></button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(TRUE);
        }

        return view('admin.contact-us');
    }

    public function destroy($id)
    {
        $contact_us = ContactUs::find($id);
        $contact_us->status = 0;
        $contact_us->is_deleted = 1;
        $contact_us->deleted_at = Date('Y-m-d H:i:s');
        $contact_us->save();

        return redirect(url('admin/contact-us'))->with('success', config('constants.DELETE_MSG'));
    }
}
