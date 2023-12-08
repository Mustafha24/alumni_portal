<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Event Management</title>
    <!-- Include SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Add Event</h2>
        <form id="addEventForm" enctype="multipart/form-data">
            <div class="form-group">
                <label>Title:</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="form-group">
                <label>Schedule:</label>
                <input type="datetime-local" class="form-control" name="schedule">
            </div>
            <div class="form-group">
                <label>Content:</label>
                <textarea class="form-control" name="content"></textarea>
            </div>
            <div class="form-group">
                <label>Banner Image:</label>
                <input type="file" class="form-control-file" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Add Event</button>
        </form>

        <h2 class="mt-4">Events</h2>
        <div id="eventList" class="row"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            function loadEvents() {
                $.ajax({
                    url: 'get_events.php',
                    type: 'POST',
                    data: {
                        get_events: true
                    },
                    success: function(data) {
                        displayEvents(data);
                    }
                });
            }

            $('#addEventForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: 'add_event.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data === "Image uploaded successfully!") {
                            Swal.fire('Success', data, 'success');
                            $('#addEventForm')[0].reset(); // Reset the form upon success
                            loadEvents(); // Reload events after successful upload
                        } else if (data === "Error uploading the image.") {
                            Swal.fire('Error', data, 'error');
                        } else if (data.startsWith('SQL Error')) {
                            Swal.fire('SQL Error', data, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Request failed. Please try again.', 'error');
                    }
                });
            });

            function displayEvents(events) {
                var eventList = $('#eventList');
                eventList.empty();

                $.each(events, function(index, event) {
                    var eventHtml = `
            <div class="col-md-6 mb-4">
                <div class="card">
                    <img src="${event.banner}" class="card-img-top" alt="Banner">
                    <div class="card-body">
                        <h5 class="card-title">${event.title}</h5>
                        <p class="card-text">Schedule: ${event.schedule}</p>
                        <p class="card-text">${event.content}</p>
                        <button class="btn btn-danger delete-btn" data-id="${event.id}">Delete</button>
                    </div>
                </div>
            </div>
        `;
                    eventList.append(eventHtml);
                });

                // Add Click Event for Delete Button
                $(document).on('click', '.delete-btn', function() {
                    var eventId = $(this).data('id');
                    deleteEvent(eventId);
                });
            }

            function deleteEvent(eventId) {
                $.ajax({
                    url: 'delete_event.php',
                    type: 'POST',
                    data: {
                        event_id: eventId
                    },
                    success: function(data) {
                        console.log(data)
                        if (data === "Event deleted successfully!") {
                            Swal.fire('Success', data, 'success');
                            loadEvents(); // Reload events after successful deletion
                        } else {
                            Swal.fire('Error', data, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Request failed. Please try again.', 'error');
                    }
                });
            }

            loadEvents();
        });
    </script>
</body>

</html>