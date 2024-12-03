<x-app-layout>
    @section('title')
        Ideas
    @endsection

    @push('css')
        <style>
            #particles-js {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
            }

            /* .card-body {
                transition: transform 0.3s, box-shadow 0.3s;
            }
            .card-body:hover {
                transform: translateY(-10px);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            } */
            /* .btn {
                background: linear-gradient(45deg, #ff6b6b, #f06595);
                transition: background 0.3s;
            }

            .btn:hover {
                background: linear-gradient(45deg, #f06595, #ff6b6b);
            } */

            .badge {
                background: linear-gradient(45deg, #74c0fc, #4dabf7);
                color: white;
            }

            .note-title {
                transition: color 0.3s;
            }

            .note-title:hover {
                color: #ff6b6b;
            }

            .side-stick {
                transition: width 0.3s;
            }

            .side-stick:hover {
                width: 10px;
            }

            .single-note-item {
                opacity: 0;
                transform: scale(0.95);
                transition: opacity 0.3s, transform 0.3s;
            }

            .single-note-item.show {
                opacity: 1;
                transform: scale(1);
            }

            .nav-link.active {
                background: linear-gradient(45deg, #4dabf7, #74c0fc);
                color: white;
            }

            .modal-image {
                width: 100%;
                height: auto;
            }
        </style>
    @endpush

    <div id="particles-js" style="position: absolute; width: 100%; height: 100%;"></div>

    <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-0">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex flex-column">
                    <h1 class="font-weight-medium mb-3 ml-3">Wall of Ideas</h1>
                    <!-- count particles -->
                    <div class="count-particles">
                        <span class="js-count-particles" style="display: none;">--</span>
                    </div>

                    <div class="widget-content searchable-container list position-relative">
                        <input type="text" id="search-input" class="form-control"
                            placeholder="Cari judul atau deskripsi...">
                        <span id="clear-search" class="position-absolute"
                            style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none;">&times;</span>
                    </div>
                </div>
                <div style="display: flex; justify-content: center; align-items: center; margin: 20px 0;">
                    <img src="{{ asset('assets') }}/images/logos/Maskot CITA.png" alt="homepage"
                        style="width: 100px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                </div>
            </div>
        </div>

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
            <li class="nav-item ms-auto">
                <a href="{{ route('ideas.create') }}"
                    class="btn mb-1 text-white px-4 fs-4 bg-danger d-flex align-items-center">
                    <i class="ti ti-plus text-white me-1 fs-5"></i> <span class="d-none d-md-inline">Submit your
                        Idea</span>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="note-full-container" class="note-has-grid row">
                @forelse ($ideas as $idea)
                    <div class="col-md-3 single-note-item all-category note-{{ $idea->category_id }}"
                        data-title="{{ $idea->title }}" data-description="{{ $idea->description }}">
                        <div class="card card-body ">
                            <div class="me-8 d-flex justify-content-start align-items-center">
                                @if ($idea->user->avatar)
                                    <img src="{{ asset('storage/uploads/user_avatars/' . $idea->user->avatar) }}"
                                        alt="Avatar" class="rounded-circle" width="72" height="72">
                                @else
                                    <img src="{{ asset('assets/images/logos/sinarmeadow.png') }}" alt="Avatar"
                                        class="rounded-circle" width="72" height="72">
                                @endif

                                @if (in_array($idea->category_id, [1, 2, 3, 4]))
                                    <div class="additional-info ms-3 mt-3">
                                        <ul class="list-unstyled">

                                            <h5 class="note-title text-truncate w-100 mb-0 fw-semibold"
                                                data-noteheading="{{ strtoupper($idea->title) }}">
                                                {{ strlen($idea->title) > 30 ? strtoupper(substr($idea->title, 0, 25)) . '...' : strtoupper($idea->title) }}
                                            </h5>
                                            @if ($idea->before)
                                                <li><strong>Before:</strong>
                                                    {{ strlen($idea->before) > 20 ? substr($idea->before, 0, 17) . '...' : $idea->before }}
                                                </li>
                                            @endif
                                            @if ($idea->after)
                                                <li><strong>After:</strong>
                                                    {{ strlen($idea->after) > 20 ? substr($idea->after, 0, 17) . '...' : $idea->after }}
                                                </li>
                                            @endif
                                            @if ($idea->category_id == 1 && $idea->benefit)
                                                <li><strong>Benefit:</strong>
                                                    {{ strlen($idea->benefit) > 20 ? substr($idea->benefit, 0, 17) . '...' : $idea->benefit }}
                                                </li>
                                            @endif
                                            @if ($idea->category_id == 2 && $idea->sumber_best_practice)
                                                <li><strong>Sumber Best Practice:</strong>
                                                    {{ strlen($idea->sumber_best_practice) > 20 ? substr($idea->sumber_best_practice, 0, 17) . '...' : $idea->sumber_best_practice }}
                                                </li>
                                            @endif
                                            @if ($idea->category_id == 3 && $idea->proses_improve)
                                                <li><strong>Proses yang diimprove:</strong>
                                                    {{ strlen($idea->proses_improve) > 20 ? substr($idea->proses_improve, 0, 17) . '...' : $idea->proses_improve }}
                                                </li>
                                            @endif
                                            @if ($idea->category_id == 4 && $idea->nama_ai)
                                                <li><strong>Nama AI:</strong>
                                                    {{ strlen($idea->nama_ai) > 20 ? substr($idea->nama_ai, 0, 17) . '...' : $idea->nama_ai }}
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="badge {{ $idea->category_id == 1 ? 'text-bg-success' : ($idea->category_id == 2 ? 'text-bg-primary' : ($idea->category_id == 3 ? 'text-bg-warning' : ($idea->category_id == 4 ? 'text-bg-info' : 'text-bg-secondary'))) }} fs-2 fw-semibold">{{ $idea->category->name ?? 'Not Yet have category' }}</span>
                                    </div>
                                    <p class="note-date fs-2">{{ $idea->created_at->format('d M Y') }}</p>
                                </div>
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
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-heart">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                            </svg>
                                        @endif
                                    </a>
                                    <span class="like-count">{{ $idea->likes_count }}</span>
                                    <div class="ms-auto">
                                        <a href="javascript:void(0)" class="link me-1" data-bs-toggle="modal"
                                            data-bs-target="#editIdeaModal{{ $idea->id }}">
                                            <i class="ti ti-zoom-in fs-4"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="fs-4">No Yet have an Idea Here</p>
                    </div>
                @endforelse
                <div id="no-results" class="col-12 text-center" style="display: none;">
                    <p class="fs-4">No results found for your search</p>
                </div>
            </div>
        </div>

        <!-- Link Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $ideas->appends(request()->input())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
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
                                                                    alt="Gambar Idea" class="img-fluid modal-image" style="width: 300px; height: auto;">
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="carousel-item active">
                                                            <img src="{{ asset('assets/images/gallery/no_image.jpg') }}"
                                                                alt="Gambar Tidak Tersedia" class="img-fluid modal-image" style="width: 300px; height: auto;">
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
                                                <!-- User Information -->
                                                <div class="user-info mt-3">
                                                    <h6 class="mb-3 fs-4 fw-semibold ">User Information:</h6>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            @if ($idea->user->avatar)
                                                                <img src="{{ asset('storage/uploads/user_avatars/' . $idea->user->avatar) }}"
                                                                    alt="Avatar" class="rounded-circle img-fluid" style="width: 72px; height: 72px;">
                                                            @else
                                                                <img src="{{ asset('assets/images/logos/sinarmeadow.png') }}" alt="Avatar"
                                                                    class="rounded-circle img-fluid" style="width: 72px; height: 72px;">
                                                            @endif
                                                        </div>
                                                        <div class="col-md-9">
                                                            <ul class="list-unstyled">
                                                                <li><strong>Name:</strong> {{ $idea->user->name }}</li>
                                                                <li><strong>Email:</strong> {{ $idea->user->email }}</li>
                                                                <li><strong>Section:</strong> {{ $idea->user->section->name ?? 'N/A' }}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4 class="mb-0 fw-semibold mt-5">"{{ strtoupper($idea->title) }}"</h4>
                                                <div
                                                    class="d-flex align-items-center gap-2 mb-2 justify-content-between">
                                                    <span
                                                        class="badge {{ $idea->category_id == 1 ? 'text-bg-success' : ($idea->category_id == 2 ? 'text-bg-primary' : ($idea->category_id == 3 ? 'text-bg-warning' : ($idea->category_id == 4 ? 'text-bg-info' : 'text-bg-secondary'))) }} fs-2 fw-semibold">{{ $idea->category->name ?? 'Not Yet have category' }}</span>
                                                    <p class="note-date fs-2">{{ $idea->created_at->format('d M Y') }}</p>
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
                                                                <li><strong>Sumber Best Practice:</strong> {{ $idea->sumber_best_practice }}</li>
                                                            @endif
                                                            @if ($idea->category_id == 3 && $idea->proses_improve)
                                                                <li><strong>Proses yang diimprove:</strong> {{ $idea->proses_improve }}</li>
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
    <script src="{{ asset('assets/js/particles/particles.js') }}"></script>
    <script src="{{ asset('assets/js/particles/app.js') }}"></script>
    <script src="{{ asset('assets/js/particles/lib/stats.js') }}"></script>


    <script>
        var count_particles, stats, update;
        stats = new Stats;
        stats.setMode(0);
        stats.domElement.style.position = 'absolute';
        stats.domElement.style.left = '0px';
        stats.domElement.style.top = '0px';
        document.body.appendChild(stats.domElement);
        count_particles = document.querySelector('.js-count-particles');
        update = function() {
            stats.begin();
            stats.end();
            if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
                count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
            }
            requestAnimationFrame(update);
        };
        requestAnimationFrame(update);
    </script>

    @push('scripts')
        <!-- Load jQuery -->
        <script>
            $(document).ready(function() {
                particlesJS.load('particles-js', '{{ asset('assets/js/particles/particles.json') }}', function() {
                    console.log('particles.js loaded - callback');
                    console.log(window.pJSDom[0].pJS.particles);
                });

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
                                note.classList.add('show');
                            } else {
                                note.classList.remove('show');
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

                // Event listener for search input
                $('#search-input').on('keyup', function() {
                    var searchTerm = $(this).val().toLowerCase();
                    var hasResults = false;

                    // Tampilkan atau sembunyikan ikon "X" berdasarkan input
                    $('#clear-search').toggle(searchTerm.length > 0);

                    $('.single-note-item').each(function() {
                        var title = $(this).data('title').toLowerCase();
                        var description = $(this).data('description').toLowerCase();
                        if (title.includes(searchTerm) || description.includes(searchTerm)) {
                            $(this).show();
                            hasResults = true;
                        } else {
                            $(this).hide();
                        }
                    });

                    // Tampilkan pesan "No results" hanya jika ada input dan tidak ada hasil
                    $('#no-results').toggle(searchTerm.length > 0 && !hasResults);
                });

                // Event listener untuk ikon "X" untuk menghapus input
                $('#clear-search').on('click', function() {
                    $('#search-input').val('').trigger('keyup');
                });

                // Menampilkan semua ide saat halaman dimuat
                $('.single-note-item').addClass('show');

            });
        </script>
    @endpush
    <div class="js-count-particles" style="display: none;"></div>
</x-app-layout>
