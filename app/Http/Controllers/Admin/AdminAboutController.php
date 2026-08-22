<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutPage;
use App\Models\AboutItem;


class AdminAboutController extends Controller
{
    public function index()
    {
        $about = AboutPage::with('aboutItems')
            ->first();

        return view('admin.about.index', compact('about'));
    }
    //End Method

    public function edit()
    {
        $about = AboutPage::first();

        return view('admin.about.edit', compact('about'));
    }
    // End of Method

    public function update(Request $request)
    {
        $about = AboutPage::first();

        $validated = $request->validate([
            'title' => ['required','string', 'max:255'],
            'introduction' => ['required', 'string'],
        ]);

        $about->update($validated);

        return redirect()
                ->route('admin.about.index')
                ->with('success', 'About Page updated successfully.');
    }
    //End Method

    public function editItem(AboutItem $aboutItem)
    {
        return view('admin.about.items.edit', compact('aboutItem'));
    }
    // end Method

    public function updateItem(Request $request, AboutItem $aboutItem)
    {
        $validated = $request->validate([
            'section' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'sort_order' => ['required', 'integer', 'min:1'],
        ]);

        $aboutItem->update($validated);

        return redirect()
            ->route('admin.about.index')
            ->with('success', 'About section updated successfully.');
    }
    // End of Method

    public function createItem()
    {
        return view('admin.about.items.create');
    }
    // End of Methos

    public function storeItem(Request $request)
{
    $aboutPage = AboutPage::first();

    $validated = $request->validate([
        'section' => ['required', 'string', 'max:255'],
        'content' => ['required', 'string'],
    ]);

    $nextSortOrder = $aboutPage->aboutItems()->max('sort_order') + 1;

    $aboutPage->aboutItems()->create([
        'section' => $validated['section'],
        'content' => $validated['content'],
        'sort_order' => $nextSortOrder,
    ]);

    return redirect()
        ->route('admin.about.index')
        ->with('success', 'About section created successfully.');
}
    //End of method
    public function destroyItem(AboutItem $aboutItem)
    {
        $aboutItem->delete();

        return redirect()
            ->route('admin.about.index')
            ->with('success', 'About section deleted successfully.');
    }
    // End Method

    public function moveUp(AboutItem $aboutItem)
{
    $previousItem = AboutItem::where('about_page_id', $aboutItem->about_page_id)
        ->where('sort_order', '<', $aboutItem->sort_order)
        ->orderByDesc('sort_order')
        ->first();

    if ($previousItem) {

        $currentOrder = $aboutItem->sort_order;

        $aboutItem->update([
            'sort_order' => $previousItem->sort_order
        ]);

        $previousItem->update([
            'sort_order' => $currentOrder
        ]);
    }

    return redirect()
        ->route('admin.about.index')
        ->with('success', 'About section Moved Up successfully.');;
    }
    // End Method

    public function moveDown(AboutItem $aboutItem)
{
    $nextItem = AboutItem::where('about_page_id', $aboutItem->about_page_id)
        ->where('sort_order', '>', $aboutItem->sort_order)
        ->orderBy('sort_order')
        ->first();

    if ($nextItem) {

        $currentOrder = $aboutItem->sort_order;

        $aboutItem->update([
            'sort_order' => $nextItem->sort_order
        ]);

        $nextItem->update([
            'sort_order' => $currentOrder
        ]);
    }

    return redirect()
        ->route('admin.about.index')
        ->with('success', 'About section Moved Down successfully.');;
    }
    //End Method
}
