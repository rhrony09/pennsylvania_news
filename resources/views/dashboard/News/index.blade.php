@extends('layouts.dashboard')

@section('top-btn')
    <a class="btn btn-primary btn-sm" href="{{ route('dashboard.news.create') }}"><i class="fa fa-plus"></i> Add News</a>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle text-center" width="100%" style="min-width: 800px">
                <thead>
                    <tr>
                        <th class="text-center" width="130px">Image</th>
                        <th width="35%">Title</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Published By</th>
                        <th class="text-center">Published On</th>
                        <th class="text-center" width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_news as $news)
                        <tr>
                            <td><img class="news-thumbnail" src="{{ asset('uploads/news/' . $news->featured_image) . '?v=' . now()->timestamp }}" alt="{{ $news->title }}"></td>
                            <td class="text-start">{{ $news->title }}</td>
                            <td>{{ $news->category ? $news->category->name : '--' }}</td>
                            <td>{{ $news->user ? $news->user->name : '--' }}</td>
                            <td>
                                {{ $news->created_at->format('d-m-Y') }}<br>
                                {{ $news->created_at->format('h:i A') }}
                            </td>
                            <td>
                                <x-dropdown>
                                    <x-dropdown-link icon="eye" link="{{ route('news', $news->slug) }}">View</x-dropdown-link>
                                    <x-dropdown-link icon="pen-to-square" link="{{ route('dashboard.news.edit', $news->id) }}">Edit</x-dropdown-link>
                                    <x-dropdown-button class="news-delete" icon="trash-can" data-id="{{ $news->id }}">Delete</x-dropdown-button>
                                </x-dropdown>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="py-3">
                {{ $all_news->links() }}
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('.news-delete').click(function() {
            let id = $(this).data('id');
            let url = "{{ route('dashboard.news.delete', ':id') }}";
            url = url.replace(':id', id);
            delete_warning(url);
        });
    </script>
@endpush
