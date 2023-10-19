@php use App\Models\MessageForm; @endphp

@php /** @var MessageForm $messageForm */ @endphp

@extends('main')

@if(Session::has('message'))
    <p class="alert alert-info">{{ Session::get('message') }}</p>
@endif

@section('content')

<h2><a href="{{ route('message.list-advanced') }}">List</a></h2>

{!! Form::model($messageForm, ['route' => ['message.store-advanced', $messageForm->id]]) !!}

    <div class="form-group">
        {!! Form::label('name') !!}
        {!! Form::text('name') !!}

        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('title') !!}
        {!! Form::text('title') !!}

        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('text') !!}
        {!! Form::textarea('text', null, ['cols' => 20, 'rows' => 3]) !!}

        @error('text')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('email') !!}
        {!! Form::email('email') !!}

        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('tags') !!}
        {!! Form::select('tags', $tags, null, ['multiple' => true, 'size' => 10, 'name' => 'tags[]']) !!}
{{--        {!! Form::select('tag', $tags, $messageForm->tags, ['placeholder' => '', 'multiple' => true, 'size' => 10]) !!}--}}

        @error('tags')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    {!! Form::submit('Submit') !!}

{!! Form::close() !!}

@endsection
