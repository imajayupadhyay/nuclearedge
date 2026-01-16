<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPageSetting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutPageController extends Controller
{
    /**
     * Display about page settings
     */
    public function index()
    {
        $settings = AboutPageSetting::all()->pluck('value', 'key')->toArray();

        return Inertia::render('Admin/AboutPage/Index', [
            'settings' => $settings,
        ]);
    }

    /**
     * Update about page settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            // Hero Section
            'hero_label' => 'nullable|string|max:100',
            'hero_headline_line1' => 'nullable|string|max:255',
            'hero_headline_line2' => 'nullable|string|max:255',
            'hero_paragraph' => 'nullable|string|max:500',

            // Intro Section
            'intro_heading_line1' => 'nullable|string|max:255',
            'intro_heading_line2' => 'nullable|string|max:255',
            'intro_paragraph' => 'nullable|string|max:1000',
            'intro_stat1_value' => 'nullable|string|max:50',
            'intro_stat1_label' => 'nullable|string|max:100',
            'intro_stat2_value' => 'nullable|string|max:50',
            'intro_stat2_label' => 'nullable|string|max:100',
            'intro_stat3_value' => 'nullable|string|max:50',
            'intro_stat3_label' => 'nullable|string|max:100',

            // Journey Section
            'journey_label' => 'nullable|string|max:100',
            'journey_heading_line1' => 'nullable|string|max:255',
            'journey_heading_line2' => 'nullable|string|max:255',
            'journey_start_year' => 'nullable|string|max:10',
            'journey_end_year' => 'nullable|string|max:10',
            'journey_paragraph1' => 'nullable|string|max:1000',
            'journey_paragraph2' => 'nullable|string|max:1000',

            // Excellence Section
            'excellence_label' => 'nullable|string|max:100',
            'excellence_heading_line1' => 'nullable|string|max:255',
            'excellence_heading_line2' => 'nullable|string|max:255',
            'excellence_paragraph1' => 'nullable|string|max:1000',
            'excellence_paragraph2' => 'nullable|string|max:1000',
            'excellence_feature1_title' => 'nullable|string|max:100',
            'excellence_feature1_desc' => 'nullable|string|max:255',
            'excellence_feature2_title' => 'nullable|string|max:100',
            'excellence_feature2_desc' => 'nullable|string|max:255',
            'excellence_feature3_title' => 'nullable|string|max:100',
            'excellence_feature3_desc' => 'nullable|string|max:255',
            'excellence_badge_value' => 'nullable|string|max:50',
            'excellence_badge_label' => 'nullable|string|max:100',

            // Vision/CTA Section
            'vision_label' => 'nullable|string|max:100',
            'vision_heading_line1' => 'nullable|string|max:255',
            'vision_heading_line2' => 'nullable|string|max:255',
            'vision_paragraph' => 'nullable|string|max:1000',
            'vision_primary_button_text' => 'nullable|string|max:100',
            'vision_primary_button_link' => 'nullable|string|max:500',
            'vision_secondary_button_text' => 'nullable|string|max:100',
            'vision_secondary_button_link' => 'nullable|string|max:500',
        ]);

        $fields = array_keys($validated);

        foreach ($fields as $field) {
            if (array_key_exists($field, $validated)) {
                AboutPageSetting::updateOrCreate(
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

        AboutPageSetting::clearCache();

        return back()->with('success', 'About page settings updated successfully.');
    }

    /**
     * Get group for a field
     */
    private function getGroup(string $field): string
    {
        if (str_starts_with($field, 'hero_')) {
            return 'hero';
        }
        if (str_starts_with($field, 'intro_')) {
            return 'intro';
        }
        if (str_starts_with($field, 'journey_')) {
            return 'journey';
        }
        if (str_starts_with($field, 'excellence_')) {
            return 'excellence';
        }
        if (str_starts_with($field, 'vision_')) {
            return 'vision';
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
