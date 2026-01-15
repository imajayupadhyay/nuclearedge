<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FooterController extends Controller
{
    /**
     * Display footer settings page
     */
    public function index()
    {
        $settings = FooterSetting::all()->pluck('value', 'key')->toArray();

        // Parse JSON fields for the form
        if (isset($settings['quick_links'])) {
            $settings['quick_links'] = json_decode($settings['quick_links'], true) ?? [];
        } else {
            $settings['quick_links'] = [];
        }

        if (isset($settings['social_links'])) {
            $settings['social_links'] = json_decode($settings['social_links'], true) ?? [];
        } else {
            $settings['social_links'] = [];
        }

        return Inertia::render('Admin/Footer/Index', [
            'settings' => $settings,
        ]);
    }

    /**
     * Update footer settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            // Branding
            'logo_url' => 'nullable|string|max:500',
            'heading_line1' => 'nullable|string|max:255',
            'heading_line2' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',

            // Contact
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',

            // Social Links
            'social_links' => 'nullable|array',
            'social_links.*.platform' => 'required|string',
            'social_links.*.url' => 'nullable|string|max:500',

            // Quick Links
            'quick_links' => 'nullable|array',
            'quick_links.*.name' => 'required|string|max:100',
            'quick_links.*.url' => 'required|string|max:500',

            // Copyright
            'copyright_text' => 'nullable|string|max:500',
            'copyright_tagline' => 'nullable|string|max:255',
        ]);

        // Save each setting
        $simpleFields = [
            'logo_url',
            'heading_line1',
            'heading_line2',
            'description',
            'address',
            'phone',
            'email',
            'copyright_text',
            'copyright_tagline',
        ];

        foreach ($simpleFields as $field) {
            if (array_key_exists($field, $validated)) {
                FooterSetting::updateOrCreate(
                    ['key' => $field],
                    [
                        'value' => $validated[$field],
                        'type' => in_array($field, ['description', 'address']) ? 'textarea' : 'text',
                        'group' => $this->getGroup($field),
                        'label' => $this->getLabel($field),
                    ]
                );
            }
        }

        // Save JSON fields
        if (array_key_exists('quick_links', $validated)) {
            FooterSetting::updateOrCreate(
                ['key' => 'quick_links'],
                [
                    'value' => json_encode($validated['quick_links'] ?? []),
                    'type' => 'json',
                    'group' => 'links',
                    'label' => 'Quick Links',
                ]
            );
        }

        if (array_key_exists('social_links', $validated)) {
            FooterSetting::updateOrCreate(
                ['key' => 'social_links'],
                [
                    'value' => json_encode($validated['social_links'] ?? []),
                    'type' => 'json',
                    'group' => 'social',
                    'label' => 'Social Links',
                ]
            );
        }

        FooterSetting::clearCache();

        return back()->with('success', 'Footer settings updated successfully.');
    }

    /**
     * Get group for a field
     */
    private function getGroup(string $field): string
    {
        $groups = [
            'logo_url' => 'branding',
            'heading_line1' => 'branding',
            'heading_line2' => 'branding',
            'description' => 'branding',
            'address' => 'contact',
            'phone' => 'contact',
            'email' => 'contact',
            'copyright_text' => 'copyright',
            'copyright_tagline' => 'copyright',
        ];

        return $groups[$field] ?? 'general';
    }

    /**
     * Get label for a field
     */
    private function getLabel(string $field): string
    {
        $labels = [
            'logo_url' => 'Logo URL',
            'heading_line1' => 'Heading Line 1',
            'heading_line2' => 'Heading Line 2 (Gradient)',
            'description' => 'Description',
            'address' => 'Address',
            'phone' => 'Phone Number',
            'email' => 'Email Address',
            'copyright_text' => 'Copyright Text',
            'copyright_tagline' => 'Tagline',
        ];

        return $labels[$field] ?? ucfirst(str_replace('_', ' ', $field));
    }
}
