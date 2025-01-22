@extends('layout.app')

@section('title', 'Mailing List')

@section('content')
<div class="container">
    <h1>Mailing Lists</h1>
    <form action="{{ route('storeMailingList') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">List Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="emails">Emails (comma-separated)</label>
            <textarea id="emails" name="emails" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Create List</button>
    </form>

    <h2 class="mt-4">Existing Mailing Lists</h2>
    <ul class="list-group">
        @foreach ($mailingLists as $list)
        <li class="list-group-item">
            <strong>{{ $list->name }}</strong>
            <p>{{ implode(', ', json_decode($list->emails, true)) }}</p>
        </li>
        @endforeach
    </ul>
</div>
@endsection
