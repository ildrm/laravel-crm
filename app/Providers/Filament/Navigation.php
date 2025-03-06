<?php

namespace App\Providers\Filament;

use Filament\Navigation\Navigation;

class NavigationProvider
{
    public function getNavigation(): array
    {
        return [
            'dashboard' => [
                'label' => 'Dashboard',
                'icon' => 'heroicon-o-home',
                'sort' => 0,
            ],
            'user_access_management' => [
                'label' => 'User & Access Management',
                'icon' => 'heroicon-o-lock-closed',
                'sort' => 1,
                'items' => [
                    'profile' => [
                        'label' => 'Profile',
                        'icon' => 'heroicon-o-user',
                        'sort' => 1,
                    ],
                    'users' => [
                        'label' => 'Users',
                        'icon' => 'heroicon-o-user-group',
                        'sort' => 2,
                    ],
                    'roles' => [
                        'label' => 'Roles',
                        'icon' => 'heroicon-o-shield-check',
                        'sort' => 3,
                    ],
                ],
            ],
            'sales_crm' => [
                'label' => 'Sales & CRM',
                'icon' => 'heroicon-o-chart-bar',
                'sort' => 2,
                'items' => [
                    'contacts' => [
                        'label' => 'Contacts',
                        'icon' => 'heroicon-o-address-book',
                        'sort' => 1,
                    ],
                    'companies' => [
                        'label' => 'Companies',
                        'icon' => 'heroicon-o-building-office',
                        'sort' => 2,
                    ],
                    'deals' => [
                        'label' => 'Deals',
                        'icon' => 'heroicon-o-cash',
                        'sort' => 3,
                    ],
                    'leads' => [
                        'label' => 'Leads',
                        'icon' => 'heroicon-o-users',
                        'sort' => 4,
                    ],
                    'meetings' => [
                        'label' => 'Meetings',
                        'icon' => 'heroicon-o-chat-bubble-left-right',
                        'sort' => 5,
                    ],
                    'notes' => [
                        'label' => 'Notes',
                        'icon' => 'heroicon-o-pencil',
                        'sort' => 6,
                    ],
                ],
            ],
            'communication' => [
                'label' => 'Communication',
                'icon' => 'heroicon-o-chat-alt-2',
                'sort' => 3,
                'items' => [
                    'calls' => [
                        'label' => 'Calls',
                        'icon' => 'heroicon-o-phone',
                        'sort' => 1,
                    ],
                    'emails' => [
                        'label' => 'Emails',
                        'icon' => 'heroicon-o-mail',
                        'sort' => 2,
                    ],
                    'channels' => [
                        'label' => 'Channels',
                        'icon' => 'heroicon-o-speakerphone',
                        'sort' => 3,
                    ],
                    'forms' => [
                        'label' => 'Forms',
                        'icon' => 'heroicon-o-document-text',
                        'sort' => 4,
                    ],
                ],
            ],
            'tasks_workflow' => [
                'label' => 'Tasks & Workflow',
                'icon' => 'heroicon-o-clipboard-list',
                'sort' => 4,
                'items' => [
                    'tasks' => [
                        'label' => 'Tasks',
                        'icon' => 'heroicon-o-clipboard-check',
                        'sort' => 1,
                    ],
                    'workflows' => [
                        'label' => 'Workflows',
                        'icon' => 'heroicon-o-refresh',
                        'sort' => 2,
                    ],
                    'activities' => [
                        'label' => 'Activities',
                        'icon' => 'heroicon-o-calendar',
                        'sort' => 3,
                    ],
                    'calendar' => [
                        'label' => 'Calendar',
                        'icon' => 'heroicon-o-calendar',
                        'sort' => 4,
                    ],
                ],
            ],
            'reports_analytics' => [
                'label' => 'Reports & Analytics',
                'icon' => 'heroicon-o-chart-pie',
                'sort' => 5,
                'items' => [
                    'sales_report' => [
                        'label' => 'Sales Report',
                        'icon' => 'heroicon-o-trending-up',
                        'sort' => 1,
                    ],
                    'contact_report' => [
                        'label' => 'Contact Report',
                        'icon' => 'heroicon-o-user-group',
                        'sort' => 2,
                    ],
                    'communication_report' => [
                        'label' => 'Communication Report',
                        'icon' => 'heroicon-o-chat-alt',
                        'sort' => 3,
                    ],
                    'activity_report' => [
                        'label' => 'Activity Report',
                        'icon' => 'heroicon-o-clock',
                        'sort' => 4,
                    ],
                    'general_reports' => [
                        'label' => 'General Reports',
                        'icon' => 'heroicon-o-document-report',
                        'sort' => 5,
                    ],
                ],
            ],
            'data_warehouse' => [
                'label' => 'Data Warehouse',
                'icon' => 'heroicon-o-database',
                'sort' => 6,
                'items' => [
                    'data_import' => [
                        'label' => 'Data Import',
                        'icon' => 'heroicon-o-upload',
                        'sort' => 1,
                    ],
                    'data_export' => [
                        'label' => 'Data Export',
                        'icon' => 'heroicon-o-download',
                        'sort' => 2,
                    ],
                    'data_transformation' => [
                        'label' => 'Data Transformation',
                        'icon' => 'heroicon-o-switch-horizontal',
                        'sort' => 3,
                    ],
                    'data_integration' => [
                        'label' => 'Data Integration',
                        'icon' => 'heroicon-o-link',
                        'sort' => 4,
                    ],
                ],
            ],
            'project_organization_management' => [
                'label' => 'Project & Organization Management',
                'icon' => 'heroicon-o-folder',
                'sort' => 7,
                'items' => [
                    'projects' => [
                        'label' => 'Projects',
                        'icon' => 'heroicon-o-folder',
                        'sort' => 1,
                    ],
                    'organizations' => [
                        'label' => 'Organizations',
                        'icon' => 'heroicon-o-building-office',
                        'sort' => 2,
                    ],
                    'milestones' => [
                        'label' => 'Milestones',
                        'icon' => 'heroicon-o-flag',
                        'sort' => 3,
                    ],
                    'visits' => [
                        'label' => 'Visits',
                        'icon' => 'heroicon-o-location-marker',
                        'sort' => 4,
                    ],
                ],
            ],
            'backup_security' => [
                'label' => 'Backup & Security',
                'icon' => 'heroicon-o-shield-check',
                'sort' => 8,
                'items' => [
                    'backups' => [
                        'label' => 'Backups',
                        'icon' => 'heroicon-o-cloud-upload',
                        'sort' => 1,
                    ],
                ],
            ],
        ];

    }
}
