<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

use Juzaweb\LogViewer\Http\Controllers\LogViewerController;

Route::group(
    [
        'prefix' => config('juzaweb.admin_prefix', 'admin-cp') . '/log-viewer',
        'middleware' => ['web', 'admin'],
    ],
    function () {
        Route::get('/', [LogViewerController::class, 'index'])->name('admin.logs.error.index');
        Route::get('get-logs', [LogViewerController::class, 'listLogs'])
            ->name('admin.logs.error.get-logs');
        Route::get('{date}', [LogViewerController::class, 'show'])
            ->name('admin.logs.error.show')
            ->where('date', '[0-9\-]+');
        Route::get('download/{date}', [LogViewerController::class, 'download'])
            ->name('admin.logs.error.download')
            ->where('date', '[0-9\-]+');
        Route::get('search/{date}', [LogViewerController::class, 'search'])
            ->name('admin.logs.error.search')
            ->where('date', '[0-9\-]+');
        Route::delete('/', [LogViewerController::class, 'delete'])
            ->name('admin.logs.error.delete');
    }
);
