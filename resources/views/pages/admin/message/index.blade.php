@extends('index')

@section('content')
    <form action="{{ route('admin.messages.send') }}" method="POST" class="mt-20">
        @csrf
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required>
        <label for="message">Message:</label>
        <textarea id="message" name="message" required class=""></textarea>
        <button type="submit">Send Message</button>
    </form>
@endsection
