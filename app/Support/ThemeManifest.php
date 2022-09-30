<?php

namespace App\Support;

use Exception;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class ThemeManifest
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    public $files;

    /**
     * The base path.
     *
     * @var string
     */
    public $basePath;

    /**
     * The vendor path.
     *
     * @var string
     */
    public $vendorPath;

    /**
     * The manifest path.
     *
     * @var string|null
     */
    public $manifestPath;

    /**
     * The loaded manifest array.
     *
     * @var array
     */
    public $manifest;

    /**
     * Create a new package manifest instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  string  $basePath
     * @param  string  $manifestPath
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
        $this->manifestPath = base_path('bootstrap/cache/themes.php');
    }

    /**
     * Get default of the theme.
     *
     *
     * @return array
     */
    public function current()
    {
        return $this->get(config('cms.theme'));
    }

    /**
     * Get all of the theme for all packages.
     *
     * @param  string  $theme
     *
     * @return array
     */
    public function get($theme = null)
    {
        $manifest = $this->getManifest();
        return $theme == null ? $manifest: $manifest[$theme];
    }

    /**
     * Get the current package manifest.
     *
     * @return array
     */
    protected function getManifest()
    {
        if (!is_null($this->manifest)) {
            return $this->manifest;
        }

        if (!is_file($this->manifestPath)) {
            $this->build();
        }

        return $this->manifest = is_file($this->manifestPath) ?
            $this->files->getRequire($this->manifestPath) : [];
    }

    /**
     * Build the manifest and write it to disk.
     *
     * @return void
     */
    public function build()
    {
        $manifest = [];
        foreach (glob(theme_path('/*/theme.json')) as $file) {
            if (Str::contains($file, '/admin/assets')) {
                continue;
            }
            // default attrubute
            $content    = $this->packageFromFile($file);
            $full_path  = str_replace("/theme.json", '', $file);
            $shortname       = str_replace(theme_path("/"), '', $full_path);

            $manifest[$shortname] = [
                'name' => $content['name'],
                'description' => $content['description'],
                'version' => $content['version'],
                'author_name' => $content['author_name'],
                'author_email' => $content['author_email'],
                'homepage' => $content['homepage'],
                "shortname" => $shortname,
                "full_path" => $full_path,
            ];
        }
        $this->write($manifest);
        return $manifest;
    }

    /**
     *
     * @param string $file theme.json path
     *
     * @return array
     */
    public function packageFromFile($file)
    {
        return json_decode($this->files->get($file), true);
    }

    /**
     * Write the given manifest array to disk.
     *
     * @param  array  $manifest
     * @return void
     *
     * @throws \Exception
     */
    protected function write(array $manifest)
    {
        if (!is_writable($dirname = dirname($this->manifestPath))) {
            throw new Exception("The {$dirname} directory must be present and writable.");
        }

        $this->files->replace(
            $this->manifestPath,
            '<?php return ' . var_export($manifest, true) . ';'
        );
    }
}
