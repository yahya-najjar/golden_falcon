<?php

namespace App\Http\Controllers\Admin;

use App\Models\CustomField;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomFieldController extends Controller
{
    public function index()
    {
        if (!isset(request()->type)) {
            abort(404);
        }
        $type = \request()->type;
        $fields = CustomField::whereType(\request()->type)->get();
        return view('admin.custom_fields.index', compact('fields', 'type'));
    }

    public function create()
    {
        if (!isset(request()->type)) {
            abort(404);
        }
        $type = \request()->type;
        return view('admin.custom_fields.create-edit', compact('type'));
    }

    public function edit($id)
    {
        $field = CustomField::findOrFail($id);
        $type = $field->type;
        return view('admin.custom_fields.create-edit', compact('type', 'field'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'value' => 'required',
            'type' => 'required',
        ]);

        CustomField::create($request->all());

        return back()->with('success', 'تم الإنشاء');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'value' => 'required',
            'type' => 'required',
        ]);

        $field = CustomField::findOrFail($id);

        $field->update($request->all());

        return back()->with('success', 'تم التعديل');
    }

    public function destroy($id)
    {
        $field = CustomField::findOrFail($id);

        $field->delete();

        return back()->with('success', 'تم الحذف');
    }
}
