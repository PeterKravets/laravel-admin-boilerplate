<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * The path to the current lang files.
     *
     * @var string
     */
    protected $langPath;

    /**
     * Create a new service provider instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->langPath = resource_path('lang');
    }

    private $exceptFiles = [
        'admin.php',
        'validation.php'
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $locale = app()->getLocale();

        Cache::rememberForever('translations', function () use ($locale) {
            $files = File::files($this->langPath . '/' . $locale);

            $translations = new Collection();

            foreach ($files as $file) {
                if (!in_array($file->getFilename(), $this->exceptFiles)) {
                    $translations[$file->getFilenameWithoutExtension()] = include_once ($file);
                }
            }

            return $translations;
        });
    }
}
