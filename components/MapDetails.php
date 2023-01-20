<?php namespace City\Leaflet\Components;

use City\Leaflet\Models\Settings;
use City\Map\Components\MapDetailsBase;

class MapDetails extends MapDetailsBase
{
    /**
     * @inheritDoc
     */
    public function componentDetails(): array
    {
        return [
            'name' => trans('city.leaflet::lang.component.name'),
            'description' => trans('city.leaflet::lang.component.description')
        ];
    }

    /**
     * Add properties for the map
     */
    public function init()
    {
        parent::init();

        $this->setProperty(
            'mapOptions',
            json_encode($this->getMapOptions())
        );

        $this->setProperty(
            'tileLayers',
            json_encode($this->getTileLayers())
        );
    }

    /**
     * Add assets for the component
     */
    public function onRun()
    {
        $css = ['assets/node_modules/leaflet/dist/leaflet.css'];
        $js = ['assets/node_modules/leaflet/dist/leaflet.js'];

        if (!empty($this->getMapOptions()['fullscreenControl'])) {
            $css[] = 'assets/node_modules/leaflet-fullscreen/dist/leaflet.fullscreen.css';
            $js[] = 'assets/node_modules/leaflet-fullscreen/dist/Leaflet.fullscreen.min.js';
        }

        $js[] = 'assets/js/map.js';

        $this->addCss($css);
        $this->addJs($js);
    }

    /**
     * Collect map options
     * @return array
     */
    protected function getMapOptions(): array
    {
        $options = [];

        /**
         * General
         */
        $options['attribution'] = Settings::get(
            'attribution',
            '© <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap contributors</a>'
        );

        /**
         * Controls
         */
        $controls = array_keys(Settings::getControlsOptions());
        if (! $selectedControls = Settings::get('controls', ['zoom', 'fullscreen', 'attribution'])) {
            $selectedControls = [];
        }

        foreach ($controls as $control) {
            $value = in_array($control, $selectedControls);
            $options[$control . 'Control'] = (int) $value;
        }

        return $options;
    }

    /**
     * Collect map tile layers
     * @return array
     */
    protected function getTileLayers(): array
    {
        $options = [];

        /**
         * Tile Layers
         */
        $layers = Settings::instance()->getTileLayers();
        foreach ($layers as $url) {
            $options[] = ['url' => $url];
        }

        return $options;
    }
}
