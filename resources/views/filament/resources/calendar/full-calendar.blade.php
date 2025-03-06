<div>
    <div class="fi-page-header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-col gap-2">
                <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white">
                    {{ __('Calendar') }}
                </h1>
                
                <nav class="fi-breadcrumbs mb-2">
                    <ul class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                        <li>
                            <span>{{ __('Tasks & Workflow') }}</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-gray-300 dark:text-gray-600">/</span>
                            <span>{{ __('Calendar') }}</span>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('filament.admin.resources.calendars.create') }}" 
                   class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-size-md inline-grid gap-1.5 px-3 py-2 text-sm text-white shadow-sm bg-primary-600 hover:bg-primary-500 focus-visible:ring-primary-500 dark:bg-primary-500 dark:hover:bg-primary-400 dark:focus-visible:ring-primary-400">
                    {{ __('New Calendar') }}
                </a>
            </div>
        </div>
    </div>

    <div id="fullcalendar" class="mt-6"></div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof FullCalendar === 'undefined') {
                console.error('FullCalendar is not loaded');
                return;
            }
            
            var calendarEl = document.getElementById('fullcalendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: @json($events)
            });
            calendar.render();
        });
    </script>
    @endpush
</div>
