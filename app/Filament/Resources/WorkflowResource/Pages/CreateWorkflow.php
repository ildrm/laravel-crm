<?php

namespace App\Filament\Resources\WorkflowResource\Pages;

use App\Filament\Resources\WorkflowResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Workflow;
use Filament\View\PanelsRenderHook;

class CreateWorkflow extends CreateRecord
{
    protected static string $resource = WorkflowResource::class;

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('filament.resources.workflow-resource.pages.create-workflow', [
            'chartContainerId' => 'workflow-chart', // ID for the chart container
            'workflows' => $this->fetchWorkflows(), // Fetch workflow data
        ]);
    }

    protected function fetchWorkflows()
    {
        return Workflow::all(); // Fetch all workflows from the database
    }
}