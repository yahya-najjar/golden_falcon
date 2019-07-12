<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\CourseRegistration;
use App\Models\Item;
use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SiteController extends Controller
{
    public function welcome()
    {
//        return Item::hasProductsHomeMenu()->get();
        $slides = Item::whereType(Item::SLIDER)->active()->latest()->get();
        $categories = Item::hasProducts()->active()->home()->latest()->get();
        $featuredProducts = Item::whereType(Item::Product)->active()->home()->latest()->get();
        return view('welcome', compact('slides', 'categories', 'featuredProducts'));
    }

    public function search(Request $request)
    {
        $q = $request->q;
        $q = trim($q);
        $results = Item::whereType(-999)->paginate(12);
        if ($q) {
            $results = Item::active()->whereType(Item::Product)
                ->whereHas('translations', function ($query) use ($q) {
                    $query->where('title', 'like', "%{$q}%")
                        ->orWhere('content', 'like', "%{$q}%");
                })
//                ->join('item_translations', 'item_translations.item_id', '=', 'items.id')
//                ->where('title', 'like', "%{$q}%")
//                ->orWhere('content', 'like', "%{$q}%")
//                ->active()->whereType(Item::Product)
                ->paginate(12);
        }

        if (!count($results)) {
            abort(404);
        }

        $categories = Item::active()->hasProducts()->get();

        return view('catalog', compact('results', 'categories'));
    }

    public function contact_post(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'message' => 'required',
            'email' => 'required|email'
        ]);
        $data = $request->only(['first_name', 'last_name', 'email', 'message']);
        Mail::to($settings->email ?? 'contact@sewarKhaddaj.com')->send(new ContactMail($data));
        return back()->with('success', 'Thank you for your interest!');
    }

    public function about()
    {
        $about = Item::whereType(4)->first();
        return view('aboutUs', compact('about'));
    }

    public function product($id)
    {
        $product = Item::findOrFail($id);
        $siblings = $product->siblings()->whereType(\App\Models\Item::Product)->active()->get();
        return view('product', compact('product', 'siblings'));
    }

    public function catalog()
    {
        $results = Item::whereType(Item::Product);
        $category = null;
        if ($id = \request()->category) {
            $results = Item::findOrFail($id)->children()->whereType(Item::Product);
            $category = Item::findOrFail($id);
        }
        $results = $results->active()->paginate(12);
        $categories = Item::active()->hasProducts()->get();
        return view('catalog', compact('results', 'categories', 'category'));
    }
}
