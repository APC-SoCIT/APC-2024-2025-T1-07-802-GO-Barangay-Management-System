@extends('admin.dashboard')
<style>
    .container {
        max-width: 100%;
        padding: 20px;
    }

    .card {
        border-radius: 10px;
        border: 1px solid #ddd;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .card-body {
        padding: 20px;
    }

    h1 {
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .btn {
        border-radius: 5px;
        font-weight: 500;
        color: white;
    }

    .btn-primary {
        background-color: #11468F;
        border-color: #11468F;
    }

    .btn-primary:hover {
        background-color: #0D3A73;
    }

    .news-content {
        white-space: pre-wrap; /* Preserve whitespace and wraps text */
    }
</style>

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1>{{ $news->title }}</h1>
            <p><strong>Author:</strong> {{ $news->author }}</p>
            <p><strong>Published Date:</strong> {{ $news->created_at->format('Y-m-d') }}</p>
            @if($news->image)
                <img src="{{ asset('storage/' . $news->image) }}" alt="News Image" class="img-fluid mb-3">
            @endif
            <div class="news-content">
                {!! nl2br(e($news->content)) !!}
            </div>
            <a href="{{ route('admin.news.index') }}" class="btn btn-primary mt-3">Back to News Management</a>
        </div>
    </div>
</div>
@endsection