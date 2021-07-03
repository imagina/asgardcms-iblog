<?php

return [
  'posts-per-page' => [
    'name' => 'iblog::posts-per-page',
    'value' => null,
    'type' => 'input',
    'props' => [
      'label' => 'iblog::settings.posts-per-page',
      'type' => 'number',
    ],
  ],
  'id-facebook' => [
    'name' => 'iblog::id-facebook',
    'value' => null,
    'type' => 'input',
    'props' => [
      'label' => 'iblog::settings.id-facebook',
    ],
  ],
  'twitter' => [
    'name' => 'iblog::twitter',
    'value' => null,
    'type' => 'input',
    'props' => [
      'label' => 'iblog::settings.twitter account',
    ],
  ],
  'defaultImageBlogBreadcrumb' => [
    'value' => (object)['iblog::defaultImageBlogBreadcrumb' => null],
    'name' => 'medias_single',
    'fakeFieldName' => 'iblog::defaultImageBlogBreadcrumb',
    'type' => 'media',
    'props' => [
      'label' => 'iblog::common.settings.defaultImageBlogBreadcrumb',
      'zone' => 'iblog::defaultImageBlogBreadcrumb',
      'entity' => "Modules\Setting\Entities\Setting",
      'entityId' => null
    ]
  ],
];
