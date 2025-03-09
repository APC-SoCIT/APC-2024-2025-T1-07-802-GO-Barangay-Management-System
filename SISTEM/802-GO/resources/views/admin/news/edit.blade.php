@extends('admin.dashboard')
<style>
    .news-container {
        width: 100%;
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        position: relative; /* For positioning the back button */
    }

    /* Back Button Styling */
    .back-button {
        position: absolute;
        top: 20px;
        left: 20px;
        background-color: #11468F;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .back-button:hover {
        background-color: #0d3a75;
    }

    /* Header Styling */
    .header-container {
        background-color: #f4f4f4;
        padding: 15px;
        border-radius: 10px;
        text-align: center;
        margin-bottom: 20px;
    }

    .header-container h1 {
        font-size: 28px;
        font-weight: bold;
        margin: 0;
    }

    /* Form Styling */
    .form-container {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Labels */
    .form-container label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }

    /* Inputs & Textarea */
    .form-container input[type="text"],
    .form-container textarea,
    .form-container input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Dynamic Textarea */
    .form-container textarea.dynamic-textarea {
        resize: none; /* Disable manual resizing */
        overflow: hidden; /* Hide scrollbars */
        min-height: 100px; /* Set a minimum height */
    }

    /* Create Button */
    .create-btn {
        width: 100%;
        background-color: #11468F;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        margin-top: 15px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .create-btn:hover {
        background-color: #0d3a75;
    }
</style>

@section('content')
<div class="news-container">
    <!-- Back Button -->
    <button class="back-button" onclick="window.history.back()">Back</button>

    <!-- Page Header -->
    <div class="header-container">
        <h1>Edit News</h1>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use PUT method for updates -->

            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="{{ $news->title }}" required>

            <label for="content">Content:</label>
            <textarea name="content" id="content" class="dynamic-textarea" required>{{ $news->content }}</textarea>

            <label for="author">Author:</label>
            <input type="text" name="author" id="author" value="{{ $news->author }}" required>

            <label for="image">Image:</label>
            <input type="file" name="image" id="image">
            @if($news->image)
                <p>Current Image: <img src="{{ asset('storage/' . $news->image) }}" alt="News Image" style="max-width: 200px;"></p>
            @endif

            <button type="submit" class="create-btn">Update</button>
        </form>
    </div>
</div>

<!-- Add JavaScript to dynamically resize the textarea -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const textarea = document.getElementById('content');

        // Function to adjust the height of the textarea
        const adjustTextareaHeight = () => {
            textarea.style.height = 'auto'; // Reset height
            textarea.style.height = textarea.scrollHeight + 'px'; // Set height to fit content
        };

        // Adjust height on input
        textarea.addEventListener('input', adjustTextareaHeight);

        // Adjust height on page load (if content is pre-filled)
        adjustTextareaHeight();
    });
</script>
@endsection