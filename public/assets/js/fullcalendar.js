$(function() {
  var calendarEl = document.getElementById('fullcalendar');
  var roomEvents = window.roomEvents; // Lấy roomEvents từ global scope
  var calendar = null;
  console.log(roomEvents)
  function filterEvents(bookingType) {
      if(bookingType === 'all')
      {
         return roomEvents;
      }
      return roomEvents.filter(function (event) {
          if (bookingType === 'all-day') {
              return event.backgroundColor === 'rgba(1,104,250, .5)';
          } else if (bookingType === 'morning') {
              return event.backgroundColor === 'rgba(16,183,89, .5)';
          } else if (bookingType === 'afternoon') {
              return event.backgroundColor === 'rgba(241,0,117,.5)';
          } else if (bookingType === 'evening') {
              return event.backgroundColor === 'rgba(0,204,204,.5)';
          }
          return true;
      });
  }
  function initializeCalendar(events){
      calendar = new FullCalendar.Calendar(calendarEl, {
          headerToolbar: {
              left: "prev,today,next",
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
          },
          editable: false,
          droppable: false,
          fixedWeekCount: true,
          initialView: 'dayGridMonth',
          timeZone: 'UTC',
          hiddenDays: [],
          navLinks: true,
          dayMaxEvents: 2,
          events: events,
          eventClick: function(info) {
          var eventObj = info.event;
          console.log(eventObj);
          $('#modalTitle1').html(eventObj.title);
        
          let description = eventObj._def.extendedProps.description ? eventObj._def.extendedProps.description : 'No description';
          let start = eventObj.start ? eventObj.start.toLocaleString() : 'N/A';
          let end = eventObj.end ? eventObj.end.toLocaleString() : 'N/A';
        
            let modalBodyContent = `
                <p class="pb-12"><strong>Booking info:</strong></p>
                <p class="pb-12"><strong>Title:</strong> ${eventObj.title}</p>
                <p class="pb-12"><strong>Description:</strong> ${description}</p>
                <p class="pb-12"><strong>Start:</strong> ${start}</p>
                <p class="pb-12"><strong>End:</strong> ${end}</p>

                <p class="pt-24 pb-12"><strong>Customer info:</strong></p>
                <p class="pb-12"><strong>Name:</strong> ${eventObj._def.extendedProps.userName}</p>
                <p class="pb-12"><strong>Email:</strong> ${eventObj._def.extendedProps.userEmail}</p>
                <p class="pb-12"><strong>Phone:</strong> ${eventObj._def.extendedProps.userPhone}</p>

                <p class="pt-24 pb-12"><strong>Transaction info:</strong></p>
                <p class="pb-12"><strong>Payment method:</strong> ${eventObj._def.extendedProps.transaction_payment_method}</p>
                <p class="pb-12"><strong>Total price:</strong> ${eventObj._def.extendedProps.transaction_totalPrice}</p>
            `;
            $('#modalBody1').html(modalBodyContent);
            $('#fullCalModal').modal("show");
          },
          dateClick: function(info) {
            $("#createEventModal").modal("show");
              console.log(info);
          },
        });

      calendar.render();
  }
  initializeCalendar(filterEvents('all'));
  $('#myTab a').on('click', function (e) {
    e.preventDefault()
    var bookingType = $(this).data('booking-type')
    var filteredEvents = filterEvents(bookingType)
    if (calendar){
         calendar.destroy();
    }
    initializeCalendar(filteredEvents);
  })
});