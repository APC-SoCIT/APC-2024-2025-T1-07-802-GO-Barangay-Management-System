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

    /* Content Styling */
    .content-container {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Labels */
    .content-container label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
        font-size: 18px; /* Larger font size for labels */
    }

    /* Paragraphs */
    .content-container p {
        margin: 5px 0 15px 0;
        font-size: 16px;
        color: #333;
        background-color: #f9f9f9; /* Light grey background */
        padding: 10px; /* Add padding for better spacing */
        border-radius: 5px; /* Rounded corners */
        border: 1px solid #eee; /* Light border for definition */
    }

    /* Image */
    .content-container img {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        margin-top: 10px;
    }
</style>

@section('content')
<div class="news-container">
    <!-- Back Button -->
    <button class="back-button" onclick="window.history.back()">Back</button>

    <!-- Page Header -->
    <div class="header-container">
        <h1>News Details</h1>
    </div>

    <!-- Content Container -->
    <div class="content-container">
        <!-- Title -->
        <label for="title">Title:</label>
        <p>{{ $news->title }}</p>

        <!-- Author -->
        <label for="author">Author:</label>
        <p>{{ $news->author }}</p>

        <!-- Content -->
        <label for="content">Content:</label>
        <p>{!! nl2br(e($news->content)) !!}</p>

        <!-- Image -->
        <label for="image">Image:</label>
        @if($news->image)
            <img src="{{ asset('storage/' . $news->image) }}" alt="News Image">
        @else
            <p>No image available.</p>
        @endif
    </div>
</div>
@endsection