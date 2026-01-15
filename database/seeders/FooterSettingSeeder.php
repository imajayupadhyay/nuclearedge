<?php

namespace Database\Seeders;

use App\Models\FooterSetting;
use Illuminate\Database\Seeder;

class FooterSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing settings
        FooterSetting::truncate();

        $settings = [
            // Branding
            [
                'key' => 'logo_url',
                'value' => '/images/nuclear-edge-logo.webp',
                'type' => 'text',
                'group' => 'branding',
                'label' => 'Logo URL',
                'order' => 1,
            ],
            [
                'key' => 'heading_line1',
                'value' => 'From Problems to Progress:',
                'type' => 'text',
                'group' => 'branding',
                'label' => 'Heading Line 1',
                'order' => 2,
            ],
            [
                'key' => 'heading_line2',
                'value' => 'Your Partner in Growth',
                'type' => 'text',
                'group' => 'branding',
                'label' => 'Heading Line 2 (Gradient)',
                'order' => 3,
            ],
            [
                'key' => 'description',
                'value' => 'Join our newsletter to stay updated with the latest insights, innovations, and success stories.',
                'type' => 'textarea',
                'group' => 'branding',
                'label' => 'Description',
                'order' => 4,
            ],

            // Contact
            [
                'key' => 'address',
                'value' => "1195 Salarpuriya IndiraNagar\nBangalore 560038",
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'Address',
                'order' => 1,
            ],
            [
                'key' => 'phone',
                'value' => '+91 9315946467',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Phone Number',
                'order' => 2,
            ],
            [
                'key' => 'email',
                'value' => 'contact@nuclearedge.com',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Email Address',
                'order' => 3,
            ],

            // Quick Links
            [
                'key' => 'quick_links',
                'value' => json_encode([
                    ['name' => 'Home', 'url' => '/'],
                    ['name' => 'About Us', 'url' => '/about'],
                    ['name' => 'Blog', 'url' => '/blog'],
                    ['name' => 'Success Stories', 'url' => '/success-stories'],
                    ['name' => 'Contact', 'url' => '/contact'],
                ]),
                'type' => 'json',
                'group' => 'links',
                'label' => 'Quick Links',
                'order' => 1,
            ],

            // Social Links
            [
                'key' => 'social_links',
                'value' => json_encode([
                    ['platform' => 'linkedin', 'url' => 'https://linkedin.com/company/nuclearedge'],
                    ['platform' => 'twitter', 'url' => 'https://twitter.com/nuclearedge'],
                    ['platform' => 'facebook', 'url' => 'https://facebook.com/nuclearedge'],
                    ['platform' => 'instagram', 'url' => 'https://instagram.com/nuclearedge'],
                ]),
                'type' => 'json',
                'group' => 'social',
                'label' => 'Social Links',
                'order' => 1,
            ],

            // Copyright
            [
                'key' => 'copyright_text',
                'value' => 'NuclearEdge',
                'type' => 'text',
                'group' => 'copyright',
                'label' => 'Copyright Text',
                'order' => 1,
            ],
            [
                'key' => 'copyright_tagline',
                'value' => 'Built with nuclear precision and innovative excellence',
                'type' => 'text',
                'group' => 'copyright',
                'label' => 'Tagline',
                'order' => 2,
            ],
        ];

        foreach ($settings as $setting) {
            FooterSetting::create($setting);
        }

        // Clear the cache after seeding
        FooterSetting::clearCache();

        $this->command->info('Footer settings seeded successfully!');
        $this->command->info('Created ' . FooterSetting::count() . ' footer settings.');
    }
}
