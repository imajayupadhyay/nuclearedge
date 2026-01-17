<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuccessStoriesPageSetting;
use App\Models\SuccessStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SuccessStoriesPageController extends Controller
{
    /**
     * Display success stories page settings
     */
    public function index()
    {
        $settings = SuccessStoriesPageSetting::all()->pluck('value', 'key')->toArray();
        $stories = SuccessStory::orderBy('order')->get();

        return Inertia::render('Admin/SuccessStoriesPage/Index', [
            'settings' => $settings,
            'stories' => $stories,
        ]);
    }

    /**
     * Update success stories page settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            // Hero Section
            'hero_label' => 'nullable|string|max:100',
            'hero_headline_line1' => 'nullable|string|max:255',
            'hero_headline_line2' => 'nullable|string|max:255',
            'hero_paragraph' => 'nullable|string|max:500',

            // CTA Section
            'cta_heading_line1' => 'nullable|string|max:255',
            'cta_heading_line2' => 'nullable|string|max:255',
            'cta_paragraph' => 'nullable|string|max:500',
            'cta_primary_button_text' => 'nullable|string|max:100',
            'cta_primary_button_link' => 'nullable|string|max:500',
            'cta_secondary_button_text' => 'nullable|string|max:100',
            'cta_secondary_button_link' => 'nullable|string|max:500',
        ]);

        $fields = array_keys($validated);

        foreach ($fields as $field) {
            if (array_key_exists($field, $validated)) {
                SuccessStoriesPageSetting::updateOrCreate(
                    ['key' => $field],
                    [
                        'value' => $validated[$field],
                        'type' => 'text',
                        'group' => $this->getGroup($field),
                        'label' => $this->getLabel($field),
                    ]
                );
            }
        }

        SuccessStoriesPageSetting::clearCache();

        return back()->with('success', 'Success stories page settings updated successfully.');
    }

    /**
     * Store a new success story
     */
    public function storeStory(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'industry' => 'required|string|max:100',
            'tagline' => 'required|string|max:255',
            'image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB max
            'stat1_value' => 'nullable|string|max:50',
            'stat1_label' => 'nullable|string|max:100',
            'stat2_value' => 'nullable|string|max:50',
            'stat2_label' => 'nullable|string|max:100',
            'stat3_value' => 'nullable|string|max:50',
            'stat3_label' => 'nullable|string|max:100',
            'challenge' => 'required|string|max:2000',
            'solution' => 'required|string|max:2000',
            'outcome' => 'required|string|max:2000',
            'takeaway' => 'required|string|max:1000',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        // Handle image file upload
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('success-stories', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        // Remove image_file from validated data before creating
        unset($validated['image_file']);

        $validated['order'] = $validated['order'] ?? SuccessStory::max('order') + 1;
        $validated['is_active'] = $validated['is_active'] ?? true;

        SuccessStory::create($validated);

        return back()->with('success', 'Success story added successfully.');
    }

    /**
     * Update an existing success story
     */
    public function updateStory(Request $request, SuccessStory $story)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'industry' => 'required|string|max:100',
            'tagline' => 'required|string|max:255',
            'image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB max
            'stat1_value' => 'nullable|string|max:50',
            'stat1_label' => 'nullable|string|max:100',
            'stat2_value' => 'nullable|string|max:50',
            'stat2_label' => 'nullable|string|max:100',
            'stat3_value' => 'nullable|string|max:50',
            'stat3_label' => 'nullable|string|max:100',
            'challenge' => 'required|string|max:2000',
            'solution' => 'required|string|max:2000',
            'outcome' => 'required|string|max:2000',
            'takeaway' => 'required|string|max:1000',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        // Handle image file upload
        if ($request->hasFile('image_file')) {
            // Delete old image if it exists and is stored in our storage
            if ($story->image && str_starts_with($story->image, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $story->image);
                Storage::disk('public')->delete($oldPath);
            }

            // Store new image
            $path = $request->file('image_file')->store('success-stories', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        // Remove image_file from validated data before updating
        unset($validated['image_file']);

        $story->update($validated);

        return back()->with('success', 'Success story updated successfully.');
    }

    /**
     * Delete a success story
     */
    public function destroyStory(SuccessStory $story)
    {
        $story->delete();

        return back()->with('success', 'Success story deleted successfully.');
    }

    /**
     * Reorder success stories
     */
    public function reorderStories(Request $request)
    {
        $validated = $request->validate([
            'stories' => 'required|array',
            'stories.*.id' => 'required|exists:success_stories,id',
            'stories.*.order' => 'required|integer',
        ]);

        foreach ($validated['stories'] as $item) {
            SuccessStory::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        SuccessStoriesPageSetting::clearCache();

        return back()->with('success', 'Stories reordered successfully.');
    }

    /**
     * Get group for a field
     */
    private function getGroup(string $field): string
    {
        if (str_starts_with($field, 'hero_')) {
            return 'hero';
        }
        if (str_starts_with($field, 'cta_')) {
            return 'cta';
        }
        return 'general';
    }

    /**
     * Get label for a field
     */
    private function getLabel(string $field): string
    {
        return ucwords(str_replace('_', ' ', $field));
    }
}
