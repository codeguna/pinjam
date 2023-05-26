<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\StudentParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class ParentController
 * @package App\Http\Controllers
 */
class StudentParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents = StudentParent::paginate();

        return view('parent.index', compact('parents'))
            ->with('i', (request()->input('page', 1) - 1) * $parents->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent = new StudentParent();
        return view('parent.create', compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(StudentParent::$rules);

        $parent = StudentParent::create($request->all());

        return redirect()->route('admin.parents.index')
            ->with('success', 'Parent created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parent = StudentParent::find($id);

        return view('parent.show', compact('parent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parent = Parent::find($id);

        return view('parent.edit', compact('parent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Parent $parent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parent $parent)
    {
        request()->validate(StudentParent::$rules);

        $parent->update($request->all());

        return redirect()->route('admin.parents.index')
            ->with('success', 'Parent updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $parent = Parent::find($id)->delete();

        return redirect()->route('admin.parents.index')
            ->with('success', 'Parent deleted successfully');
    }

    public function getProfile($id)
    {
        $parents        = StudentParent::where('user_id', $id)->first();
        $students       = Student::where('parent_id', $parents->id)->first();
        $classRooms     = ClassRoom::pluck('id', 'name');

        return view('parent.update-profile', compact('parents', 'students', 'classRooms'));
    }

    public function updateProfile(Request $request)
    {
        $parentId               = $request->parent_id;
        $id                     = Auth::user()->id;
        // Update field for Students
        $nim                    = $request->nim;
        $name                   = $request->name;
        $studentAddress         = $request->studentAddress;
        $class_id               = $request->class_id;
        // Update field for Student Parents
        $mobile                 = $request->mobile;
        $occupation             = $request->occupation;
        $address                = $request->address;


        $students               = Student::find($parentId);
        $students->nim          = ($nim);
        $students->class_id     = ($class_id);
        $students->address      = ($studentAddress);
        $students->name         = ($name);
        $students->update();

        $parents                = StudentParent::where('user_id', $id)->first();
        $parents->mobile        = ($mobile);
        $parents->occupation    = ($occupation);
        $parents->address       = ($address);
        $parents->update();

        return redirect()->back()
            ->with('success', 'Profil pengguna berhasil diperbarui');
    }
}
