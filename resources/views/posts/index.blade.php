@extends('layout')

@section('title', 'All Blog Posts')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center">All Blog Posts</h1>

    @if($posts->isEmpty())
    <div class="alert alert-warning text-center" role="alert">
        No posts available at the moment.
    </div>
    @else
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-6 col-sm-12 mb-4"> <!-- Responsive columns -->
            <div class="card shadow-sm border-0  h-100" > <!-- Ensure full height -->
                <div class="row g-0 h-100">
                    <div class="col-md-8 d-flex flex-column"> <!-- Vertical alignment -->
                        <div class="card-body flex-grow-1 d-flex flex-column"> <!-- Flex column for card body -->
                            <h5 class="card-title" style="min-height: 60px;">{{ $post->title }}</h5> <!-- Fixed height for title -->
                            <p class="card-text" style="min-height: 40px;">{!! Str::limit(strip_tags(preg_replace('/<img[^>]+\>/i', '', $post->content)), 50) !!}</p> <!-- Fixed height for content -->
                            <small class="text-muted">Posted on {{ $post->created_at->format('M d, Y') }}</small>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-2">
                            <div class="btn-group" role="group"> <!-- Button group for better alignment -->
                                <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary">Continue reading</a>
                                @if(Auth::check() && Auth::user()->usertype === 'admin') <!-- Show Edit and Delete buttons only for admins -->
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                        <img src="https://placehold.co/400" class="img-fluid rounded-start" alt="Placeholder image" /> <!-- Placeholder image -->
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="row">
        <div class="col text-center">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    {{-- Previous Page Link --}}
                    @if ($posts->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $posts->previousPageUrl() }}" rel="prev">Previous</a>
                    </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @for ($i = 1; $i <= $posts->lastPage(); $i++)
                        @if ($i == $posts->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $i }}</span>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $posts->url($i) }}">{{ $i }}</a>
                        </li>
                        @endif
                    @endfor

                    {{-- Next Page Link --}}
                    @if ($posts->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $posts->nextPageUrl() }}" rel="next">Next</a>
                    </li>
                    @else
                    <li class="page-item disabled">
                        <span class="page-link">Next</span>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
    @endif
</div>
@endsection

@section('styles')
<style>
    .card {
        transition: transform 0.3s, box-shadow 0.3s; /* Smooth transition for hover effects */
    }

    .card:hover {
        transform: translateY(-5px); /* Lift card on hover */
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2); /* Increase shadow on hover */
    }

    .btn {
        transition: background-color 0.3s, transform 0.3s; /* Smooth transition for button hover */
    }

    .btn:hover {
        transform: scale(1.05); /* Slightly enlarge buttons on hover */
    }

    /* Additional styling for button colors */
    .btn-primary {
        background-color: #007bff; /* Bootstrap primary color */
        border: none; /* Remove border */
    }

    .btn-warning {
        background-color: #ffc107; /* Bootstrap warning color */
        border: none; /* Remove border */
    }

    .btn-danger {
        background-color: #dc3545; /* Bootstrap danger color */
        border: none; /* Remove border */
    }
</style>
@endsection
