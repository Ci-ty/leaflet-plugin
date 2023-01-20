<?php namespace City\Leaflet;

use System\Classes\PluginBase;
use City\Leaflet\Models\Settings;
use City\Leaflet\Components\MapDetails;

class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = ['City.Map'];

    /**
     * Add component
     * @return string[]
     */
    public function registerComponents()
    {
        return [
            MapDetails::class => 'leafletMap',
        ];
    }

    /**
     * Add settings
     * @return array[]
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'city.leaflet::lang.settings.label',
                'description' => 'city.leaflet::lang.settings.description',
                'category'    => trans('city.map::lang.plugin.settings_category'),
                'icon'        => 'icon-leaf',
                'class'       => Settings::class,
                'order'       => 521,
                'keywords'    => 'city dynamic leaflet map osm openstreetmap'
            ]
        ];
    }
}
