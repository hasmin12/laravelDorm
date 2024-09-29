/*
Template: Hope-Ui - Responsive Bootstrap 5 Admin Dashboard Template
Author: iqonic.design
Design and Developed by: iqonic.design
NOTE: This file contains the all calender events.
*/
"use strict"

if (document.querySelectorAll('#calendar1').length) {
    document.addEventListener('DOMContentLoaded', function () {
        let calendarEl = document.getElementById('calendar1');
        let calendar1 = new FullCalendar.Calendar(calendarEl, {
            selectable: true,
            plugins: ["timeGrid", "dayGrid", "list", "interaction"],
            timeZone: "UTC",
            defaultView: "dayGridMonth",
            contentHeight: "auto",
            eventLimit: true,
            dayMaxEvents: 4,
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek"
            },
            events: '/laundry/getLaundrySchedules',
            dateClick: function (info) {
                // alert('Event: ' + info.dateStr);

                $('#schedule-start-date').val(info.dateStr)
                $('#schedule-end-date').val(info.dateStr)
                $('#date-event').modal('show')
            },
        });
        calendar1.render();
    });
}
