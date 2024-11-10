@extends('Front.frontIndex')

@section('frontSection')

<div class="container">
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <h2>Add New Event</h2>
    <form id="eventForm" action="{{ route('events.storefront') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Event Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
            <span class="text-danger" id="titleError"></span>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
            <span class="text-danger" id="descriptionError"></span>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="datetime-local" name="start_date" id="start_date" class="form-control" required>
            <span class="text-danger" id="startDateError"></span>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="datetime-local" name="end_date" id="end_date" class="form-control" required>
            <span class="text-danger" id="endDateError"></span>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control" required>
            <span class="text-danger" id="locationError"></span>
        </div>
        <div class="form-group">
            <label for="max_participants">Max Participants</label>
            <input type="number" name="max_participants" id="max_participants" class="form-control" required min="1">
            <span class="text-danger" id="maxParticipantsError"></span>
        </div>
        <div class="form-group">
            <label for="image">Event Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            <span class="text-danger" id="imageError"></span>
        </div>
        <button type="submit" class="btn btn-success">Create Event</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const eventForm = document.getElementById('eventForm');
        const requiredFields = document.querySelectorAll('input[required]');
        const startDateInput = document.querySelector("input[name='start_date']");
        const endDateInput = document.querySelector("input[name='end_date']");

        function validateForm() {
            let isValid = true;

            requiredFields.forEach((field) => {
                const errorSpan = document.getElementById(field.name + 'Error');
                if (!field.value) {
                    isValid = false;
                    field.classList.add('is-invalid'); // Add error class
                    errorSpan.textContent = 'Ce champ est requis.'; // Display error message
                } else {
                    field.classList.remove('is-invalid'); // Remove error class
                    errorSpan.textContent = ''; // Clear error message
                }
            });

            // Validate dates
            validateDates();

            return isValid;
        }

        function validateDates() {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);
            const errorSpan = document.getElementById('endDateError');

            if (startDate && endDate && startDate > endDate) {
                endDateInput.classList.add('is-invalid');
                errorSpan.textContent = "La date de fin ne peut pas être antérieure à la date de début."; // Show error message
            } else {
                endDateInput.classList.remove('is-invalid');
                errorSpan.textContent = ''; // Clear error if dates are valid
            }
        }

        // Validate dates on change
        startDateInput.addEventListener("change", validateDates);
        endDateInput.addEventListener("change", validateDates);

        // Handle form submission
        eventForm.addEventListener('submit', function(event) {
            if (!validateForm()) {
                event.preventDefault(); // Prevent submission if validation fails
            }
        });
    });
</script>

@endsection
