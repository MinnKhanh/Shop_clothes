<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Models\Categories;
use App\Models\Img;
use App\Models\Products;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    public function getListType(Request $request)
    {
        $data = [];
        if ($request->input('q')) {
            $data = Type::where('name', 'like', '%' . $request->get('q') . '%')->get()->toArray();
        } else {
            $data = Type::get()->toArray();
        }
        return $data;
    }
    public function create(Request $request)
    {
        $typenav = Type::with('Img', 'Categories')->withCount('Product')
            ->get()->toArray();
        return view('admin.types.createorupdate', ['typenav' => $typenav]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => $request->input('id') ? ['required', Rule::unique('type', 'name')->ignore($request->input('id'))] : ['required', Rule::unique('type', 'name')],
            'photo.*' => $request->input('id') ? '' : ['required', 'image'],
        ]);
        $type = new Type();
        if ($request->file('photo')) {
            $logo = optional($request->file('photo'))->store('public/type_img');
            $logo = str_replace("public/", "", $logo);
        }
        if ($request->input('id')) {
            $type = Type::where('id', $request->input('id'))->first();
            Img::where('product_id', $request->input('id'))->where('type', 3)->where('img_index', 1)->update([
                'path' => $logo,
            ]);
            $type->name = $request->input('name');
            $type->save();
        } else {
            $type->name = $request->input('name');
            $type->save();
            Img::create([
                'product_id' => $type->id,
                'path' => $logo,
                'type' => 3,
                'img_index' => 1
            ]);
        }
        return redirect()->route('admin.type.index');
    }
    public function index(Request $request)
    {
        $typenav = Type::with('Img', 'Categories')->withCount('Product')
            ->get()->toArray();
        //  dd(Products::join('categories', 'categories.id', 'products.category')->where('categories.type', 2)->count());
        return view('admin.types.index', ['typenav' => $typenav]);
    }
    public function update(Request $request)
    {
        $typenav = Type::with('Img', 'Categories')->withCount('Product')
            ->get()->toArray();
        $type  = $typenav[array_search($request->input('id'), array_column($typenav, 'id'))];
        return view('admin.types.createorupdate', ['idtype' => $request->input('id'), 'typenav' => $typenav, 'type' => $type, 'isedit' => 1]);
    }
    public function delete(Request $request)
    {
        if ($request->input('id')) {
            if (Products::join('categories', 'categories.id', 'products.category')->where('categories.type', $request->input('id'))->count()) {
                return response()->json(['error' => 'Hiện còn sản phẩm trong kho thuộc loại này không thể xóa'], 400);
            } else {
                Type::where('id', $request->input('id'))->delete();
                Categories::where('type', $request->input('id'))->delete();
                Img::whereIn('type', [3, 4])->where('product_id', $request->input('id'))->delete();
                return response()->json(['success' => 'Xóa thành công'], 200);
            }
        }
    }
}
