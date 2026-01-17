<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MenuController extends Controller
{
    /**
     * Display menu management page
     */
    public function index()
    {
        $menuItems = MenuItem::getAdminTree();
        $socialLinks = SocialLink::orderBy('order')->get();
        $defaultIcons = SocialLink::getDefaultIcons();

        return Inertia::render('Admin/Menus/Index', [
            'menuItems' => $menuItems,
            'socialLinks' => $socialLinks,
            'defaultIcons' => $defaultIcons,
        ]);
    }

    /**
     * Store a new menu item
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:500',
            'icon' => 'nullable|string',
            'parent_id' => 'nullable|exists:menu_items,id',
            'open_in_new_tab' => 'boolean',
            'status' => 'boolean',
        ]);

        // Validate max 2 levels
        if (!empty($validated['parent_id'])) {
            $parent = MenuItem::find($validated['parent_id']);
            if ($parent && $parent->parent_id) {
                return back()->with('error', 'Maximum nesting level is 2. Cannot add item under a child.');
            }
        }

        // Set order to end of list at same level
        $maxOrder = MenuItem::where('parent_id', $validated['parent_id'] ?? null)->max('order') ?? -1;
        $validated['order'] = $maxOrder + 1;

        MenuItem::create($validated);

        return back()->with('success', 'Menu item created successfully.');
    }

    /**
     * Update a menu item
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:500',
            'icon' => 'nullable|string',
            'open_in_new_tab' => 'boolean',
            'status' => 'boolean',
        ]);

        $menuItem->update($validated);

        return back()->with('success', 'Menu item updated successfully.');
    }

    /**
     * Delete a menu item
     */
    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();

        return back()->with('success', 'Menu item deleted successfully.');
    }

    /**
     * Reorder menu items (for drag-and-drop)
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:menu_items,id',
            'items.*.parent_id' => 'nullable',
            'items.*.order' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($validated) {
            foreach ($validated['items'] as $item) {
                $parentId = $item['parent_id'];

                // Validate parent_id exists if not null
                if ($parentId !== null) {
                    $parent = MenuItem::find($parentId);
                    if (!$parent) {
                        throw new \Exception('Invalid parent ID.');
                    }
                    // Validate max 2 levels
                    if ($parent->parent_id) {
                        throw new \Exception('Maximum nesting level is 2.');
                    }
                }

                MenuItem::where('id', $item['id'])->update([
                    'parent_id' => $parentId,
                    'order' => $item['order'],
                ]);
            }
        });

        MenuItem::clearCache();

        return response()->json(['success' => true]);
    }

    /**
     * Store a new social link
     */
    public function storeSocialLink(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'url' => 'required|string|max:500',
            'icon' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $maxOrder = SocialLink::max('order') ?? -1;
        $validated['order'] = $maxOrder + 1;
        $validated['is_active'] = $validated['is_active'] ?? true;

        SocialLink::create($validated);

        return back()->with('success', 'Social link added successfully.');
    }

    /**
     * Update a social link
     */
    public function updateSocialLink(Request $request, SocialLink $socialLink)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'url' => 'required|string|max:500',
            'icon' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $socialLink->update($validated);

        return back()->with('success', 'Social link updated successfully.');
    }

    /**
     * Delete a social link
     */
    public function destroySocialLink(SocialLink $socialLink)
    {
        $socialLink->delete();

        return back()->with('success', 'Social link deleted successfully.');
    }

    /**
     * Reorder social links
     */
    public function reorderSocialLinks(Request $request)
    {
        $validated = $request->validate([
            'links' => 'required|array',
            'links.*.id' => 'required|exists:social_links,id',
            'links.*.order' => 'required|integer',
        ]);

        foreach ($validated['links'] as $item) {
            SocialLink::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        SocialLink::clearCache();

        return back()->with('success', 'Social links reordered successfully.');
    }
}
