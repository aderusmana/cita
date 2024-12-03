<x-app-layout>
    @section('title')
        My Favorite Ideas
    @endsection

    @push('css')
    @endpush

    <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
        <div class="card-body px-0">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="font-weight-medium mb-0 ml-3">My Favorite Ideas</h1>
                <nav aria-label="breadcrumb mr-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item text-muted" aria-current="page">My Favorite Ideas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="widget-content searchable-container list">
        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('ideas.index') }}" class="mb-3 d-flex align-items-center">
            <input type="text" name="search" class="form-control w-25" placeholder="Cari judul atau deskripsi..."
                value="{{ request('search') }}">
            @if (request('search'))
                <button type="button" class="btn btn-link text-decoration-none btn-lg"
                    onclick="document.querySelector('input[name=search]').value=''; this.form.submit();">
                    &times;
                </button>
            @endif
        </form>

        <ul class="nav nav-pills p-3 mb-3 rounded align-items-center card flex-row">
            <li class="nav-item">
                <a href="javascript:void(0)"
                    class="nav-link gap-6 note-link d-flex align-items-center justify-content-center active px-3 px-md-3 me-0 me-md-2 fs-11"
                    id="all-category">
                    <i class="ti ti-list fill-white"></i>
                    <span class="d-none d-md-block fw-medium">All</span>
                </a>
            </li>
            @foreach ($categories as $category)
                <li class="nav-item">
                    <a href="javascript:void(0)"
                        class="nav-link gap-6 note-link d-flex align-items-center justify-content-center px-3 px-md-3 me-0 me-md-2 fs-11"
                        id="note-{{ $category->id }}" data-bs-toggle="tooltip" title="{{ $category->name }}">
                        <i class="ti ti-briefcase fill-white"></i>
                        <span class="d-none d-md-block fw-medium">{{ $category->name }}</span>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content">
            <div id="note-full-container" class="note-has-grid row">
                @foreach ($ideas as $idea)
                    <div class="col-md-3 single-note-item all-category note-{{ $idea->category_id }}">
                        <div class="card card-body">
                            <span class="side-stick"
                                style="background-color:
                            @if ($idea->category_id == 1) var(--bs-primary)
                            @elseif($idea->category_id == 2)
                                var(--bs-danger)
                            @elseif($idea->category_id == 3)
                                var(--bs-warning)
                            @elseif($idea->category_id == 4)
                                var(--bs-success) @endif
                        "></span>
                            <h6 class="note-title text-truncate w-75 mb-0" data-noteheading="{{ $idea->title }}">
                                {{ $idea->title }} </h6>
                            <p class="note-date fs-2">{{ $idea->created_at->format('d M Y') }}</p>
                            <div class="note-content">
                                <p class="note-inner-content" data-notecontent="{{ $idea->description }}">
                                    @if (strlen($idea->description) > 100)
                                        {!! substr($idea->description, 0, 100) !!}... <a href="javascript:void(0)" class="read-more"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editIdeaModal{{ $idea->id }}">Read More</a>
                                    @else
                                        {!! $idea->description !!}
                                    @endif
                                </p>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="javascript:void(0)" class="link me-1 like-button"
                                    data-idea-id="{{ $idea->id }}">
                                    @if ($idea->isLikedByUser())
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="red"
                                            class="icon icon-tabler icons-tabler-filled icon-tabler-heart">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M6.979 3.074a6 6 0 0 1 4.988 1.425l.037 .033l.034 -.03a6 6 0 0 1 4.733 -1.44l.246 .036a6 6 0 0 1 3.364 10.008l-.18 .185l-.048 .041l-7.45 7.379a1 1 0 0 1 -1.313 .082l-.094 -.082l-7.493 -7.422a6 6 0 0 1 3.176 -10.215z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-heart">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                        </svg>
                                    @endif
                                </a>
                                <span class="like-count">{{ $idea->likes_count }}</span>
                                <!-- Menampilkan jumlah like -->
                                <div class="ms-auto">
                                    <a href="javascript:void(0)" class="link me-1" data-bs-toggle="modal"
                                        data-bs-target="#editIdeaModal{{ $idea->id }}">
                                        <i class="ti ti-zoom-in fs-4"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Link Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $ideas->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    <!-- Modal Edit Idea -->
    @foreach ($ideas as $idea)
        <div class="modal fade" id="editIdeaModal{{ $idea->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editIdeaModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary text-white">
                        <h5 class="modal-title text-white">Detail Idea</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="shop-detail">
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div id="image-slider" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    @if ($idea->ideaFile->isNotEmpty())
                                                        @foreach ($idea->ideaFile as $index => $file)
                                                            <div
                                                                class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                                <img src="{{ asset('storage/' . $file->file) }}"
                                                                    alt="Gambar Idea" class="img-fluid">
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="carousel-item active">
                                                            <img src="{{ asset('assets/images/gallery/no_image.jpg') }}"
                                                                alt="Gambar Tidak Tersedia" class="img-fluid">
                                                        </div>
                                                    @endif
                                                </div>
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#image-slider" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon"
                                                        aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#image-slider" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon"
                                                        aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="shop-content">
                                                <h4>{{ $idea->title }}</h4>
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <span
                                                        class="badge {{ $idea->category_id == 1 ? 'text-bg-success' : ($idea->category_id == 2 ? 'text-bg-primary' : ($idea->category_id == 3 ? 'text-bg-warning' : ($idea->category_id == 4 ? 'text-bg-info' : 'text-bg-secondary'))) }} fs-2 fw-semibold">{{ $idea->category->name ?? 'Not Yet have category' }}</span>
                                                </div>

                                                @if ($idea->category_id == 1 || $idea->category_id == 2 || $idea->category_id == 3 || $idea->category_id == 4)
                                                    <div class="additional-info mt-3">
                                                        <h6 class="mb-0 fs-4 fw-semibold">Idea Information:</h6>
                                                        <ul class="list-unstyled">
                                                            @if ($idea->before)
                                                                <li><strong>Before:</strong> {{ $idea->before }}</li>
                                                            @endif
                                                            @if ($idea->after)
                                                                <li><strong>After:</strong> {{ $idea->after }}</li>
                                                            @endif
                                                            @if ($idea->category_id == 1 && $idea->benefit)
                                                                <li><strong>Benefit:</strong> {{ $idea->benefit }}</li>
                                                            @endif
                                                            @if ($idea->category_id == 2 && $idea->sumber_best_practice)
                                                                <li><strong>Sumber Best Practice:</strong>
                                                                    {{ $idea->sumber_best_practice }}</li>
                                                            @endif
                                                            @if ($idea->category_id == 3 && $idea->proses_improve)
                                                                <li><strong>Proses yang diimprove:</strong>
                                                                    {{ $idea->proses_improve }}</li>
                                                            @endif
                                                            @if ($idea->category_id == 4 && $idea->nama_ai)
                                                                <li><strong>Nama AI:</strong> {{ $idea->nama_ai }}</li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                @endif
                                                <div class="description-box">
                                                    <h6 class="mb-0 fs-4 fw-semibold">Description:</h6>
                                                    <p class="mb-0 fs-4 text-justify">{!! $idea->description !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal"> Close </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @push('scripts')
        <!-- Load jQuery -->
        <script>
            $(document).ready(function() {
                updateLikeCounts();

                // Event listener for category tabs
                document.querySelectorAll('.nav-link.note-link').forEach(function(tab) {
                    tab.addEventListener('click', function() {
                        console.log('Tab clicked:', this.id);
                        // Remove active class from all tabs
                        document.querySelectorAll('.nav-link').forEach(function(t) {
                            t.classList.remove('active');
                        });

                        // Add active class to the clicked tab
                        this.classList.add('active');

                        // Get the category from the clicked tab's ID
                        var category = this.id.replace('note-', '');

                        // Show/hide notes based on the selected category
                        document.querySelectorAll('.single-note-item').forEach(function(note) {
                            if (category === 'all-category' || note.classList.contains('note-' +
                                    category)) {
                                note.style.display = 'block';
                            } else {
                                note.style.display = 'none';
                            }
                        });
                    });
                });

                // Event listener for like button
                $('.like-button').on('click', function() {
                    var button = $(this);
                    var ideaId = button.data('idea-id');
                    var icon = button.find('svg');
                    var likeCountElement = button.siblings('.like-count');

                    $.ajax({
                        url: '/ideas/' + ideaId + '/like', // Adjust the URL to your route
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // Update the heart icon and like count based on the response
                            if (response.liked) {
                                icon.replaceWith(`
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="red" class="icon icon-tabler icons-tabler-filled icon-tabler-heart">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M6.979 3.074a6 6 0 0 1 4.988 1.425l.037 .033l.034 -.03a6 6 0 0 1 4.733 -1.44l.246 .036a6 6 0 0 1 3.364 10.008l-.18 .185l-.048 .041l-7.45 7.379a1 1 0 0 1 -1.313 .082l-.094 -.082l-7.493 -7.422a6 6 0 0 1 3.176 -10.215z" />
                </svg>
                `);
                            } else {
                                icon.replaceWith(`
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-heart">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                </svg>
                `);
                            }
                            likeCountElement.text(response.likes_count); // Update the like count
                        },
                        error: function(xhr) {
                            console.error('Error liking the idea:', xhr.responseText);
                        }
                    });
                });
                // Inisialisasi tooltip Bootstrap
                $('[data-bs-toggle="tooltip"]').tooltip();

                function updateLikeCounts() {
                    fetch('{{ route('getLikeCounts') }}')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // console.log(data);
                            data.ideas.forEach(like => {
                                var likeCountElement = $('.like-button[data-idea-id="' + like.idea_id +
                                        '"]')
                                    .siblings('.like-count');
                                likeCountElement.text(like.likes_count); // Update the like count
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error.message);
                        });
                }
                // Polling every 5 seconds to update like counts
                setInterval(updateLikeCounts, 5000);

            });
        </script>
    @endpush
</x-app-layout>
