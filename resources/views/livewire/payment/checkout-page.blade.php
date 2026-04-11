@extends('layouts.app')

@section('content')

@livewire('payment.checkout', ['course_id' => $course->id])

@endsection