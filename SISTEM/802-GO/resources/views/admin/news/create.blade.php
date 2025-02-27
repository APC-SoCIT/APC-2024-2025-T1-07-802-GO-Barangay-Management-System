@extends('admin.dashboard')
<style>
    .news-container {
    width: 100%;
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
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
    <!-- Page Header -->
    <div class="header-container">
        <h1>Create New News</h1>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="content">Content:</label>
            <textarea name="content" id="content" required></textarea>

            <label for="author">Author:</label>
            <input type="text" name="author" id="author" required>

            <label for="image">Image:</label>
            <input type="file" name="image" id="image">

            <button type="submit" class="create-btn">Create</button>
        </form>
    </div>
</div>
@endsection
