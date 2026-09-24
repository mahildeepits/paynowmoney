<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{
    public function index(Request $request){
        $editCourse = null;
        if($request->has('edit')){
            $editCourse = Course::find($request->edit)->first();
        }
        $courses = Course::all();
        return view('admin.courses.index', compact('courses', 'editCourse'));
    }

    public function save(Request $request){
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        if($request->has('id')){
            $course = Course::find($request->id);
        }else{
            $course = new Course;
        }
        // Create new course instance
        $course->code = $request->input('code');
        $course->name = $request->input('name');
        $course->slug = strtolower($request->input('code').'-'.$request->input('name'));
        $course->price = $request->input('price');
        $course->duration = $request->input('duration');
        $course->description = $request->input('description');
        $course->image = $imageName; // Save image name

        // Save the course details
        $course->save();
        if($request->has('id')){
            // Redirect with success message
            return redirect()->route('admin.courses')->with('success', 'Success|Course saved successfully!');
        }else{
            return redirect()->back()->with('success', 'Success|Course saved successfully!');
        }
    }

    public function delete(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->back()->with('success', 'Success|Course deleted successfully!');
    }

    // Student Methods
    public function viewCourses(){
        $courses = Course::all();
        return view('courses.index',compact('courses'));
    }

    public function myCourses(){
        $courses = Auth::guard('member')->user();
        return view('courses.my-courses');
    }

}
