<?php
namespace AvoRed\Graphql;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\App;
use Rebing\GraphQL\GraphQL;
use Laravel\Passport\Passport;

class GraphqlProvider extends ServiceProvider
{
    /**
     * Register services.
     * @return void
     */
    public function register()
    {
        $this->registerConfigData();
        $this->registerRebingGraphqlProvider();
        // $this->registerMiddleware();
        $this->registerGraphqlData();
    }

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
        //dd(config('grahpql'));
        Passport::routes();
    }

    /**
     * Registering Dynamic Schemas & Types
     * @param \Rebing\GraphQL\GraphQL $graphql
     * @return void
     */
    public function registerGraphqlData(): void
    {
        // $this->app->afterResolving('graphql', function (GraphQL $graphql) {
        //     $this->bootSchemas($graphql);
        //     $this->bootTypes($graphql);
        // });
    }

    /**
     * Add types from config.
     * @param \Rebing\GraphQL\GraphQL $graphql
     * @return void
     */
    protected function bootTypes(GraphQL $graphql): void
    {
        $configTypes = config('graphql.types');
        $graphql->addTypes($configTypes);
    }

    /**
     * Add schemas from config.
     * @param \Rebing\GraphQL\GraphQL $graphql
     * @return void
     */
    protected function bootSchemas(GraphQL $graphql): void
    {
        $configSchemas = config('graphql.schemas');
        foreach ($configSchemas as $name => $schema) {
            $graphql->addSchema($name, $schema);
        }
    }

    /**
     * Rebing Grahpql Service Provider to Add Dynamic Schema and register types,query & mutation
     * @return void
     */
    protected function registerRebingGraphqlProvider(): void
    {
        App::register(\Rebing\GraphQL\GraphQLServiceProvider::class, true);
    }

    /**
     * Registering AvoRed E commerce Middleware.
     * @return void
     */
    protected function registerMiddleware()
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('admin.auth', AdminAuth::class);
        $router->aliasMiddleware('admin.guest', RedirectIfAdminAuth::class);
        $router->aliasMiddleware('avored', AvoRedCore::class);
    }

    /**
     * Register config data for AvoRed E commerce Framework
     * @return void
     */
    public function registerConfigData()
    {
        $avoredConfigData = include __DIR__ . '/../config/avored-graphql.php';
        $authConfig = $this->app['config']->get('auth', []);
        $this->app['config']->set(
            'auth',
            array_merge_recursive($avoredConfigData['auth'], $authConfig)
        );
        $graphqlConfig = $this->app['config']->get('graphql', []);
        $this->app['config']->set(
            'graphql',
            array_merge_recursive($avoredConfigData['graphql'], $graphqlConfig)
        );
    }

   /**
    * Set up the file which can be published to use the package
    * @return void
    */
    public function setupPublishFiles()
    {
        $this->publishes([
            __DIR__.'/../config/avored.php' => config_path('avored.php')
        ], 'avored-config');

        $this->publishes([
            __DIR__.'/../assets/avored-admin' => public_path('avored-admin')
        ], 'avored-public');
    }
}
