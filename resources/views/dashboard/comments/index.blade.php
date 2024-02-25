@extends('layouts.dashboard')

@section('top-btn')
    Total: {{ $comments->count() }} Comment{{ $comments->count() > 1 ? 's' : '' }}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle text-center datatable" width="100%" style="min-width: 800px">
                <thead>
                    <tr>
                        <th class="text-center" width="8%">S/N</th>
                        <th class="text-center" width="180px">Name</th>
                        <th>Comment</th>
                        <th class="text-center" width="130px">Status</th>
                        <th class="text-center" width="100px">Date</th>
                        <th class="text-center" width="8%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $comment->user_id ? $comment->user->name : $comment->name }}</td>
                            <td class="text-start">{{ limitString($comment->comment, 250) }}</td>
                            <td>
                                @if ($comment->status == 'Pending')
                                    <select class="form-select status border border-warning" data-id="{{ $comment->id }}">
                                        <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                @else
                                    <span class="bubble bg-{{ $comment->status == 'Approved' ? 'success' : 'danger' }}">{{ $comment->status }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $comment->created_at->format('d-m-Y') }}<br>
                                {{ $comment->created_at->format('h:i A') }}
                            </td>
                            <td>
                                <x-dropdown>
                                    <x-dropdownButton class="comment-delete" icon="trash-can" data-id="{{ $comment->id }}">Delete</x-dropdownButton>
                                </x-dropdown>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('.status').change(function(e) {
            let id = $(this).data('id');
            let status = $(this).val();
            $.ajax({
                type: 'POST',
                url: "{{ route('dashboard.comments.status') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': id,
                    'status': status
                },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    }
                },
            });
        });

        $('.comment-delete').click(function() {
            let id = $(this).data('id');
            let url = "{{ route('dashboard.comments.delete', ':id') }}";
            url = url.replace(':id', id);
            delete_warning(url);
        });
    </script>
@endpush
