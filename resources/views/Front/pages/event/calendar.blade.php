<!DOCTYPE html>
<html>
<head>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
@extends('Front.frontIndex')
@section('frontSection')
<body>
<br/><br/><br/><br/><br/><br/><br/>

<button id="exportExcel"><i class="fas fa-file-excel"></i>export en Excel</button>

    <div id='calendar'></div>
    <style>
        #calendar {
            max-width: 80%;
            margin: 0 auto;
            height: 600px;
        }
        #exportExcel {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 24px; /* Taille de l'icône */
            color: #007bff; /* Couleur de l'icône */
        }
    </style>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/calender',  
                eventDisplay: 'auto',
                eventDidMount: function(info) {
                    var now = new Date();
                    var eventEnd = new Date(info.event.end);
                    
                    if (eventEnd < now) {
                        // Événement passé
                        info.el.style.backgroundColor = '#f08080'; // Couleur pour les événements passés
                    } else if (info.event.extendedProps.createdByUser) {
                        // Événement créé par l'utilisateur
                        info.el.style.backgroundColor = '#90ee90'; // Couleur pour les événements créés
                    }

                    // Événement passé et créé par l'utilisateur
                    if (eventEnd < now && info.event.extendedProps.createdByUser) {
                        info.el.style.backgroundColor = '#ffd700'; // Couleur pour les événements passés créés par l'utilisateur
                    }
                }
            });
            calendar.render();

            // Exporter en Excel
            document.getElementById('exportExcel').addEventListener('click', function() {
                var events = [];
                calendar.getEvents().forEach(event => {
                    events.push({
                        id: event.id,
                        title: event.title,
                        start: event.start.toISOString().slice(0, 10),
                        end: event.end ? event.end.toISOString().slice(0, 10) : ''
                    });
                });

                // Créer un fichier Excel avec SheetJS
                var ws = XLSX.utils.json_to_sheet(events);
                var wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, 'Calendar Events');

                // Exporter le fichier Excel
                XLSX.writeFile(wb, 'calendar_events.xlsx');
            });
        });
    </script>

@endsection
