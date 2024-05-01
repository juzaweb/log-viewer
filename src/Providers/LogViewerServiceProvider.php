<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

namespace Juzaweb\LogViewer\Providers;

use Juzaweb\CMS\Support\ServiceProvider;

class LogViewerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app['config']->set('log-viewer.route.enabled', false);

        $this->loadViewsFrom(__DIR__ .'/../resources/views', 'log-viewer');

        $this->loadRoutesFrom(__DIR__ . '/../route.php');
    }
}
