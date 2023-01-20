<?php return [
    'plugin' => [
        'name' => 'Leaflet Maps',
        'description' => 'City Leaflet Maps Plugin'
    ],
    'component' => [
        'name' => 'Leaflet Map',
        'description' => 'Show Leaflet Map (part of Dynamic Maps)'
    ],
    'settings' => [
        'label' => 'Leaflet Maps',
        'description' => 'Leaflet settings',
        'general' => 'General Settings',
        'style_settings' => 'Style Settings',
        'controls' => 'Controls',
        'controls_options' => [
            'zoom' => 'Zoom',
            'zoom_comment' => 'A basic zoom control with two buttons (zoom in and zoom out)',
            'scale' => 'Scale',
            'scale_comment' => 'A simple scale control that shows the scale of the current center of screen in metric (m/km) and imperial (mi/ft) systems',
            'fullscreen' => 'Fullscreen',
            'fullscreen_comment' => 'Allows display of the map in full-screen mode',
            'attribution' => 'Attribution',
            'attribution_comment' => 'The attribution control allows you to display attribution data in a small text box on a map',
        ],
        'attribution' => 'Attribution Text',
        'attribution_comment' => 'This text is shown if the attribution control is checked. Text appears in the bottom right corner of the map.',
        'providers_hint' => 'Select one of the predefined map providers or specify any custom layers. It helps to change the map style or show specific data. Many options that you can use are collected here: <a href="https://leaflet-extras.github.io/leaflet-providers/preview/" target="_blank">Leaflet-providers preview</a>.',
        'provider' => 'Map Provider',
        'provider_options' => [
            'custom_providers' => 'Use "Custom Map Providers" only',
        ],
        'custom_providers' => [
            'label' => 'Custom Map Providers',
            'add' => 'Add layer',
            'url' => 'URL',
        ],
    ]
];
