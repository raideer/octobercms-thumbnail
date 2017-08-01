<?php namespace Raideer\Thumbnail;

use Backend;
use Storage;
use Cms\Classes\MediaLibrary;
use System\Classes\PluginBase;

/**
 * thumbnail Plugin Information File
 */
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
            'description' => 'No description provided yet...',
            'author'      => 'raideer',
            'icon'        => 'icon-leaf'
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
            // $path = MediaLibrary::url($path);
            $path = ltrim($path, '/');
            $image = (new \System\Models\File)->fromFile($path);
        } catch (\Exception $e) {
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
