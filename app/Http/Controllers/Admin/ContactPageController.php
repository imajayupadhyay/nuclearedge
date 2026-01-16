<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactPageSetting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactPageController extends Controller
{
    /**
     * Display contact page settings
     */
    public function index()
    {
        $settings = ContactPageSetting::all()->pluck('value', 'key')->toArray();

        return Inertia::render('Admin/ContactPage/Index', [
            'settings' => $settings,
        ]);
    }

    /**
     * Update contact page settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            // Hero Section
            'hero_label' => 'nullable|string|max:100',
            'hero_headline_line1' => 'nullable|string|max:255',
            'hero_headline_line2' => 'nullable|string|max:255',
            'hero_paragraph' => 'nullable|string|max:500',

            // Contact Info Section
            'contact_email' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'contact_address_line1' => 'nullable|string|max:255',
            'contact_address_line2' => 'nullable|string|max:255',

            // Form Section
            'form_heading_line1' => 'nullable|string|max:255',
            'form_heading_line2' => 'nullable|string|max:255',
            'form_description' => 'nullable|string|max:500',

            // Map Section
            'map_heading_line1' => 'nullable|string|max:255',
            'map_heading_line2' => 'nullable|string|max:255',
            'map_description' => 'nullable|string|max:500',
            'map_embed_url' => 'nullable|string|max:1000',
            'map_overlay_title' => 'nullable|string|max:255',
            'map_overlay_subtitle' => 'nullable|string|max:255',

            // CTA Section
            'cta_heading_line1' => 'nullable|string|max:255',
            'cta_heading_line2' => 'nullable|string|max:255',
            'cta_paragraph' => 'nullable|string|max:500',
            'cta_button_text' => 'nullable|string|max:100',
            'cta_button_link' => 'nullable|string|max:500',
        ]);

        $fields = [
            // Hero Section
            'hero_label',
            'hero_headline_line1',
            'hero_headline_line2',
            'hero_paragraph',
            // Contact Info Section
            'contact_email',
            'contact_phone',
            'contact_address_line1',
            'contact_address_line2',
            // Form Section
            'form_heading_line1',
            'form_heading_line2',
            'form_description',
            // Map Section
            'map_heading_line1',
            'map_heading_line2',
            'map_description',
            'map_embed_url',
            'map_overlay_title',
            'map_overlay_subtitle',
            // CTA Section
            'cta_heading_line1',
            'cta_heading_line2',
            'cta_paragraph',
            'cta_button_text',
            'cta_button_link',
        ];

        foreach ($fields as $field) {
            if (array_key_exists($field, $validated)) {
                ContactPageSetting::updateOrCreate(
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

        ContactPageSetting::clearCache();

        return back()->with('success', 'Contact page settings updated successfully.');
    }

    /**
     * Get group for a field
     */
    private function getGroup(string $field): string
    {
        if (str_starts_with($field, 'hero_')) {
            return 'hero';
        }
        if (str_starts_with($field, 'contact_')) {
            return 'contact_info';
        }
        if (str_starts_with($field, 'form_')) {
            return 'form';
        }
        if (str_starts_with($field, 'map_')) {
            return 'map';
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
        $labels = [
            'hero_label' => 'Hero Label',
            'hero_headline_line1' => 'Hero Headline Line 1',
            'hero_headline_line2' => 'Hero Headline Line 2',
            'hero_paragraph' => 'Hero Paragraph',
            'contact_email' => 'Email Address',
            'contact_phone' => 'Phone Number',
            'contact_address_line1' => 'Address Line 1',
            'contact_address_line2' => 'Address Line 2',
            'form_heading_line1' => 'Form Heading Line 1',
            'form_heading_line2' => 'Form Heading Line 2',
            'form_description' => 'Form Description',
            'map_heading_line1' => 'Map Heading Line 1',
            'map_heading_line2' => 'Map Heading Line 2',
            'map_description' => 'Map Description',
            'map_embed_url' => 'Google Maps Embed URL',
            'map_overlay_title' => 'Map Overlay Title',
            'map_overlay_subtitle' => 'Map Overlay Subtitle',
            'cta_heading_line1' => 'CTA Heading Line 1',
            'cta_heading_line2' => 'CTA Heading Line 2',
            'cta_paragraph' => 'CTA Paragraph',
            'cta_button_text' => 'CTA Button Text',
            'cta_button_link' => 'CTA Button Link',
        ];

        return $labels[$field] ?? ucfirst(str_replace('_', ' ', $field));
    }
}
