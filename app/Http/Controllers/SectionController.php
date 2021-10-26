<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequset;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:الاقسام|اضافة قسم|تعديل قسم|حذف قسم', ['only' => ['index', 'store']]);
        $this->middleware('permission:اضافة قسم', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل قسم', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف قسم', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $sections = Section::all();
        return view('sections.sections', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(SectionRequset $request)
    {

        $sections = Section::create([
            "section_name" => $request->section_name,
            "description" => $request->description,
            "created_by" => (Auth::user()->name),
        ]);
        return redirect()->back()->with('Add', 'تم اضافة القسم بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param Section $section
     * @return Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Section $section
     * @return Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Section $section
     * @return Response
     */
    public function update(SectionRequset $request, Section $section)
    {
        $sections = Section::findOrFail($request->id);
        $sections->update([
            "section_name" => $request->section_name,
            "description" => $request->description,
        ]);


        return redirect()->back()->with('edit', 'تم تعديل القسم بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Section $section
     * @return Response
     */
    public function destroy(Section $section)
    {
        $section->destroy($section->id);
        return redirect()->back()->with('delete', 'تم حذف القسم بنجاح');

    }
}
