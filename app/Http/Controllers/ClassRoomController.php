<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;

/**
 * Class ClassRoomController
 * @package App\Http\Controllers
 */
class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classRooms = ClassRoom::paginate();

        return view('class-room.index', compact('classRooms'))
            ->with('i', (request()->input('page', 1) - 1) * $classRooms->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classRoom = new ClassRoom();
        return view('class-room.create', compact('classRoom'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ClassRoom::$rules);

        $classRoom = ClassRoom::create($request->all());

        return redirect()->route('admin.class-rooms.index')
            ->with('success', 'ClassRoom created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classRoom = ClassRoom::find($id);

        return view('class-room.show', compact('classRoom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classRoom = ClassRoom::find($id);

        return view('class-room.edit', compact('classRoom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ClassRoom $classRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassRoom $classRoom)
    {
        request()->validate(ClassRoom::$rules);

        $classRoom->update($request->all());

        return redirect()->route('admin.class-rooms.index')
            ->with('success', 'ClassRoom updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $classRoom = ClassRoom::find($id)->delete();

        return redirect()->route('admin.class-rooms.index')
            ->with('success', 'ClassRoom deleted successfully');
    }
}