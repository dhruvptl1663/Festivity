<?php

namespace App\Http\Controllers;

use App\Models\Decorator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminDecoratorController extends Controller
{
    public function index()
    {
        $decorators = Decorator::with('events')->get();
        return view('admin.decorators.index', compact('decorators'));
    }

    public function create()
    {
        return view('admin.decorators.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'decorator_name' => 'required|string|max:100',
            'email' => 'required|email|unique:decorators,email',
            'password' => 'required|string|min:8',
            'decorator_icon' => 'nullable|image|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
            'availability' => 'required|boolean'
        ]);

        if ($request->hasFile('decorator_icon')) {
            $validated['decorator_icon'] = $request->file('decorator_icon')->store('decorators', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);

        Decorator::create($validated);

        return redirect()->route('admin.decorators.index')->with('success', 'Decorator created successfully');
    }

    public function show(Decorator $decorator)
    {
        return view('admin.decorators.show', compact('decorator'));
    }

    public function edit(Decorator $decorator)
    {
        return view('admin.decorators.edit', compact('decorator'));
    }

    public function update(Request $request, Decorator $decorator)
    {
        $validated = $request->validate([
            'decorator_name' => 'required|string|max:100',
            'email' => 'required|email|unique:decorators,email,' . $decorator->decorator_id . ',decorator_id',
            'password' => 'nullable|string|min:8',
            'decorator_icon' => 'nullable|image|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
            'availability' => 'required|boolean'
        ]);

        if ($request->hasFile('decorator_icon')) {
            if ($decorator->decorator_icon) {
                Storage::disk('public')->delete($decorator->decorator_icon);
            }
            $validated['decorator_icon'] = $request->file('decorator_icon')->store('decorators', 'public');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $decorator->update($validated);

        return redirect()->route('admin.decorators.index')->with('success', 'Decorator updated successfully');
    }

    public function destroy(Decorator $decorator)
    {
        if ($decorator->decorator_icon) {
            Storage::disk('public')->delete($decorator->decorator_icon);
        }
        $decorator->delete();

        return redirect()->route('admin.decorators.index')->with('success', 'Decorator deleted successfully');
    }
}