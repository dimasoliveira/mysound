<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\Factory as ViewFactory;

class ComposerServiceProvider extends ServiceProvider {

  /**
   * Register bindings in the container.
   *
   * @return void
   */
  public function boot(ViewFactory $view)
  {
    /**
     * Loads the Global Composer in on all views.
     */
    $view->composer('*', 'App\Http\ViewComposers\GlobalComposer');
  }

  public function register()
  {
    //
  }

}