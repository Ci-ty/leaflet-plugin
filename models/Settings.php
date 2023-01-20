<?php namespace City\Leaflet\Models;

use Model;

class Settings extends Model
{
    const PROVIDERS =
    [
        'osm' => [
            'label' => 'OpenStreetMap',
            'url' => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        ],
        'osm_de' => [
            'label' => 'OpenStreetMap (DE)',
            'url' => 'https://{s}.tile.openstreetmap.de/{z}/{x}/{y}.png',
        ],
        'osm_ch' => [
            'label' => 'OpenStreetMap (CH)',
            'url' => 'https://tile.osm.ch/switzerland/{z}/{x}/{y}.png',
        ],
        'osm_fr' => [
            'label' => 'OpenStreetMap (France)',
            'url' => 'https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png',
        ],
        'osm_hot' => [
            'label' => 'OpenStreetMap (HOT)',
            'url' => 'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png',
        ],
        'osm_bzh' => [
            'label' => 'OpenStreetMap (BZH)',
            'url' => 'https://tile.openstreetmap.bzh/br/{z}/{x}/{y}.png',
        ],
        'opentopomap' => [
            'label' => 'OpenTopoMap',
            'url' => 'https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png',
        ],
        'mtbmap' => [
            'label' => 'MtbMap (CZ)',
            'url' => 'http://tile.mtbmap.cz/mtbmap_tiles/{z}/{x}/{y}.png',
        ],
    ];

    public $implement = ['System.Behaviors.SettingsModel'];

    /**
     * @var string A unique code
     */
    public $settingsCode = 'city_leaflet_settings';

    /**
     * @var string Reference to field configuration
     */
    public $settingsFields = 'fields.yaml';

    public static function getControlsOptions(): array
    {
        return [
            'zoom' => [
                'city.leaflet::lang.settings.controls_options.zoom',
                'city.leaflet::lang.settings.controls_options.zoom_comment'
            ],
            'scale' => [
                'city.leaflet::lang.settings.controls_options.scale',
                'city.leaflet::lang.settings.controls_options.scale_comment'
            ],
            'fullscreen' => [
                'city.leaflet::lang.settings.controls_options.fullscreen',
                'city.leaflet::lang.settings.controls_options.fullscreen_comment'
            ],
            'attribution' => [
                'city.leaflet::lang.settings.controls_options.attribution',
                'city.leaflet::lang.settings.controls_options.attribution_comment'
            ]
        ];
    }

    public static function getProviderOptions(): array
    {
        $options = [];
        foreach (self::PROVIDERS as $key => $provider) {
            $options[$key] = $provider['label'];
        }

        return $options;
    }

    public function getTileLayers()
    {
        $layers = [];

        if (isset(self::PROVIDERS[$this->provider])) {
            $layers[] = self::PROVIDERS[$this->provider]['url'];
        }

        if (!empty($this->custom_providers)) {
            foreach ($this->custom_providers as $item) {
                $layers[] = $item['url'];
            }
        }

        if (! $layers) {
            $layers[] = self::PROVIDERS['osm']['url'];
        }

        return $layers;
    }
}
