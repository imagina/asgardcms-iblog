<?php

use Illuminate\Routing\Router;

$locale = LaravelLocalization::setLocale() ?: App::getLocale();
$customMiddlewares = config('asgard.iblog.config.middlewares') ?? [];

/** @var Router $router */
<<<<<<< HEAD
Route::group(['prefix' => LaravelLocalization::setLocale(),
  'middleware' => array_merge(['localize'], $customMiddlewares)], function (Router $router) use ($locale) {

=======
Route::group([
  'middleware' => array_merge([ 'localize'], $customMiddlewares)], function (Router $router) use ($locale) {
  
>>>>>>> cb92557debe78fb3f22e1e6f0769d05dab19a537
  $router->get(trans('iblog::routes.blog.index.index'), [
    'as' => $locale . '.iblog.blog.index',
    'uses' => 'PublicController@index',
  ]);
  $router->get(trans('iblog::routes.blog.index.tag'), [
    'as' => $locale . '.iblog.blog.tag',
    'uses' => 'PublicController@tag',
  ]);
  $router->get(trans('iblog::routes.blog.index.category'), [
    'as' => $locale . '.iblog.blog.index.category',
    'uses' => 'PublicController@index',
  ]);
  $router->get(trans('iblog::routes.blog.show.post'), [
    'as' => $locale . '.iblog.blog.show',
    'uses' => 'PublicController@show',
  ]);

});

if(config('asgard.iblog.config.useOldRoutes')) {

  if (!App::runningInConsole()) {
    $categoryRepository = app('Modules\Iblog\Repositories\CategoryRepository');
    $categories = $categoryRepository->getItemsBy(json_decode(json_encode(['filter' => [], 'include' => [], 'take' => null])));
    foreach ($categories as $category) {

      /** @var Router $router */
      $router->group(['prefix' => $category->slug,
        'middleware' => $customMiddlewares], function (Router $router) use ($locale, $category) {

        $router->get('/', [
          'as' => $locale . '.iblog.category.' . $category->slug,
          'uses' => 'OldPublicController@index',
          'middleware' => config('asgard.iblog.config.middleware'),
        ]);
        $router->get('{slug}', [
          'as' => $locale . '.iblog.' . $category->slug . '.post',
          'uses' => 'OldPublicController@show',
          'middleware' => config('asgard.iblog.config.middleware'),
        ]);
      });
    }
  }
  /** @var Router $router */
  $router->group(['prefix' => trans('iblog::tag.uri'),
    'middleware' => $customMiddlewares], function (Router $router) use ($locale) {
    $router->get('{slug}', [
      'as' => $locale . '.iblog.tag.slug',
      'uses' => 'OldPublicController@tag',
      //'middleware' => config('asgard.iblog.config.middleware'),
    ]);
  });


  /** @var Router $router */
  $router->group(['prefix' => 'iblog/feed',
    'middleware' => $customMiddlewares], function (Router $router) use ($locale) {
    $router->get('{format}', [
      'as' => $locale . '.iblog.feed.format',
      'uses' => 'OldPublicController@feed',

    ]);
  });

}
