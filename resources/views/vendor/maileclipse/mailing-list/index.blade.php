@extends('maileclipse::layout.app')

@section('title', 'Mail Lists')

@section('content')

<div class="col-lg-10 col-md-12">

    <div class="card my-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5>{{ __('Mail Lists') }}</h5>
            <a class="btn btn-primary" href="#newMailListModal" data-toggle="modal" data-target="#newMailListModal">
                {{ __('Add Mail List') }}
            </a>
        </div>

        @if ($errors->has('emails'))
            <div class="alert alert-danger">
                {{ $errors->first('emails') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($mailLists->isEmpty())
            <div class="alert alert-info mt-4">{{ __("No mail lists found.") }}</div>
        @else
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>{{ __('List Name') }}</th>
                    <th>{{ __('Emails') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mailLists as $list)
                <tr>
                    <td>{{ $list->name }}</td>
                    <td>{{ implode(', ', json_decode($list->emails)) }}</td>
                    <td>
                        <button class="btn btn-danger btn-sm remove-list" data-list-id="{{ $list->id }}">
                            {{ __('Delete') }}
                        </button>
                        <button class="btn btn-secondary btn-sm copy-list" data-emails="{{ implode(', ', json_decode($list->emails)) }}">
                            <!-- Copy SVG Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                                <path d="M10 1.5v1H6v-1a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5z"/>
                                <path d="M9.5 0a1.5 1.5 0 0 1 1.415 1H13a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-4v-1h4a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-2.085a1.5 1.5 0 0 1-2.83 0H3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h4v1H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h2.085A1.5 1.5 0 0 1 9.5 0z"/>
                                <path d="M5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h6a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5H5z"/>
                            </svg>
                            {{ __('Copy') }}
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newMailListModal" tabindex="-1" role="dialog" aria-labelledby="newMailListModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="create_mail_list" action="{{ route('storeMailingList') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('New Mail List') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="listName">{{ __('List Name') }}</label>
                            <input type="text" class="form-control" id="listName" name="name" placeholder="{{ __('Enter List Name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="emails">{{ __('Emails (comma-separated or newline-separated)') }}</label>
                            <textarea class="form-control" id="emails" name="emails" rows="3" placeholder="{{ __('Enter emails separated by commas or new lines') }}" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Create Mail List') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Silme işlemi
    document.querySelectorAll('.remove-list').forEach(button => {
        button.addEventListener('click', function () {
            const listId = this.getAttribute('data-list-id');

            if (confirm('Are you sure you want to delete this mail list?')) {
                axios.post('{{ route('deleteMailingList') }}', {
                    id: listId,
                })
                .then(response => {
                    if (response.data.status === 'ok') {
                        location.reload();
                    }
                })
                .catch(error => {
                    alert('Error deleting the mail list.');
                });
            }
        });
    });

    // Kopyalama işlemi
    document.querySelectorAll('.copy-list').forEach(button => {
        button.addEventListener('click', function () {
            const emails = this.getAttribute('data-emails');
            navigator.clipboard.writeText(emails).then(() => {
                alert('Emails copied to clipboard!');
            }).catch(err => {
                alert('Failed to copy emails: ' + err);
            });
        });
    });
</script>

@endsection
