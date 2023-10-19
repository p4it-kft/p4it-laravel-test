@extends('main')
@section('content')

<form method="POST" action="{{ route('message.store') }}">
    @csrf

    <div class="form-group">
        <label for="name">Name</label>

        <input id="name" type="text" name="name" class="@error('name') is-invalid @enderror">
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="title">Title</label>

        <input id="title" type="text" name="title" class="@error('title') is-invalid @enderror">
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="text">Text</label>

        <textarea id="text" name="text" class="@error('text') is-invalid @enderror" ></textarea>
        @error('text')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Submit</button>
</form>

@endsection
