<?php

namespace Myvendor\Mycustomtool;

use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class Mycustomtool extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     */
    public function boot(): void
    {
        Nova::mix('mycustomtool', __DIR__.'/../dist/mix-manifest.json');
    }

    /**
     * Build the menu that renders the navigation links for the tool.
     */
    public function menu(Request $request): MenuSection
    {
        return MenuSection::make('Mycustomtool')
            ->path('/mycustomtool')
            ->icon('server');
    }
}
