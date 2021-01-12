@extends('layout.dash')

@section('css')
{{-- FullCalendar --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<style>
    .fc-today {
        color: #000 !important;
        background: #fffadf !important;
    } 
</style>
@endsection

@section('content')
<section>
    <h2 class="mb-4">Holiday</h2>
</section>

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
            <div id='calendar'></div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('js')
    {{-- FullCalendar --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/gcal.min.js" integrity="sha512-X22wrzog4NcL9NM97PKUVhWH4K6MSp9f6iIYHtXkKVwEXZ8GqkWOkLWdBeStyPuuKRkNzkkGVr5v++qMoYM5Fg==" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {

            var SITEURL = "{{ url('/') }}";

            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'prevYear,nextYear'
                },
                editable: false,
                themeSystem: 'bootstrap4',
                googleCalendarApiKey: 'AIzaSyDBWdGRSLYiwYU4OmMAtp4AdrLHabAun5M',
                eventSources: [
                    {
                        googleCalendarId: 'id.indonesian#holiday@group.v.calendar.google.com',
                        color: '#FFC045',
                        textColor: '#000'
                    },
                    {
                        url: SITEURL + "/holiday",
                        color: '#59becd'
                    }
                ],
                displayEventTime: false,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: false,
                selectHelper: false,
            });

        });
    </script>
@endsection