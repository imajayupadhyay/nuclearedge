<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HomepageController extends Controller
{
    /**
     * Display homepage settings page
     */
    public function index()
    {
        $settings = HomepageSetting::all()->pluck('value', 'key')->toArray();

        // Parse tabs JSON for the form
        if (isset($settings['tabs_data'])) {
            $settings['tabs_data'] = json_decode($settings['tabs_data'], true) ?? [];
        } else {
            $settings['tabs_data'] = [];
        }

        return Inertia::render('Admin/Homepage/Index', [
            'settings' => $settings,
        ]);
    }

    /**
     * Update homepage settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            // Hero Section - Video
            'hero_video_url' => 'nullable|string|max:500',
            'hero_video_file' => 'nullable|file|mimes:mp4,webm,mov|max:102400', // 100MB max

            // Hero Section - Headlines
            'hero_headline_line1' => 'nullable|string|max:255',
            'hero_headline_line2' => 'nullable|string|max:255',
            'hero_subheadline' => 'nullable|string|max:500',

            // Hero Section - Buttons
            'hero_primary_button_text' => 'nullable|string|max:100',
            'hero_primary_button_link' => 'nullable|string|max:500',
            'hero_secondary_button_text' => 'nullable|string|max:100',
            'hero_secondary_button_link' => 'nullable|string|max:500',

            // Blog Carousel Section
            'blog_carousel_heading_line1' => 'nullable|string|max:255',
            'blog_carousel_heading_line2' => 'nullable|string|max:255',
            'blog_carousel_paragraph' => 'nullable|string|max:500',

            // Tabs Section
            'tabs_data' => 'nullable|array',
            'tabs_data.*.name' => 'required|string|max:100',
            'tabs_data.*.label' => 'nullable|string|max:100',
            'tabs_data.*.title' => 'nullable|string|max:255',
            'tabs_data.*.description' => 'nullable|string|max:1000',
            'tabs_data.*.image' => 'nullable|string|max:500',
            'tabs_data.*.link' => 'nullable|string|max:500',
            'tabs_data.*.buttonText' => 'nullable|string|max:100',
            // Tab image uploads
            'tab_images' => 'nullable|array',
            'tab_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB max

            // Featured Articles Section
            'featured_articles_label' => 'nullable|string|max:100',
            'featured_articles_heading_line1' => 'nullable|string|max:255',
            'featured_articles_heading_line2' => 'nullable|string|max:255',
            'featured_articles_paragraph' => 'nullable|string|max:500',
        ]);

        // Handle video file upload
        if ($request->hasFile('hero_video_file')) {
            // Delete old video if exists
            $oldVideo = HomepageSetting::get('hero_video_url');
            if ($oldVideo && str_starts_with($oldVideo, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $oldVideo);
                Storage::disk('public')->delete($oldPath);
            }

            // Store new video
            $path = $request->file('hero_video_file')->store('hero', 'public');
            $validated['hero_video_url'] = '/storage/' . $path;
        }

        // Save each setting
        $fields = [
            // Hero Section
            'hero_video_url',
            'hero_headline_line1',
            'hero_headline_line2',
            'hero_subheadline',
            'hero_primary_button_text',
            'hero_primary_button_link',
            'hero_secondary_button_text',
            'hero_secondary_button_link',
            // Blog Carousel Section
            'blog_carousel_heading_line1',
            'blog_carousel_heading_line2',
            'blog_carousel_paragraph',
            // Featured Articles Section
            'featured_articles_label',
            'featured_articles_heading_line1',
            'featured_articles_heading_line2',
            'featured_articles_paragraph',
        ];

        foreach ($fields as $field) {
            if (array_key_exists($field, $validated)) {
                HomepageSetting::updateOrCreate(
                    ['key' => $field],
                    [
                        'value' => $validated[$field],
                        'type' => $this->getType($field),
                        'group' => $this->getGroup($field),
                        'label' => $this->getLabel($field),
                    ]
                );
            }
        }

        // Handle tab image uploads
        $tabsData = $validated['tabs_data'] ?? [];
        if ($request->hasFile('tab_images')) {
            foreach ($request->file('tab_images') as $index => $imageFile) {
                if ($imageFile && isset($tabsData[$index])) {
                    // Store new image
                    $path = $imageFile->store('tabs', 'public');
                    $tabsData[$index]['image'] = '/storage/' . $path;
                }
            }
        }

        // Save tabs data as JSON
        if (array_key_exists('tabs_data', $validated)) {
            HomepageSetting::updateOrCreate(
                ['key' => 'tabs_data'],
                [
                    'value' => json_encode($tabsData),
                    'type' => 'json',
                    'group' => 'tabs',
                    'label' => 'Tabs Data',
                ]
            );
        }

        HomepageSetting::clearCache();

        return back()->with('success', 'Homepage settings updated successfully.');
    }

    /**
     * Get type for a field
     */
    private function getType(string $field): string
    {
        $types = [
            'hero_video_url' => 'file',
            'hero_subheadline' => 'textarea',
            'blog_carousel_paragraph' => 'textarea',
        ];

        return $types[$field] ?? 'text';
    }

    /**
     * Get group for a field
     */
    private function getGroup(string $field): string
    {
        if (str_starts_with($field, 'hero_')) {
            return 'hero';
        }
        if (str_starts_with($field, 'blog_carousel_')) {
            return 'blog_carousel';
        }
        if (str_starts_with($field, 'tabs_')) {
            return 'tabs';
        }
        if (str_starts_with($field, 'featured_articles_')) {
            return 'featured_articles';
        }
        return 'general';
    }

    /**
     * Get label for a field
     */
    private function getLabel(string $field): string
    {
        $labels = [
            'hero_video_url' => 'Background Video URL',
            'hero_headline_line1' => 'Headline Line 1',
            'hero_headline_line2' => 'Headline Line 2 (Gradient)',
            'hero_subheadline' => 'Subheadline',
            'hero_primary_button_text' => 'Primary Button Text',
            'hero_primary_button_link' => 'Primary Button Link',
            'hero_secondary_button_text' => 'Secondary Button Text',
            'hero_secondary_button_link' => 'Secondary Button Link',
            'blog_carousel_heading_line1' => 'Heading Line 1',
            'blog_carousel_heading_line2' => 'Heading Line 2 (Gradient)',
            'blog_carousel_paragraph' => 'Description Paragraph',
        ];

        return $labels[$field] ?? ucfirst(str_replace('_', ' ', $field));
    }
}
