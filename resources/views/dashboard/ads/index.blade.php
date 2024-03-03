@extends('layouts.dashboard')

@section('top-btn')
    <button class="btn btn-primary btn-sm" id="addAd"><i class="fa fa-plus"></i> Add New</button>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle text-center datatable" width="100%" style="min-width: 800px">
                <thead>
                    <tr>
                        <th class="text-center" width="8%">S/N</th>
                        <th class="text-center" width="250px">Image</th>
                        <th class="text-center">Size</th>
                        <th class="text-center" width="180px">Status</th>
                        <th class="text-center" width="180px">Published On</th>
                        <th class="text-center" width="8%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ads->sortByDesc('created_at') as $ad)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img class="ads-thumbnail" src="{{ asset('uploads/ads/' . $ad->image) . '?v=' . now()->timestamp }}" alt="ad"></td>
                            <td>{{ $ad->size }}</td>
                            <td>
                                <select class="form-select status border border-{{ $ad->status == 'Published' ? 'success' : 'danger' }}" data-id="{{ $ad->id }}">
                                    <option value="Published" {{ $ad->status == 'Published' ? 'selected' : '' }}>Published</option>
                                    <option value="Unpublished" {{ $ad->status == 'Unpublished' ? 'selected' : '' }}>Unpublished</option>
                                </select>
                            </td>
                            <td>
                                {{ $ad->created_at->format('d-m-Y') }}<br>
                                {{ $ad->created_at->format('h:i A') }}
                            </td>
                            <td>
                                <x-dropdown>
                                    <x-dropdown-button class="ad-view" icon="eye" data-id="{{ $ad->id }}">View</x-dropdown-button>
                                    <x-dropdown-button class="ad-edit" icon="pencil-alt" data-id="{{ $ad->id }}">Edit</x-dropdown-button>
                                    <x-dropdown-button class="ad-delete" icon="trash-can" data-id="{{ $ad->id }}">Delete</x-dropdown-button>
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
        $('#addAd').click(function() {
            $('#rhModal').modal('show');
            let url = "{{ route('dashboard.ads.create') }}";
            $.ajax({
                method: 'GET',
                url: url,
                success: function(response) {
                    $('#rhModal .modal-content').html(response);
                }
            });
        });

        $('.ad-view').click(function() {
            $('#rhModal').modal('show');
            let id = $(this).data('id');
            let url = "{{ route('dashboard.ads.show', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                method: 'GET',
                url: url,
                success: function(response) {
                    $('#rhModal .modal-content').html(response);
                }
            });
        });

        $('.ad-edit').click(function() {
            $('#rhModal').modal('show');
            let id = $(this).data('id');
            let url = "{{ route('dashboard.ads.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                method: 'GET',
                url: url,
                success: function(response) {
                    $('#rhModal .modal-content').html(response);
                }
            });
        });

        $('.status').change(function(e) {
            let id = $(this).data('id');
            let status = $(this).val();
            $.ajax({
                type: 'POST',
                url: "{{ route('dashboard.ads.status') }}",
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

        $('.ad-delete').click(function() {
            let id = $(this).data('id');
            let url = "{{ route('dashboard.ads.delete', ':id') }}";
            url = url.replace(':id', id);
            delete_warning(url);
        });
    </script>
@endpush
