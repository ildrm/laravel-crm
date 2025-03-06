<?php

namespace App\Providers\Filament;

use Filament\Navigation\Navigation;

class FilamentNavigationProvider
{
    public function getNavigation(): array
    {
        return [
            'administration' => [
                'label' => 'Administration',
                'icon' => 'heroicon-o-cog',
                'sort' => 1,
                'items' => [
                    'dashboard' => [
                        'label' => 'Dashboard',
                        'icon' => 'heroicon-o-home',
                        'sort' => 0,
                    ],
                ],
            ],
            'backup_security' => [
                'label' => 'Backup & Security',
                'icon' => 'heroicon-o-shield-check',
                'sort' => 2,
                'items' => [
                    'backups' => [
                        'label' => 'Backups',
                        'icon' => 'heroicon-o-cloud-upload',
                        'sort' => 1,
                    ],
                ],
            ],
            'tasks_workflow' => [
                'label' => 'Tasks & Workflow',
                'icon' => 'heroicon-o-clipboard-list',
                'sort' => 3,
                'items' => [
                    'projects' => [
                        'label' => 'Projects',
                        'icon' => 'heroicon-o-rectangle-stack',
                        'sort' => 1,
                    ],
                ],
            ],
            'sales_crm' => [
                'label' => 'Sales & CRM',
                'icon' => 'heroicon-o-chart-bar',
                'sort' => 4,
                'items' => [
                    'visits' => [
                        'label' => 'Visits',
                        'icon' => 'heroicon-o-eye',
                        'sort' => 1,
                    ],
                ],
            ],
            // Other groups and items...
        ];
    }
}
