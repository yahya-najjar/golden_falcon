<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ItemRequest;
use App\Models\AlbumImage;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    public function index()
    {
        $type = request()->type;
        if (!isset($type)) {
            abort(404);
        }
        $items = Item::whereType(\request()->type)->get();
        if ($type == Item::Category) {
            $items = Item::whereType(Item::Category)->withDepth()->having('depth', '=', 0)->get();
            return view('admin.items.index-table', compact('items', 'type'));
        }
        return view('admin.items.index', compact('items', 'type'));
    }

    public function create()
    {
        if (!isset(request()->type)) {
            abort(404);
        }
        $type = \request()->type;
        $parents = Item::whereType(Item::Category)->withDepth()->having('depth', '=', 0)->get();
//        return $parents;
        return view('admin.items.create-edit', compact('type', 'parents'));
    }

    public function edit(Item $item)
    {
        $type = $item->type;
        $parents = Item::whereType(Item::Category)->withDepth()->where('id', '!=', $item->id)->having('depth', '=',
            0)->get();
        return view('admin.items.create-edit', compact('item', 'type', 'parents'));
    }

    public function store(ItemRequest $request)
    {
//        return $request->all();
        $item = new Item($request->only(['link']));
        $item->type = $request->type;
        $item->date = $request->date;
        $item->colors = $request->colors;
        $item->sizes = $request->sizes;
        foreach (\Localization::getSupportedLocales() as $key => $value) {
            if ($request->get('title_' . $key)) {
                $item->translateOrNew($key)->title = $request->get('title_' . $key);
            }
            if ($request->get('content_' . $key)) {
                $item->translateOrNew($key)->content = $request->get('content_' . $key);
            }
        }
        if ($request->has('image')) {
            $item->image = $request->file('image')->store($request->type, 'public');
        }

        if (in_array($item->type, [Item::Product, Item::Category])) {
            if ($parent = $request->parent) {
                $item->parent_id = $parent;
            } else {
                $item->parent_id = null;
            }
        }

        $item->save();

        // store othe images
        if ($request->has('images')) {
            $images = array();
            foreach ($request->images as $imageR) {
                $image = new AlbumImage();
                $image->path = $imageR->store('Items/Images_' . $item->type, 'public');
                array_push($images, $image);
            }

            $item->images()->saveMany($images);
        }

        return back()->with('success', 'تم الإنشاء!');
    }

    public function update(ItemRequest $request, Item $item)
    {
        $item->link = $request->link;
        $item->date = $request->date;
        $item->colors = $request->colors;
        $item->sizes = $request->sizes;
        foreach (\Localization::getSupportedLocales() as $key => $value) {
            if ($request->get('title_' . $key)) {
                $item->translateOrNew($key)->title = $request->get('title_' . $key);
            }
            if ($request->get('content_' . $key)) {
                $item->translateOrNew($key)->content = $request->get('content_' . $key);
            }
        }
        if ($request->has('image')) {
            @unlink(storage_path('app/public/' . $item->image));
            $item->image = $request->file('image')->store($request->type, 'public');
        }

        if (in_array($item->type, [Item::Product, Item::Category])) {
            if ($parent = $request->parent) {
                $item->parent_id = $parent;
            } else {
                $item->parent_id = null;
            }
        }

        $item->save();
        return back()->with('success', 'تم التعديل!');
    }

    public function destroy(Item $item)
    {
        if (isset($item->image)) {
            $image_path = 'app/public/' . str_replace('/storage/', '', $item->image);
            @unlink(storage_path($image_path));
        }
        if (count($item->descendants)) {
            return back()->with('error', 'لايمكنك حذف هذه الفئة');
        }
        try {
            $item->delete();
        } catch (\Exception $e) {
        }
        return back()->with('success', 'تم الحذف');

    }

    public function change_status(Item $item)
    {
        return $this->set_editable($item, 'active');
    }

    public function change_home(Item $item)
    {
        return $this->set_editable($item, 'home');
    }

    public function change_registration_status(Item $item)
    {
        return $this->set_editable($item, 'registerOpen');
    }

    public function imagesForm(Item $item)
    {
        return view('admin.items.images', compact('item'));
    }

    public function storeImages(Request $request, Item $item)
    {
        $this->validate($request, [
            'images' => 'required'
        ]);
        if ($request->has('images')) {
            $images = array();
            foreach ($request->images as $imageR) {
                $image = new AlbumImage();
                $image->path = $imageR->store('Items/Images_' . $item->type, 'public');
                array_push($images, $image);
            }

            $item->images()->saveMany($images);
        }

        return back()->with('success', 'تم حفظ الصور');

    }

    public function destroyImage($id)
    {
        $image = AlbumImage::findOrFail($id);
        if (file_exists(storage_path('app/public/' . str_replace('/storage/', '', $image->path)))) {
            @unlink(storage_path('app/public/' . str_replace('/storage/', '', $image->path)));
        }

        try {
            $image->delete();
        } catch (\Exception $e) {
            return response()->json(['status' => '0', 'message' => $e->getMessage()]);
        }

        return response()->json(['status' => '1', 'message' => 'done', 'id' => $id]);
    }

    public function imageStatus($id)
    {
        $image = AlbumImage::findOrFail($id);
        return $this->set_editable($image, 'active');
    }

    public function productsByCategory(Request $request)
    {
        $type = Item::Product;
        $items = Item::whereType(Item::Product);
        if (isset($request->category)) {
            $items->where('parent_id', $request->category);
        }

        $items = $items->get();

        return view('admin.items.index', compact('type', 'items'));
    }

    public function search(Request $request)
    {
        $q = trim($request->q);
        $type = Item::Product;
        if (!$q) {
            $items = null;
            return view('admin.items.index', compact('type', 'items'));
        }
        $items = Item::whereType(Item::Product)
            ->whereHas('translations', function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%");
            })->get();

        return view('admin.items.index', compact('type', 'items'));
    }
}
