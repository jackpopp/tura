<?php namespace Jackpopp\Tura;

use Illuminate\Support\ServiceProvider;

class TuraServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('jackpopp/tura');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app['tura'] = $this->app->share(function($app)
        {
            return new Tura($app);
        });

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Tura', 'Jackpopp\Tura\Facades\Tura');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('tura');
    }

}
