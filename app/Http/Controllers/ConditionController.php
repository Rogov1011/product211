<?php

namespace App\Http\Controllers;

use App\Models\Condition;
use Illuminate\Http\Request;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("conditions.index", [
            "conditions" => Condition::all()->sortBy('name')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("conditions.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Condition::create($request->all());

        return redirect()->route("conditions.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($conditionId)
    {
        $condition = Condition::find($conditionId);
        return view('conditions.edit',[
            'condition' => $condition
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $conditionId)
    {
        $condition = Condition::find($conditionId);
        $condition -> update($request->all());//update
        return redirect()->route("conditions.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Condition $condition)
    {
        $condition->delete();
        return back();
    }
}
