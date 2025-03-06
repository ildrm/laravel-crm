<?php

namespace App\Filament\Resources\CalendarResource\Pages;

use App\Filament\Resources\CalendarResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Facades\FilamentView;

class ListCalendars extends ListRecords
{
    protected static string $resource = CalendarResource::class;

    // Modify to return the full calendar view
    public function getHeader(): ?\Illuminate\Contracts\View\View
    {
        $events = CalendarResource::renderFullCalendar();
        
        return view('filament.resources.calendar.full-calendar', [
            'events' => $events
        ]);
    }
}