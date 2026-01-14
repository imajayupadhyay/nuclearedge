<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImportWordPressBlogs extends Command
{
    protected $signature = 'blog:import-wordpress {file=nuclearedge.WordPress.2026-01-14.xml}';
    protected $description = 'Import blog posts from WordPress XML export';

    private $categories = [];
    private $imageMap = [];
    private $adminUser;

    public function handle()
    {
        $this->info('Starting WordPress blog import...');

        // Get admin user
        $this->adminUser = User::where('role', 'admin')->first();
        if (!$this->adminUser) {
            $this->error('No admin user found!');
            return 1;
        }

        // Load XML
        $xmlFile = base_path($this->argument('file'));
        if (!file_exists($xmlFile)) {
            $this->error("XML file not found: {$xmlFile}");
            return 1;
        }

        $this->info('Loading XML file...');
        $xml = simplexml_load_file($xmlFile);

        if (!$xml) {
            $this->error('Failed to parse XML file');
            return 1;
        }

        // Register namespaces
        $xml->registerXPathNamespace('wp', 'http://wordpress.org/export/1.2/');
        $xml->registerXPathNamespace('content', 'http://purl.org/rss/1.0/modules/content/');
        $xml->registerXPathNamespace('excerpt', 'http://wordpress.org/export/1.2/excerpt/');

        // Build image map
        $this->buildImageMap($xml);

        // Get all posts
        $items = $xml->channel->item;
        $posts = [];

        foreach ($items as $item) {
            $postType = (string)$item->children('wp', true)->post_type;
            $status = (string)$item->children('wp', true)->status;

            // Only import published posts
            if ($postType === 'post' && $status === 'publish') {
                $posts[] = $item;
            }
        }

        $this->info('Found ' . count($posts) . ' published blog posts');

        // Import categories first
        $this->importCategories($posts);

        // Import posts
        $bar = $this->output->createProgressBar(count($posts));
        $bar->start();

        $imported = 0;
        $skipped = 0;

        foreach ($posts as $item) {
            try {
                if ($this->importPost($item)) {
                    $imported++;
                } else {
                    $skipped++;
                }
            } catch (\Exception $e) {
                $this->newLine();
                $this->error('Error importing post: ' . $e->getMessage());
                $skipped++;
            }
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("Import completed!");
        $this->info("✓ Imported: {$imported} posts");
        $this->info("✓ Skipped: {$skipped} posts (duplicates)");
        $this->info("✓ Categories: " . count($this->categories));

        return 0;
    }

    private function buildImageMap($xml)
    {
        $this->info('Building image map from uploads folder...');

        // Get all attachments (images) from XML
        foreach ($xml->channel->item as $item) {
            $postType = (string)$item->children('wp', true)->post_type;

            if ($postType === 'attachment') {
                $attachmentId = (string)$item->children('wp', true)->post_id;
                $attachmentUrl = (string)$item->children('wp', true)->attachment_url;

                if ($attachmentUrl) {
                    // Extract filename from URL
                    $filename = basename($attachmentUrl);
                    $this->imageMap[$attachmentId] = $filename;
                }
            }
        }

        $this->info('Found ' . count($this->imageMap) . ' images in XML');
    }

    private function importCategories($posts)
    {
        $this->info('Importing categories...');

        $categoryNames = [];

        foreach ($posts as $item) {
            foreach ($item->category as $cat) {
                $domain = (string)$cat['domain'];
                if ($domain === 'category') {
                    $categoryName = (string)$cat;
                    $categorySlug = (string)$cat['nicename'];

                    if (!in_array($categorySlug, $categoryNames)) {
                        $categoryNames[$categorySlug] = $categoryName;
                    }
                }
            }
        }

        foreach ($categoryNames as $slug => $name) {
            $category = Category::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'description' => "Imported from WordPress",
                    'status' => true,
                    'order' => 0
                ]
            );

            $this->categories[$slug] = $category->id;
        }

        $this->info('Created/found ' . count($this->categories) . ' categories');
    }

    private function importPost($item)
    {
        $wp = $item->children('wp', true);
        $content = $item->children('content', true);
        $excerpt = $item->children('excerpt', true);

        $title = (string)$item->title;
        $slug = (string)$wp->post_name;
        $postContent = (string)$content->encoded;
        $postExcerpt = (string)$excerpt->encoded;
        $publishDate = (string)$wp->post_date;

        // Check if already exists
        if (Blog::where('slug', $slug)->exists()) {
            return false; // Skip duplicate
        }

        // Clean content (remove WordPress shortcodes and blocks)
        $postContent = $this->cleanWordPressContent($postContent);

        // Generate excerpt if empty
        if (empty($postExcerpt)) {
            $postExcerpt = Str::limit(strip_tags($postContent), 200);
        }

        // Get featured image
        $featuredImage = null;
        $thumbnailId = null;

        foreach ($wp->postmeta as $meta) {
            $key = (string)$meta->meta_key;
            $value = (string)$meta->meta_value;

            if ($key === '_thumbnail_id') {
                $thumbnailId = $value;
                break;
            }
        }

        // Map thumbnail ID to actual image file
        if ($thumbnailId && isset($this->imageMap[$thumbnailId])) {
            $filename = $this->imageMap[$thumbnailId];
            $featuredImage = $this->copyImageToStorage($filename);
        }

        // Create blog post
        $blog = Blog::create([
            'user_id' => $this->adminUser->id,
            'title' => $title,
            'slug' => $slug,
            'excerpt' => $postExcerpt,
            'content' => $postContent,
            'featured_image' => $featuredImage,
            'status' => 'published',
            'published_at' => $publishDate,
            'read_time' => $this->calculateReadTime($postContent),
            'is_featured' => false,
        ]);

        // Attach categories
        $categoryIds = [];
        foreach ($item->category as $cat) {
            $domain = (string)$cat['domain'];
            if ($domain === 'category') {
                $categorySlug = (string)$cat['nicename'];
                if (isset($this->categories[$categorySlug])) {
                    $categoryIds[] = $this->categories[$categorySlug];
                }
            }
        }

        if (!empty($categoryIds)) {
            $blog->categories()->attach($categoryIds);
        }

        return true;
    }

    private function copyImageToStorage($filename)
    {
        // Check in public/uploads
        $sourcePath = public_path('uploads/' . $filename);

        if (!file_exists($sourcePath)) {
            // Try subdirectories (WordPress structure: year/month)
            $uploadsPath = public_path('uploads');
            $found = false;

            if (is_dir($uploadsPath)) {
                $iterator = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($uploadsPath),
                    \RecursiveIteratorIterator::SELF_FIRST
                );

                foreach ($iterator as $file) {
                    if ($file->isFile() && $file->getFilename() === $filename) {
                        $sourcePath = $file->getPathname();
                        $found = true;
                        break;
                    }
                }
            }

            if (!$found) {
                return null; // Image not found
            }
        }

        // Copy to storage/app/public/blogs
        $destinationPath = 'blogs/' . $filename;
        $fullDestPath = storage_path('app/public/' . $destinationPath);

        // Create directory if doesn't exist
        $dir = dirname($fullDestPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // Copy file
        copy($sourcePath, $fullDestPath);

        return $destinationPath;
    }

    private function cleanWordPressContent($content)
    {
        // Remove WordPress Gutenberg blocks comments
        $content = preg_replace('/<!-- wp:.*?-->/s', '', $content);
        $content = preg_replace('/<!-- \/wp:.*?-->/s', '', $content);

        // Replace old domain URLs with new ones (optional)
        $content = str_replace('http://nuclearedge.com/', '/', $content);
        $content = str_replace('https://nuclearedge.com/', '/', $content);

        return trim($content);
    }

    private function calculateReadTime($content)
    {
        $wordCount = str_word_count(strip_tags($content));
        $minutes = ceil($wordCount / 200);
        return max(1, $minutes);
    }
}
