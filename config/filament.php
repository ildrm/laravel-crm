<?php

use App\Filament\Resources\ContactResource;
use App\Filament\Resources\CompanyResource;
use App\Filament\Resources\DealResource;
use App\Filament\Resources\ActivityResource;
use App\Filament\Resources\TaskResource;
use App\Filament\Resources\NoteResource;
use App\Filament\Resources\EmailResource;
use App\Filament\Resources\FormResource;

return [

    'resources' => [
        ContactResource::class,
        CompanyResource::class,
        DealResource::class,
        ActivityResource::class,
        TaskResource::class,
        NoteResource::class,
        EmailResource::class,
        FormResource::class,
    ],

    // Other configuration options can be added here as needed
];
