<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dataset;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'rows' => 'required|numeric',
            'cols' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'column_names' => 'required|array|min:1',
            'column_types' => 'required|array|min:1',
            'column_names.*' => 'required|string|max:255',
            'column_types.*' => 'required|string|max:255',
        ]);

        $path = $request->file('image')->store('images', 'public');

        $columns = [];
        foreach ($request->column_names as $index => $name) {
            $columns[] = [
                'name' => $name,
                'type' => $request->column_types[$index],
            ];
        }

        $dataset = new Dataset();
        $dataset->name = $validated['name'];
        $dataset->price = $validated['price'];
        $dataset->description = $validated['description'];
        $dataset->num_rows = $validated['rows'];
        $dataset->num_cols = $validated['cols'];
        $dataset->preview_img_path = $path;
        $dataset->is_complete = $request->has('complete');
        $dataset->sellerid = Auth::id();
        $dataset->attributes = $columns;
        $dataset->save();


        return back()->with('success', 'Tábla sikeresen feltöltve!')->with('path', $path);
    }
}
