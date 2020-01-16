
<!--region Request data-->
<?php

$events = array();

for ($x = 1; $x <= 3; $x++) {

    $events[] = array (
        'id'    =>  $x,
        'title'    =>  'the title',
        'start'    =>  '2020-01-18',
        'allDay'    =>  false,
        'className'    =>  'bg-red',
        'description'    =>  'bg-red',

    );
} ?>
<!--endregion-->

<!--region Calendar-->
<div class="">
    <div class="header header-dark bg-primary pb-6 content__title content__title--calendar">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6">
                        <h6 class="fullcalendar-title h2 text-white d-inline-block mb-0">Full calendar</h6>
                    </div>
                    <div class="col-lg-6 mt-3 mt-lg-0 text-lg-right">
                        <a href="#" class="fullcalendar-btn-prev btn btn-sm btn-neutral">
                            <i class="fas fa-angle-left"></i>
                        </a>
                        <a href="#" class="fullcalendar-btn-next btn btn-sm btn-neutral">
                            <i class="fas fa-angle-right"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="month">Mois</a>
                        <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek">Semaines</a>
                        <a href="#" class="btn btn-sm btn-neutral d-none d-sm-inline" data-calendar-view="basicDay">Jour</a>
                        <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="today">Ajourd'hui</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="mt--6">
        <div class="row">
            <div class="col">
                <!-- Fullcalendar -->
                <div class="card card-calendar">
                    <!-- Card header -->
                    <div class="card-header">
                        <!-- Title -->
                        <h5 class="h3 mb-0">Disponibilités</h5>
                    </div>
                    <!-- Card body -->
                    <div class="card-body p-0">
                        <div class="calendar" data-toggle="calendar" id="calendar"></div>
                    </div>
                </div>
                <!-- Modal - Add new event -->
                <!--* Modal header *-->
                <!--* Modal body *-->
                <!--* Modal footer *-->
                <!--* Modal init *-->
                <div class="modal fade" id="new-event" tabindex="-1" role="dialog" aria-labelledby="new-event-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-secondary" role="document">
                        <div class="modal-content">
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form class="new-event--form">
                                    <div class="form-group">
                                        <label class="form-control-label">Event title</label>
                                        <input type="text" class="form-control form-control-alternative new-event--title" placeholder="Event Title">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="form-control-label d-block mb-3">Status color</label>
                                        <div class="btn-group btn-group-toggle btn-group-colors event-tag" data-toggle="buttons">
                                            <label class="btn bg-info active"><input type="radio" name="event-tag" value="bg-info" autocomplete="off" checked></label>
                                            <label class="btn bg-warning"><input type="radio" name="event-tag" value="bg-warning" autocomplete="off"></label>
                                            <label class="btn bg-danger"><input type="radio" name="event-tag" value="bg-danger" autocomplete="off"></label>
                                            <label class="btn bg-success"><input type="radio" name="event-tag" value="bg-success" autocomplete="off"></label>
                                            <label class="btn bg-default"><input type="radio" name="event-tag" value="bg-default" autocomplete="off"></label>
                                            <label class="btn bg-primary"><input type="radio" name="event-tag" value="bg-primary" autocomplete="off"></label>
                                        </div>
                                    </div>
                                    <input type="hidden" class="new-event--start" />
                                    <input type="hidden" class="new-event--end" />
                                </form>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary new-event--add">Add event</button>
                                <button type="button" class="btn btn-link ml-auto" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal - Edit event -->
                <!--* Modal body *-->
                <!--* Modal footer *-->
                <!--* Modal init *-->
                <div class="modal fade" id="edit-event" tabindex="-1" role="dialog" aria-labelledby="edit-event-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-secondary" role="document">
                        <div class="modal-content">
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form class="edit-event--form">
                                    <div class="form-group">
                                        <label class="form-control-label">Event title</label>
                                        <input type="text" class="form-control form-control-alternative edit-event--title" placeholder="Event Title">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label d-block mb-3">Status color</label>
                                        <div class="btn-group btn-group-toggle btn-group-colors event-tag mb-0" data-toggle="buttons">
                                            <label class="btn bg-info active"><input type="radio" name="event-tag" value="bg-info" autocomplete="off" checked></label>
                                            <label class="btn bg-warning"><input type="radio" name="event-tag" value="bg-warning" autocomplete="off"></label>
                                            <label class="btn bg-danger"><input type="radio" name="event-tag" value="bg-danger" autocomplete="off"></label>
                                            <label class="btn bg-success"><input type="radio" name="event-tag" value="bg-success" autocomplete="off"></label>
                                            <label class="btn bg-default"><input type="radio" name="event-tag" value="bg-default" autocomplete="off"></label>
                                            <label class="btn bg-primary"><input type="radio" name="event-tag" value="bg-primary" autocomplete="off"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        <textarea class="form-control form-control-alternative edit-event--description textarea-autosize" placeholder="Event Desctiption"></textarea>
                                        <i class="form-group--bar"></i>
                                    </div>
                                    <input type="hidden" class="edit-event--id">
                                </form>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button class="btn btn-primary" data-calendar="update">Update</button>
                                <button class="btn btn-danger" data-calendar="delete">Delete</button>
                                <button class="btn btn-link ml-auto" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--endregion-->

<!--region Js-->
<script>

    $(document).ready(function() {
        let $calendar = $('#calendar');

        // Init
        function init($this) {

            // Calendar events

            let events = [
                    <?php foreach($events as $key=>$event):

                    ?>
                    {
                        id: '<?php echo $event['id']; ?>',
                        title: '<?php echo $event['title']; ?>',
                        start: '<?php echo $event['start']; ?>',
                        allDay: '<?php echo $event['allDay']; ?>',
                        className: '<?php echo $event['className']; ?>',
                        description: '<?php echo $event['description']; ?>',
                    },
                    <?php endforeach; ?>

                ],

                options = {
                    header: {
                        right: '',
                        center: '',
                        left: ''
                    },
                    buttonIcons: {
                        prev: 'calendar--prev',
                        next: 'calendar--next'
                    },
                    theme: false,
                    locale: 'fr',
                    selectable: true,
                    selectHelper: true,
                    editable: true,
                    events: events,

                    dayClick: function(date) {
                        let isoDate = moment(date).toISOString();
                        $('#new-event').modal('show');
                        $('.new-event--title').val('');
                        $('.new-event--start').val(isoDate);
                        $('.new-event--end').val(isoDate);
                    },

                    viewRender: function(view) {
                        let calendarDate = $this.fullCalendar('getDate');
                        let calendarMonth = calendarDate.month();

                        //Set data attribute for header. This is used to switch header images using css
                        // $this.find('.fc-toolbar').attr('data-calendar-month', calendarMonth);

                        //Set title in page header
                        $('.fullcalendar-title').html(view.title);
                    },

                    // Edit calendar event action

                    eventClick: function(event, element) {
                        $('#edit-event input[value=' + event.className + ']').prop('checked', true);
                        $('#edit-event').modal('show');
                        $('.edit-event--id').val(event.id);
                        $('.edit-event--title').val(event.title);
                        $('.edit-event--description').val(event.description);
                    }
                };

            // Initalize the calendar plugin
            $this.fullCalendar(options);


            //
            // Calendar actions
            //


            //Add new Event

            $('body').on('click', '.new-event--add', function() {
                let eventTitle = $('.new-event--title').val();

                // Generate ID
                let GenRandom = {
                    Stored: [],
                    Job: function() {
                        let newId = Date.now().toString().substr(6); // or use any method that you want to achieve this string

                        if (!this.Check(newId)) {
                            this.Stored.push(newId);
                            return newId;
                        }
                        return this.Job();
                    },
                    Check: function(id) {
                        for (let i = 0; i < this.Stored.length; i++) {
                            if (this.Stored[i] == id) return true;
                        }
                        return false;
                    }
                };

                if (eventTitle != '') {
                    $this.fullCalendar('renderEvent', {
                        id: GenRandom.Job(),
                        title: eventTitle,
                        start: $('.new-event--start').val(),
                        end: $('.new-event--end').val(),
                        allDay: true,
                        className: $('.event-tag input:checked').val()
                    }, true);

                    $('.new-event--form')[0].reset();
                    $('.new-event--title').closest('.form-group').removeClass('has-danger');
                    $('#new-event').modal('hide');
                } else {
                    $('.new-event--title').closest('.form-group').addClass('has-danger');
                    $('.new-event--title').focus();
                }
            });


            //Update/Delete an Event
            $('body').on('click', '[data-calendar]', function() {
                let calendarAction = $(this).data('calendar');
                let currentId = $('.edit-event--id').val();
                let currentTitle = $('.edit-event--title').val();
                let currentDesc = $('.edit-event--description').val();
                let currentClass = $('#edit-event .event-tag input:checked').val();
                let currentEvent = $this.fullCalendar('clientEvents', currentId);

                //Update
                if (calendarAction === 'update') {
                    if (currentTitle != '') {
                        currentEvent[0].title = currentTitle;
                        currentEvent[0].description = currentDesc;
                        currentEvent[0].className = [currentClass];

                        console.log(currentClass);
                        $this.fullCalendar('updateEvent', currentEvent[0]);
                        $('#edit-event').modal('hide');
                    } else {
                        $('.edit-event--title').closest('.form-group').addClass('has-error');
                        $('.edit-event--title').focus();
                    }
                }

                //Delete
                if (calendarAction === 'delete') {
                    $('#edit-event').modal('hide');

                    // Show confirm dialog
                    setTimeout(function() {
                        swal({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            type: 'warning',
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonClass: 'btn btn-danger',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonClass: 'btn btn-secondary'
                        }).then((result) => {
                            if (result.value) {
                                // Delete event
                                $this.fullCalendar('removeEvents', currentId);

                                // Show confirmation
                                swal({
                                    title: 'Deleted!',
                                    text: 'The event has been deleted.',
                                    type: 'success',
                                    buttonsStyling: false,
                                    confirmButtonClass: 'btn btn-primary'
                                });
                            }
                        })
                    }, 200);
                }
            });


            //Calendar views switch
            $('body').on('click', '[data-calendar-view]', function(e) {
                e.preventDefault();

                $('[data-calendar-view]').removeClass('active');
                $(this).addClass('active');

                let calendarView = $(this).attr('data-calendar-view');
                $this.fullCalendar('changeView', calendarView);
            });


            //Calendar Next
            $('body').on('click', '.fullcalendar-btn-next', function(e) {
                e.preventDefault();
                $this.fullCalendar('next');
            });


            //Calendar Prev
            $('body').on('click', '.fullcalendar-btn-prev', function(e) {
                e.preventDefault();
                $this.fullCalendar('prev');
            });
        }


        //
        // Events
        //

        // Init
        if ($calendar.length) {
            init($calendar);
        }

    });
</script>
<!--endregion-->


