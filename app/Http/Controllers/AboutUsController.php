<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    //
    public function aboutus()
    {
         $abouts = About::orderBy('id', 'asc')->get();
        return view('frontend.about.index',compact('abouts'));
    }
    // SHOW ADMIN LIST
    public function list()
    {
        $abouts = About::all();
        return view('admin.about.index', compact('abouts'));
    }

    // CREATE FORM
    public function create()
    {
        return view('admin.about.create');
    }

    // STORE DATA
    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads/about'), $imageName);

        About::create([
            'heading' => $request->heading,
            'description' => $request->description,
            'image' => $imageName
        ]);

        return redirect()->route('admin.about.list')->with('success','About added');
    }

    // EDIT FORM
    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('admin.about.edit', compact('about'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $about = About::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/about'), $imageName);
            $about->image = $imageName;
        }

        $about->update([
            'heading' => $request->heading,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.about.list')->with('success','Updated successfully');
    }

    // DELETE
    public function destroy($id)
    {
        About::findOrFail($id)->delete();
        return back()->with('success','Deleted');
    }
}
