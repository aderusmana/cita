<x-app-layout>
    @section('title')
        Idea Approval
    @endsection

    <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
        <div class="card-body px-0">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="font-weight-medium mb-0 ml-3">Idea Approval</h1>
                <nav aria-label="breadcrumb mr-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home
                            </a>
                        </li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Idea Approval</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card chat-application">
        <div class="d-flex align-items-center justify-content-between gap-6 m-3 d-lg-none">
            <button class="btn btn-primary d-flex" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#chat-sidebar" aria-controls="chat-sidebar">
                <i class="ti ti-menu-2 fs-5"></i>
            </button>
            <form class="position-relative w-100">
                <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
                    placeholder="Search Contact">
                <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
            </form>
        </div>
        <div class="d-flex w-100">
            <div class="left-part border-end w-20 flex-shrink-0 d-none d-lg-block">
                <ul class="list-group mh-n100" data-simplebar="">
                    <li class="list-group-item border-0 p-0 mx-9">
                        <a class="d-flex align-items-center gap-6 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
                            href="javascript:void(0)" onclick="filterIdeas('all')">
                            <i class="ti ti-file-text fs-5"></i>All
                        </a>
                    </li>
                    <li class="border-bottom my-3"></li>
                    <li class="fw-semibold text-dark text-uppercase mx-9 my-2 px-3 fs-2">Pending By Categories</li>
                    @foreach ($categories as $category)
                        <li class="list-group-item border-0 p-0 mx-9">
                            <a class="d-flex align-items-center gap-6 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
                                href="javascript:void(0)" onclick="filterIdeas('{{ $category->id }}')">
                                <i class="ti ti-bookmark fs-5 text-primary"></i>{{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="d-flex w-100">
                <div class="min-width-340">
                    <div class="border-end user-chat-box h-100">
                        <div class="px-4 pt-9 pb-6 d-none d-lg-block">
                            <form class="position-relative">
                                <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
                                    placeholder="Search">
                                <i
                                    class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                            </form>
                        </div>
                        <div class="app-chat">
                            <ul class="chat-users mh-n100" data-simplebar="">
                                @foreach ($ideas as $idea)
                                    <li class="idea-item" data-category-id="{{ $idea->category_id }}">
                                        <div class="chat-user bg-light-subtle px-4 py-3 d-flex align-items-center bg-hover-light-black mb-3"
                                            data-user-id="{{ $idea->id }}">
                                            @if ($idea->user->avatar)
                                                <img src="{{ asset('storage/uploads/user_avatars/' . $idea->user->avatar) }}" alt="Avatar" class="rounded-circle me-3" width="40" height="40">
                                            @else
                                                <img src="{{ asset('assets/images/logos/sinarmeadow.png') }}" alt="Avatar" class="rounded-circle me-3" width="40" height="40">
                                            @endif
                                            <div class="w-75">
                                                <h6 class="mb-1 fw-semibold chat-title"
                                                    data-username="{{ $idea->user->name }}">{{ $idea->user->name }}</h6>
                                                <span class="fs-2 d-block text-primary">{{ $idea->title }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="w-100">
                    <div class="chat-container h-100 w-100">
                        <div class="chat-box-inner-part h-100">
                            <div class="chatting-box app-email-chatting-box">
                                <div
                                    class="p-9 py-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
                                    <h5 class="text-dark mb-0 fs-5">Idea Details</h5>
                                    <ul class="list-unstyled mb-0 d-flex align-items-center">
                                        <li class="d-lg-none d-block">
                                            <a class="text-dark back-btn px-2 fs-5 bg-hover-primary nav-icon-hover position-relative z-index-5"
                                                href="javascript:void(0)">
                                                <i class="ti ti-arrow-left"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="chat-box email-box mh-n100 p-9" data-simplebar="init">
                                    <div id="idea-details-container">
                                        <h5 class="text-center text-muted">Pilih ide untuk melihat detail</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Tambahkan ini di bagian <head> atau sebelum </body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Load jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets') }}/js/apps/chat.js"></script>
<script>
    const assetBaseUrl = "{{ asset('') }}"; // Menyimpan URL dasar untuk aset

    document.addEventListener('DOMContentLoaded', function() {
        // console.log('DOM fully loaded and parsed'); // Log untuk memastikan skrip dimuat
        const chatContainer = document.querySelector('.chat-users');
        if (chatContainer) {
            chatContainer.addEventListener('click', function(event) {
                // console.log('Chat container clicked'); // Log untuk memastikan event listener dipanggil
                const item = event.target.closest('.chat-user');
                if (item) {
                    event.preventDefault(); // Mencegah perilaku default
                    const ideaId = item.getAttribute('data-user-id');
                    // console.log('Idea ID:', ideaId); // Log untuk memastikan ideaId diambil
                    fetchIdeaDetails(ideaId);
                }
            });
        }
    });

    function fetchIdeaDetails(ideaId) {
        fetch(`/ideas/${ideaId}`)
            .then(response => response.json())
            .then(data => {
                let filesHtml = '';
                if (data.idea_file.length > 0) {
                    filesHtml = data.idea_file.map((file, index) => {
                        const fileUrl = `${assetBaseUrl}storage/${file.file}`;
                        console.log(fileUrl);
                        return `
                            <div class="carousel-item ${index === 0 ? 'active' : ''}">
                                <img src="${fileUrl}" alt="${file.file}" class="img-fluid">
                            </div>
                        `;
                    }).join('');
                } else {
                    filesHtml = '<p class="mb-0">Tidak ada file tersedia.</p>';
                }

                const avatar = data.user.avatar ? `${assetBaseUrl}storage/uploads/user_avatars/${data.user.avatar}` :
                    `${assetBaseUrl}assets/images/logos/sinarmeadow.png`;
                const sectionName = data.user.section ? data.user.section.name : 'Section not available';
                const positionName = data.user.position ? data.user.position.name : 'Position not available';
                const departmentName = data.user.department ? data.user.department.name :
                    'Department not available';

                const ideaInformationHtml = `
                    <div class="border-bottom pb-4 mb-4">
                        <h6 class="mb-3 fs-4 fw-semibold text-primary">Idea Information</h6>
                        <div class="bg-light p-3 rounded">
                            <ul class="list-unstyled mb-0">
                                ${data.before ? `<li class="mb-2"><strong>Before:</strong> <span class="text-muted">${data.before}</span></li>` : ''}
                                ${data.after ? `<li class="mb-2"><strong>After:</strong> <span class="text-muted">${data.after}</span></li>` : ''}
                                ${data.category_id == 1 && data.benefit ? `<li class="mb-2"><strong>Benefit:</strong> <span class="text-muted">${data.benefit}</span></li>` : ''}
                                ${data.category_id == 2 && data.sumber_best_practice ? `<li class="mb-2"><strong>Sumber Best Practice:</strong> <span class="text-muted">${data.sumber_best_practice}</span></li>` : ''}
                                ${data.category_id == 3 && data.proses_improve ? `<li class="mb-2"><strong>Proses yang diimprove:</strong> <span class="text-muted">${data.proses_improve}</span></li>` : ''}
                                ${data.category_id == 4 && data.nama_ai ? `<li class="mb-2"><strong>Nama AI:</strong> <span class="text-muted">${data.nama_ai}</span></li>` : ''}
                            </ul>
                        </div>
                    </div>
                `;

                document.querySelector('#idea-details-container').innerHTML = `
                    <div class="chat-list chat active-chat" data-user-id="${data.id}">
                        <div class="align-items-start mb-2 pb-1 align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <img src="${avatar}" alt="avatar" class="rounded-circle" width="35">
                                <div>
                                    <h6 class="fw-semibold fs-4 mb-0">${data.user.name}</h6>
                                    <p class="mb-0">${positionName}</p>
                                    <p class="mb-0">${departmentName}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 mb-2">
                                <p class="mb-1 fs-2">NIK</p>
                                <h6 class="fw-semibold mb-0">${data.user.nik}</h6>
                            </div>
                            <div class="col-4 mb-2">
                                <p class="mb-1 fs-2">Email address</p>
                                <h6 class="fw-semibold mb-0">${data.user.email}</h6>
                            </div>
                            <div class="col-4 mb-2">
                                <p class="mb-1 fs-2">Section</p>
                                <h6 class="fw-semibold mb-0">${sectionName}</h6>
                            </div>
                            <div class="col-4 mb-2">
                                <p class="mb-1 fs-2">Title</p>
                                <h6 class="fw-semibold mb-0">${data.title}</h6>
                            </div>
                           <div class="col-8 mb-2">
                                <p class="mb-1 fs-2">Category</p>
                                <span class="badge ${data.category_id == 1 ? 'text-bg-success' : (data.category_id == 2 ? 'text-bg-primary' : (data.category_id == 3 ? 'text-bg-warning' : (data.category_id == 4 ? 'text-bg-info' : 'text-bg-secondary'))) } fs-2 fw-semibold">
                                    ${data.category ? data.category.name : 'Belum ada kategori'}
                                </span>
                            </div>
                        </div>
                        ${ideaInformationHtml}
                        <div class="border-bottom pb-3 mb-2">
                            <p class="mb-2 fs-2">Description</p>
                            <p class="mb-3 text-dark">${data.description}</p>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <p class="mb-1 fs-2">Files</p>
                                <div id="image-slider" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        ${filesHtml}
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#image-slider" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#image-slider" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-6">
                            <button class="btn btn-primary" onclick="approveIdea(${data.id})">Approve</button>
                            <button class="btn bg-danger-subtle text-danger" onclick="rejectIdea(${data.id})">Reject</button>
                        </div>
                    </div>
                `;



                // Menambahkan skrip untuk slider gambar biasa
                document.addEventListener('DOMContentLoaded', function() {
                    const images = document.querySelectorAll('#image-slider img');
                    let currentIndex = 0;

                    function showImage(index) {
                        images.forEach((img, i) => {
                            img.style.display = (i === index) ? 'block' : 'none';
                        });
                    }
                    showImage(currentIndex);

                    // Menambahkan navigasi
                    const nextButton = document.createElement('button');
                    nextButton.innerText = 'Next';
                    nextButton.onclick = function() {
                        currentIndex = (currentIndex + 1) % images.length;
                        showImage(currentIndex);
                    };

                    const prevButton = document.createElement('button');
                    prevButton.innerText = 'Previous';
                    prevButton.onclick = function() {
                        currentIndex = (currentIndex - 1 + images.length) % images.length;
                        showImage(currentIndex);
                    };

                    // Menambahkan tombol navigasi ke slider
                    document.querySelector('#image-slider').appendChild(prevButton);
                    document.querySelector('#image-slider').appendChild(nextButton);
                });
            })
            .catch(error => console.error('Error fetching idea details:', error));
    }

    function approveIdea(ideaId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to approve this idea?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/ideas/${ideaId}/approve`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            note: 'Approved via UI'
                        })
                    })
                    .then(response => {
                        console.log(response);
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log(data);
                        Swal.fire({
                            title: 'Success!',
                            text: 'Idea approved successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = 'http://cita.sinarmeadow.com/idea-approvals'; // Redirect to a specific page
                        });
                    })
                    .catch(error => {
                        console.error('Error approving idea:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error approving the idea',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            }
        });
    }

    function rejectIdea(ideaId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to reject this idea?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reject it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/ideas/${ideaId}/reject`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            note: 'Rejected via UI'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        Swal.fire({
                            title: 'Success!',
                            text: 'Idea rejected successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = 'http://cita.sinarmeadow.com/idea-approvals'; // Redirect to a specific page
                        });
                    })
                    .catch(error => {
                        console.error('Error rejecting idea:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error rejecting the idea',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            }
        });
    }

    function filterIdeas(categoryId) {
        const ideaItems = document.querySelectorAll('.idea-item');
        ideaItems.forEach(item => {
            if (categoryId === 'all' || item.getAttribute('data-category-id') === categoryId) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>

<style>
    .carousel-item img {
        width: 100%; /* Atur lebar gambar sesuai dengan container */
        height: 400px; /* Atur tinggi gambar secara konsisten */
        object-fit: contain; /* Memastikan gambar ditampilkan sepenuhnya tanpa terpotong */
    }
</style>

