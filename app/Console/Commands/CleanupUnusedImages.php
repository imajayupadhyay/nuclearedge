<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CleanupUnusedImages extends Command
{
    protected $signature = 'blog:cleanup-images {--force : Skip confirmation}';
    protected $description = 'Remove unused images from storage and public/uploads folder';

    public function handle()
    {
        $this->info('Starting cleanup process...');
        $this->newLine();

        // Get all featured images currently in use
        $usedImages = Blog::whereNotNull('featured_image')
            ->pluck('featured_image')
            ->map(function ($path) {
                return basename($path);
            })
            ->toArray();

        $this->info('Found ' . count($usedImages) . ' images in use by blog posts');

        // Scan storage/app/public/blogs directory
        $storageImagesPath = storage_path('app/public/blogs');
        $unusedStorageImages = [];

        if (is_dir($storageImagesPath)) {
            $allStorageImages = File::files($storageImagesPath);

            foreach ($allStorageImages as $file) {
                $filename = $file->getFilename();
                if (!in_array($filename, $usedImages)) {
                    $unusedStorageImages[] = $file->getPathname();
                }
            }
        }

        // Check public/uploads folder
        $uploadsPath = public_path('uploads');
        $uploadsExists = is_dir($uploadsPath);
        $uploadsSize = 0;

        if ($uploadsExists) {
            $uploadsSize = $this->getDirectorySize($uploadsPath);
        }

        // Display summary
        $this->newLine();
        $this->info('=== Cleanup Summary ===');
        $this->line('Images in use: ' . count($usedImages));
        $this->line('Total images in storage/blogs: ' . ($allStorageImages ? count($allStorageImages) : 0));
        $this->warn('Unused images in storage/blogs: ' . count($unusedStorageImages));

        if ($uploadsExists) {
            $this->warn('public/uploads folder: ' . $this->formatBytes($uploadsSize) . ' (will be removed)');
        }

        $this->newLine();

        if (count($unusedStorageImages) > 0) {
            $this->warn('Unused images to be deleted from storage/blogs:');
            foreach ($unusedStorageImages as $imagePath) {
                $this->line('  - ' . basename($imagePath));
            }
            $this->newLine();
        }

        // Ask for confirmation
        if (!$this->option('force')) {
            if (!$this->confirm('Do you want to proceed with cleanup?')) {
                $this->info('Cleanup cancelled.');
                return 0;
            }
        }

        // Delete unused images from storage
        $deletedCount = 0;
        foreach ($unusedStorageImages as $imagePath) {
            if (File::delete($imagePath)) {
                $deletedCount++;
            }
        }

        $this->info("✓ Deleted {$deletedCount} unused images from storage/blogs");

        // Delete public/uploads folder
        if ($uploadsExists) {
            if (File::deleteDirectory($uploadsPath)) {
                $this->info("✓ Deleted public/uploads folder (" . $this->formatBytes($uploadsSize) . " freed)");
            } else {
                $this->error("✗ Failed to delete public/uploads folder");
            }
        }

        $this->newLine();
        $this->info('Cleanup completed successfully!');
        $this->info('Kept ' . count($usedImages) . ' images that are currently in use');

        return 0;
    }

    private function getDirectorySize($path)
    {
        $size = 0;

        if (is_dir($path)) {
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($path, \RecursiveDirectoryIterator::SKIP_DOTS)
            );

            foreach ($iterator as $file) {
                if ($file->isFile()) {
                    $size += $file->getSize();
                }
            }
        }

        return $size;
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
