@extends('Front.frontIndex')

@section('frontSection')

<div class="container">
<br/>
<br/>
<br/>
<br/>
<br/>
    <h2>Add New Event</h2>
    <form action="{{ route('events.storefront') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Event Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="datetime-local" name="start_date" id="start_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="datetime-local" name="end_date" id="end_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="max_participants">Max Participants</label>
            <input type="number" name="max_participants" id="max_participants" class="form-control" required min="1">
        </div>
        <div class="form-group">
            <label for="image">Event Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success">Create Event</button>
    </form>
</div>

@endsection
