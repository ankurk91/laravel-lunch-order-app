<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->datetimeDirective();
        $this->dateDirective();
        $this->timeagoDirective();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    private function datetimeDirective()
    {
        Blade::directive('datetime', function ($expression) {
            return $this->datetimeWrap($expression, "<?php echo ($expression)->format('j M Y, g:ia'); ?>");
        });
    }

    private function dateDirective()
    {
        Blade::directive('date', function ($expression) {
            return $this->datetimeWrap($expression, "<?php echo ($expression)->format('j M Y'); ?>");
        });
    }

    private function timeagoDirective()
    {
        Blade::directive('timeago', function ($expression) {
            return $this->datetimeWrap($expression, "<?php echo ($expression)->diffForHumans(); ?>");
        });
    }

    private function datetimeWrap($expression, $content)
    {
        return "<time datetime=\"<?php echo ($expression)->toIso8601String() ?>\" 
title=\"<?php echo ($expression)->format('j M Y, g:i:s a, T')?>\">" . $content . '</time>';
    }
}
