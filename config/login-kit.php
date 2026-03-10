<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Side Image
    |--------------------------------------------------------------------------
    |
    | URL gambar yang akan ditampilkan di samping form login.
    |
    */
    'side_image' => env('LOGIN_KIT_SIDE_IMAGE', 'images/login-kit/side-image.jpg'),

    /*
    |--------------------------------------------------------------------------
    | Side Image Position
    |--------------------------------------------------------------------------
    |
    | Posisi gambar samping: 'left' atau 'right'
    |
    */
    'side_image_position' => env('LOGIN_KIT_SIDE_IMAGE_POSITION', 'left'),

    /*
    |--------------------------------------------------------------------------
    | Background Position
    |--------------------------------------------------------------------------
    |
    | Posisi background image: 'center', 'top', 'bottom', dll
    |
    */
    'background_position' => env('LOGIN_KIT_BG_POSITION', 'center'),

    /*
    |--------------------------------------------------------------------------
    | Background Size
    |--------------------------------------------------------------------------
    |
    | Ukuran background: 'cover', 'contain', dll
    |
    */
    'background_size' => env('LOGIN_KIT_BG_SIZE', 'cover'),

    /*
    |--------------------------------------------------------------------------
    | Form Position
    |--------------------------------------------------------------------------
    |
    | Posisi form: 'center', 'top', 'bottom'
    |
    */
    'form_position' => env('LOGIN_KIT_FORM_POSITION', 'center'),

    /*
    |--------------------------------------------------------------------------
    | Form Alignment
    |--------------------------------------------------------------------------
    |
    | Alignment form: 'left', 'center', 'right'
    |
    */
    'form_alignment' => env('LOGIN_KIT_FORM_ALIGNMENT', 'center'),

    /*
    |--------------------------------------------------------------------------
    | Layout Mode
    |--------------------------------------------------------------------------
    |
    | Mode layout: 'split' atau 'overlay'
    |
    */
    'layout_mode' => env('LOGIN_KIT_LAYOUT_MODE', 'split'),

    /*
    |--------------------------------------------------------------------------
    | Overlay Opacity
    |--------------------------------------------------------------------------
    |
    | Opacity overlay (0.0 - 1.0)
    |
    */
    'overlay_opacity' => (float) env('LOGIN_KIT_OVERLAY_OPACITY', 0.5),

    /*
    |--------------------------------------------------------------------------
    | Force Version
    |--------------------------------------------------------------------------
    |
    | Force specific Filament version ('3', '4', '5', or null for auto-detect)
    |
    */
    'force_version' => env('LOGIN_KIT_FORCE_VERSION', null),
];
