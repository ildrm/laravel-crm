<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Filament\Panel\PanelServiceProvider as BaseServiceProvider;
use Illuminate\Support\Facades\Blade;

class FilamentServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        FilamentView::registerRenderHook(
            'panels::body.start', // Inject at the start of the panel body
            fn (): string => Blade::render(
                '@include("filament.resources.workflow-resource.pages.create-workflow")',
                [
                    'chartContainerId' => 'workflow-chart',
                    'workflows' => \App\Models\Workflow::all(),
                ]
            ),
            scopes: [WorkflowResource::class], // Scope to WorkflowResource pages
        );
    }
}