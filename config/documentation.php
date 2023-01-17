<?php

return [
    'patch_notes_path' => public_path('docs/versions'),
    'space' => "\x20",
    'route_path' => public_path('docs/routes'),
    'parameter_identify' => ':',
    'default_main_yaml' => '/actions.yaml',

    'actions' => [
        'index' => './index.yaml',
        'post' => './post.yaml',
        'show' => './show.yaml',
        'put' => './update.yaml',
        'delete' => './delete.yaml',
    ],

    'key' => env('DOCS_KEY', ''),
];
