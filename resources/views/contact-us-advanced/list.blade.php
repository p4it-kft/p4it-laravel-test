@php
/** @var $messageForms \App\Models\MessageForm[] */
@endphp

@extends('main')
@section('content')

<a href="{{ route('message.create-advanced') }}">Create a message</a>

<p>Message list</p>

<ul>
@foreach($messageForms as $messageForm)
    <li><a href="{{ route('message.update-advanced', $messageForm->id) }}">{{ $messageForm }}</a></li>
@endforeach
</ul>

@endsection
