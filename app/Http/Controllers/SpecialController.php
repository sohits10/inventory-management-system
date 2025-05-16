<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecialRequest;
use App\Models\Special;
use App\Services\SpecialService;
use Illuminate\Http\Request;
use App\Models\Item;

class SpecialController extends Controller
{
    protected $specialService;

    public function __construct(SpecialService $specialService)
    {
        $this->specialService = $specialService;
    }

    // Display all specials
    public function index()
    {
        $specials = $this->specialService->getAllSpecials();
        // dd($specials);
        return view('admin.specials.index', compact('specials'));
    }

    // Show form for creating a new special
    public function create()
    {
        $data['items'] =  Item::all();
        return view('admin.specials.create',$data);
    }

    // Store a newly created special
    public function store(SpecialRequest $request)
    {
        // dd($request->all());
        $this->specialService->createSpecial($request->validated());
        return redirect()->route('specials.index')->with('success', 'Special created successfully.');
    }

    // Show form for editing a special
    public function edit(Special $special)
    {
        return view('specials.edit', compact('special'));
    }

    // Update the special
    public function update(SpecialRequest $request, Special $special)
    {
        $this->specialService->updateSpecial($special, $request->validated());
        return redirect()->route('specials.index')->with('success', 'Special updated successfully.');
    }

    // Delete the special
    public function destroy(Special $special)
    {
        $this->specialService->deleteSpecial($special);
        return redirect()->route('specials.index')->with('success', 'Special deleted successfully.');
    }
}
