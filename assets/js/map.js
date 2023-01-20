function City_Leaflet_Map (options) {
    'use strict';

    /**
     * Map options
     */
    this.options = options;

    /**
     * Map instance
     */
    this.map = null;

    /**
     * Create map
     * @returns this
     */
    this.create = function () {
        this.map = L.map(this.options.containerId, this.options.map)
            .setView([this.options.lat, this.options.lng], this.options.zoom);

        for (const layer of this.options.tileLayers) {
            if (! layer.url) {
                continue;
            }

            L.tileLayer(layer.url, {
                attribution: this.options.map.attribution
            }).addTo(this.map);
        }

        if (this.options.map.scaleControl) {
            L.control.scale().addTo(this.map);
        }

        return this;
    }

    /**
     * Show markers and other data on the map
     * @param data
     * @returns this
     */
    this.draw = function (data) {
        for (const feature of data) {
            switch (feature.type) {
                case 'marker':
                    this.marker(feature);
                    break;
                case 'circle':
                    this.circle(feature);
                    break;
                case 'geoJson':
                    this.geoJson(feature);
                    break;
            }
        }

        return this;
    }

    /**
     * Draw a marker
     * @param feature
     * @returns this
     */
    this.marker = function (feature) {
        const options = feature.marker;
        if (options.icon) {
            options.icon = L.icon(options.icon);
        }

        if (options.color && ! options.icon) {
            options.icon = this.svgIcon(options);
        }

        const marker = L.marker(feature.points[0], options).addTo(this.map);

        if (feature.popup && feature.popup.content) {
            marker.bindPopup(feature.popup.content);
        }

        return this;
    }

    /**
     * Draw a circle
     * @param feature
     * @returns this
     */
    this.circle = function (feature) {
        if (! feature.circle.color) {
            feature.circle.color = 'green';
        }

        if (! feature.circle.fill) {
            feature.circle.fill = false;
        }

        L.circle(feature.points[0], feature.circle).addTo(this.map);

        return this;
    }

    /**
     * Display GeoJson on the map
     * @param feature
     * @returns this
     */
    this.geoJson = function (feature) {
        if (! feature.data) {
            return this;
        }

        feature.data = JSON.parse(feature.data);

        L.geoJSON(feature.data, {
            style: function (geoJsonFeature) {
                return {
                    fill: false
                };
            }
        }).addTo(this.map);

        return this;
    }

    /**
     * Retrieve default config of the SVG icon
     * Thanks! https://codepen.io/localhorst/pen/yppoKO
     * @returns object
     */
    this.svgIcon = function (options) {
        const iconSettings = {
            mapIconUrl: '<svg xmlns="http://www.w3.org/2000/svg"><path fill="{mapIconColor}" d="M25 0c-8.284 0-15 6.656-15 14.866 0 8.211 15 35.135 15 35.135s15-26.924 15-35.135c0-8.21-6.716-14.866-15-14.866zm-.049 19.312c-2.557 0-4.629-2.055-4.629-4.588 0-2.535 2.072-4.589 4.629-4.589 2.559 0 4.631 2.054 4.631 4.589 0 2.533-2.072 4.588-4.631 4.588z"/></svg>',
            mapIconColor: options.color
        };

        return L.divIcon({
            className: 'leaflet-data-marker',
            html: L.Util.template(iconSettings.mapIconUrl, iconSettings),
            iconAnchor: [25, 50],
            iconSize: [50, 50],
            popupAnchor : [0, -45]
        });
    }
}
