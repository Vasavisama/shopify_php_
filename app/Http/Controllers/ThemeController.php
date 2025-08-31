<?php

namespace App\Http\Controllers;

use App\Events\ThemeUpdated;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $themes = Theme::latest()->paginate(10);
        return view('admin.themes.index', compact('themes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.themes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'background_color' => 'required|string|size:7', // basic hex color validation
            'font_style' => 'required|string|in:serif,sans-serif,monospace',
            'font_color' => 'required|string|size:7', // basic hex color validation
            'font_size' => 'required|string|in:small,medium,large',
            'logo' => 'nullable|image|max:2048',
            'custom_css' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')->store('logos', 'public');
        }

        $theme = Theme::create($validated);

        event(new ThemeUpdated($theme));

        return redirect()->route('admin.themes.index')->with('success', 'Theme created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Theme $theme)
    {
        // Not used for this CRUD
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Theme $theme)
    {
        return view('admin.themes.edit', compact('theme'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Theme $theme)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'background_color' => 'required|string|size:7',
            'font_style' => 'required|string|in:serif,sans-serif,monospace',
            'font_color' => 'required|string|size:7',
            'font_size' => 'required|string|in:small,medium,large',
            'logo' => 'nullable|image|max:2048',
            'custom_css' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo if it exists
            if ($theme->logo_path) {
                Storage::disk('public')->delete($theme->logo_path);
            }
            $validated['logo_path'] = $request->file('logo')->store('logos', 'public');
        }

        $theme->update($validated);

        event(new ThemeUpdated($theme));

        return redirect()->route('admin.themes.index')->with('success', 'Theme updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theme $theme)
    {
        if ($theme->logo_path) {
            Storage::disk('public')->delete($theme->logo_path);
        }

        $theme->delete();

        return redirect()->route('admin.themes.index')->with('success', 'Theme deleted successfully.');
    }
}
