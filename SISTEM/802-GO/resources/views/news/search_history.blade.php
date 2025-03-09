@section('content')
<div class="text-section">
    <h1>SEARCH HISTORY</h1>
</div>

<div class="container_1">
    <ul>
        @foreach ($searchHistory as $search)
            <li>{{ $search }}</li>
        @endforeach
    </ul>
</div>
@endsection