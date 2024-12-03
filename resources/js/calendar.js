import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import axios from 'axios';

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const eventModal = document.getElementById('eventModal');
    const closeModal = document.getElementById('closeModal');
    const eventForm = document.getElementById('eventForm');
    const modalTitle = document.getElementById('modalTitle');
    const addEventButton = document.getElementById('addEventButton');
    const deleteEventButton = document.getElementById('deleteEventButton'); 

    let selectedEvent = null;
    console.log(window.events);
    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        events: window.events,
        timeZone: 'UTC',
        editable: true,
        selectable: true,

        dateClick: function (info) {
            openModal('Afspraak toevoegen', {
                title: '',
                customer_id: '',
                start: info.dateStr + 'T00:00',
                end: '',
                description: '',
            });
        },

        eventClick: function (info) {
            selectedEvent = info.event;
            openModal('Afspraak aanpassen', {
                title: info.event.title,
                start: info.event.start.toISOString().slice(0, 16),
                end: info.event.end ? info.event.end.toISOString().slice(0, 16) : '',
                description: info.event.extendedProps.description || '',
                customer_id: info.event.extendedProps.customer_id || '',
            });
        },
    });

    calendar.render();

    addEventButton.addEventListener('click', function () {
        selectedEvent = null;
        openModal('Afspraak toevoegen', {
            title: '',
            customer_id: '',
            start: '',
            end: '',
            description: '',
        });
    });

    deleteEventButton.addEventListener('click', function () {
        if (selectedEvent) {
            const confirmDelete = window.confirm("Weet je zeker dat je dit event wilt verwijderen?");
            if (confirmDelete) {
                axios.delete(`/events/${selectedEvent.id}`)
                    .then((response) => {
                        selectedEvent.remove();
                        closeModalHandler();
                        alert('Event succesvol verwijderd.');
                    })
                    .catch((error) => {
                        console.error('Error deleting event:', error);
                        alert('Er is iets mis gegaan bij het verwijderen van het event.');
                    });
            }
        }
    });

    closeModal.addEventListener('click', closeModalHandler);

    eventForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const startTime = new Date(document.getElementById('eventStartTime').value);
        const endTime = new Date(document.getElementById('eventEndTime').value);

        if (!startTime || !endTime) {
            alert('Zorg ervoor dat zowel start- als eindtijd zijn ingevuld.');
            return;
        }

        if (endTime && endTime < startTime) {
            alert('Eindtijd kan niet voor de starttijd liggen.');
            return;
        }

        const eventData = {
            title: document.getElementById('eventName').value,
            customer_id: document.getElementById('eventCustomer').value,
            start: document.getElementById('eventStartTime').value,
            end: document.getElementById('eventEndTime').value || null,
            description: document.getElementById('eventDescription').value.trim() || '', 
        };


        if (selectedEvent) {
            axios.put(`/events/${selectedEvent.id}`, eventData)
                .then((response) => {
                    updateEvent(response.data);
                })
                .catch((error) => console.error('Fout aanpassen afsrpaak:', error));
        } else {
            axios.post('/events', eventData)
                .then((response) => {
                    console.log(eventData);
                    addNewEvent(response.data);
                })
                .catch((error) => console.error('Fout aanmaken afspraken:', error));
        }
        closeModalHandler();
    });

    function openModal(title, data) {
        modalTitle.textContent = title;
        document.getElementById('eventName').value = data.title;
        document.getElementById('eventCustomer').value = data.customer_id;
        document.getElementById('eventStartTime').value = data.start;
        document.getElementById('eventEndTime').value = data.end;
        document.getElementById('eventDescription').value = data.description;
        eventModal.classList.remove('hidden');
    }

    function closeModalHandler() {
        eventModal.classList.add('hidden');
        selectedEvent = null; 
    }

    function addNewEvent(eventData) {
        calendar.addEvent({
            id: eventData.id,
            title: eventData.title,
            start: eventData.start,
            end: eventData.end,
            extendedProps: {
                description: eventData.description,
                customer: eventData.customer_id,
            },
        });
    }

    function updateEvent(eventData) {
        selectedEvent.setProp('title', eventData.title);
        selectedEvent.setStart(eventData.start);
        selectedEvent.setEnd(eventData.end);
        selectedEvent.setExtendedProp('description', eventData.description);
        selectedEvent.setExtendendProp('customer', eventData.customer_id);
    }
});