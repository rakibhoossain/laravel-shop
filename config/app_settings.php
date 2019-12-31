<?php
return [

    // All the sections for the settings page
    'sections' => [
        'app' => [
            'title' => 'General',
            'descriptions' => 'Application general settings.', // (optional)
            'icon' => 'fa fa-cog', // (optional)

            'inputs' => [
                [
                    'name' => 'app_name', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'App Name', // label for input
                    // optional properties
                    'placeholder' => 'Application Name', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required|min:2|max:20', // validation rules for this input
                    'value' => 'Laravel shop', // any default value
                    'hint' => 'You can set the app name here' // help block text for input
                ],
                [
                    'name' => 'app_description', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'App description', // label for input
                    // optional properties
                    'placeholder' => 'Application description', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required|min:2|max:150', // validation rules for this input
                    'value' => 'Our Laravel shop', // any default value
                    'hint' => 'You can set the app description here' // help block text for input
                ],
                [
                    'name' => 'logo',
                    'type' => 'image',
                    'label' => 'Upload logo',
                    'hint' => 'Must be an image and cropped in desired size 137x38 px',
                    'rules' => 'image|max:500',
                    'disk' => 'public', // which disk you want to upload
                    'path' => 'app', // path on the disk,
                    'preview_class' => 'thumbnail',
                    'preview_style' => 'height:38px'
                ],
                [
                    'name' => 'icon',
                    'type' => 'image',
                    'label' => 'Site icon',
                    'hint' => 'Must be an image and cropped in desired size 45x45 px',
                    'rules' => 'image|max:500',
                    'disk' => 'public', // which disk you want to upload
                    'path' => 'app', // path on the disk,
                    'preview_class' => 'thumbnail',
                    'preview_style' => 'height:45px'
                ],
                [
                    'name' => 'app_email',
                    'type' => 'email',
                    'label' => 'Email',
                    'placeholder' => 'Application email',
                    'rules' => 'required|email',
                    'value' => 'serakib@gmail.com'
                ],
                [
                    'name' => 'app_phone',
                    'type' => 'text',
                    'label' => 'Phone',
                    // optional fields
                    'data_type' => 'string',
                    'rules' => 'required|min:2|max:20',
                    'placeholder' => 'Application phone',
                    'class' => 'form-control',
                    'value' => '01776217594',
                    'hint' => 'You can set the app phone here'
                ],
                [
                    'type' => 'textarea',
                    'name' => 'copyright_text',
                    'label' => 'Copyright Text',
                    'rows' => 2,
                    'cols' => 10,
                    'value' => 'Laravel shop',
                    'placeholder' => 'You can set the copyright text here.'
                ]
            ]
        ],
        'shop' => [
            'title' => 'Shop',
            'icon' => 'fa fa-store',

            'inputs' => [
                [
                    'type' => 'select',
                    'name' => 'shop_currency',
                    'label' => 'Default currency',
                    'rules' => 'required',
                    'options' => function() {
                        $default = ['0' => env('CURRENCY_CODE', 'USD')];
                        $dbCurrency = App\Currency::pluck('code', 'id')->toArray();
                        return $default + $dbCurrency;
                    }
                ],
                [
                    'type' => 'textarea',
                    'name' => 'shop_address',
                    'label' => 'Shop address',
                    'rows' => 2,
                    'cols' => 10,
                    'value' => 'Shop address',
                    'placeholder' => 'You can set the shop address here.'
                ]
            ]
        ],
        'social' => [
            'title' => 'Social',
            'icon' => 'fa fa-paperclip',
            'inputs' => [
                [
                    'name' => 'social_facebook',
                    'type' => 'text',
                    'label' => 'Facebook',
                    'placeholder' => 'Facebook link',
                ],
                [
                'name' => 'social_twitter',
                    'type' => 'text',
                    'label' => 'Twitter',
                    'placeholder' => 'Twitter link',
                ],
                [
                    'name' => 'social_dribbble',
                    'type' => 'text',
                    'label' => 'Dribbble',
                    'placeholder' => 'Dribbble link',
                ],
                [
                    'name' => 'social_behance',
                    'type' => 'text',
                    'label' => 'Behance',
                    'placeholder' => 'Behance link',
                ],
                [
                    'name' => 'social_linkedin',
                    'type' => 'text',
                    'label' => 'LinkedIn',
                    'placeholder' => 'LinkedIn link',
                ]
            ]
        ]
    ],

    // Setting page url, will be used for get and post request
    'url' => 'settings',

    // Any middleware you want to run on above route
    'middleware' => ['is_admin','verified'],

    // View settings
    'setting_page_view' => 'admin.setting', // app_settings::settings_page
    'flash_partial' => 'app_settings::_flash',

    // Setting section class setting
    'section_class' => 'card mb-3',
    'section_heading_class' => 'card-header',
    'section_body_class' => 'card-body',

    // Input wrapper and group class setting
    'input_wrapper_class' => 'form-group',
    'input_class' => 'form-control',
    'input_error_class' => 'has-error',
    'input_invalid_class' => 'is-invalid',
    'input_hint_class' => 'form-text text-muted',
    'input_error_feedback_class' => 'text-danger',

    // Submit button
    'submit_btn_text' => 'Save Settings',
    'submit_success_message' => 'Settings has been saved.',

    // Remove any setting which declaration removed later from sections
    'remove_abandoned_settings' => false,

    // Controller to show and handle save setting
    'controller' => '\QCod\AppSettings\Controllers\AppSettingController',

    // settings group
    'setting_group' => function() {
        // return 'user_'.auth()->id();
        return 'default';
    }
];
