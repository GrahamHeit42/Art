<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ArtistController extends Controller
{
    public function addItem()
    {
        return view('artist.item');
    }

    public function getImagePath()
    {
        return '/upload/artist/images/';
    }
    public function getPublicImagePath()
    {
        return public_path() . $this->getImagePath();
    }

    public function saveItem(Request $request)
    {
        $id = $request->id;

        $filePath = "";
        if (empty($id)) {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:2000',
                'tags' => 'required|string',
                'path' => 'required',
            ]);

            $item = new Item();
            $item->user_id = Auth::user()->id;
            $item->name = $request->input('name');
            $item->description = $request->input('description');
            $item->tags = $request->input('tags');
            $item->is_active = 1;

            $item->path = $filePath;
            if ($files = $request->file('path')) {
                $directoryName = $this->getPublicImagePath();
                if (!is_dir($directoryName)) {
                    mkdir($directoryName, 0777, true);
                }

                $filePath = $request->input('name') . '_' . time() . $files->getClientOriginalName();
                $move = $files->move($directoryName, $filePath);
                if ($move) {
                    $item->path = $filePath;
                }
            }
            $save = $item->save();
            $succ = 'Item Added Successfully!';
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:2000',
                'tags' => 'required|string',
            ]);

            $item = Item::find($id);
            $item->name = $request->name;
            $item->description = $request->description;
            $item->tags = $request->tags;

            if ($files = $request->file('path')) {
                $directoryName = $this->getPublicImagePath();

                $filePath = $request->input('name') . '_' . time() . $files->getClientOriginalName();
                $move = $files->move($directoryName, $filePath);
                if ($move) {
                    $item->path = $filePath;
                }
            }
            $save = $item->save();
            $succ = 'Item Updated Successfully!';
        }

        if ($save) {
            return redirect()->back()->with('success', $succ);
        } else {
            return redirect()->back()->with('errors', 'There is some error.');
        }
    }

    public function itemList()
    {
        $user_id = Auth::user()->id;
        $items = Item::where('user_id', $user_id)->where('is_active', 1)->get();
        foreach ($items as $item) {
            if (!empty($item->path)) {
                $item->path = $this->getImagePath() . $item->path;
            }
        }
        return view('artist.itemslist', compact('items'));
    }

    public function viewItem($id)
    {
        $item = Item::find($id);
        if (!empty($item->path)) {
            $item->path = $this->getImagePath() . $item->path;
        }
        return view('artist.item', compact('item'));
    }

    public function deleteItemImage($id)
    {
        $item = Item::find($id);
        $delete = $this->UnlinkImage($this->getPublicImagePath(), $item->path);
        if ($delete) {
            $item->path = "";
            $item->save();
            $succ = 'success';
            $msg = 'Image deleted successfully!';
        } else {
            $succ = 'errors';
            $msg = 'There is some problem.';
        }
        return response()->json([
            $succ => $msg
        ]);
    }

    public function UnlinkImage($filepath, $fileName)
    {
        $old_image = $filepath . $fileName;
        if (file_exists($old_image)) {
            @unlink($old_image);
            return true;
        }
        return false;
    }

    public function deleteItem($id)
    {
        $item = Item::find($id);
        $item->is_active = 0;
        $item->is_delete = 1;
        $item->delete_at = Date('Y-m-d H:i:s');
        $item->save();
        return redirect('itemlist')->with('success', 'Deleted!');
    }
}
