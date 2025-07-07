<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TypeController extends Controller
{
    public function index()
    {
        $title = 'Jenis Layanan';
        $search = request()->get('search', '');
        $collection = Type::where('name', 'like', '%' . $search . '%')
            ->orWhere('slug', 'like', '%' . $search . '%')
            ->paginate(10);


        return view('admin.type.index', compact('collection', 'title'));
    }

    public function edit(Type $type)
    {
        $title = 'Edit Jenis Layanan';
        $item = $type; // Assuming you meant to use $item instead of $type
        return view('admin.type.edit', compact('item', 'title'));
    }

    public function update(Request $request, Type $type)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'slug' => 'required|string|max:255|unique:types,slug,' . $type->id,
        //     'banner' => 'nullable|image|mimes:jpg,jpeg,png',
        //     'terms_and_conditions' => 'required|string',
        //     'moreDetails' => 'nullable|array',
        // ]);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:types,slug,' . $type->id,
            'banner' => 'nullable|image|mimes:jpg,jpeg,png',
            'terms_and_conditions' => 'required|string',
            'moreDetails' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $payload = $request->only(
            'name',
            'slug',
            'terms_and_conditions',
            'moreDetails'
        );

        // Convert 'moreDetails' to JSON if it's provided
        if ($request->has('moreDetails')) {
            $payload['moreDetails'] = json_decode($request->input('moreDetails'));
        }

        // Handle file upload if a new banner is provided
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/'), $filename);
            $payload['banner'] = $filename;
        } else {
            // Keep the existing banner if no new file is uploaded
            $payload['banner'] = $type->banner;
        }

        $type->update($payload);

        return redirect()->route('type.index')->with('success', 'Jenis layanan berhasil diperbarui.');
    }
}
