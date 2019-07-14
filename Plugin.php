<?php namespace Raideer\Thumbnail;

use Backend;
use System\Models\File;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'thumbnail',
            'description' => 'Make thumbnails with using a twig filter',
            'author'      => 'raideer',
            'icon'        => 'icon-square'
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'thumbnail' => [$this, 'createThumbnail']
            ]
        ];
    }

    public function createThumbnail($path, $width = 'auto', $height = 'auto', $options = [])
    {
        try {
            // Converting local url to a path
            $baseUrl = url('/');
            if (substr($path, 0, strlen($baseUrl)) === $baseUrl) {
                $path = substr($path, strlen($baseUrl));
                $path = base_path(ltrim($path, '/'));
            }

            // Check if $path is a URL
            if (filter_var($path, FILTER_VALIDATE_URL)) {
                $image = (new File)->fromUrl($path);
            } else {
                $image = (new File)->fromFile($path);
            }
        } catch (\Exception $e) {
            // If debug is false, all exceptions are supressed
            if (array_key_exists('debug', $options)) {
                if ($options['debug'] === true) {
                    throw $e;
                }
            }

            return '';
        }

        return $image->getThumb($width, $height, $options);
    }
}
