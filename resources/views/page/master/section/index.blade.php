<x-app-layout>
    @section('title')
        Sections
    @endsection

    @push('css')
        <link rel="stylesheet" href="{{ asset('assets') }}/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    @endpush
    <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
        <div class="card-body px-0">
            <div class="d-flex justify-content-between align-items-center">
                    <h1 class="font-weight-medium mb-0 ml-3">List Sections</h1>
                    <nav aria-label="breadcrumb mr-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home
                                </a>
                            </li>
                            <li class="breadcrumb-item text-muted" aria-current="page">Sections</li>
                        </ol>
                    </nav>
            </div>
        </div>
    </div>

    <div class="widget-content searchable-container list">
            <div class="row">
                <div
                    class="col-md-12 col-xl-12 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0 mb-3">
                    <button type="button" class="btn mb-1 bg-primary text-white px-4 fs-4 hover:bg-primary-dark"
                        data-bs-toggle="modal" data-bs-target="#addSectionModal">
                        <i class="ti ti-users text-white me-1 fs-5"></i> Add Section
                    </button>
                </div>
            </div>

        <div class="card card-body">
            <div class="table-responsive">
                <table class="table search-table align-middle text-nowrap" id="sectionTable">
                    <thead class="header-item">
                        <th>No</th>
                        <th>Name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($sections as $section)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $section->name }}</td>
                                <td>
                                    <div class="action-btn">
                                        <a href="javascript:void(0)" class="text-primary edit" data-bs-toggle="modal"
                                            data-bs-target="#editSectionModal{{ $section->id }}">
                                            <i class="ti ti-eye fs-5"></i>
                                        </a>
                                        <form id="delete-form-{{ $section->id }}"
                                            action="{{ route('sections.destroy', $section->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:void(0)" class="text-dark delete ms-2"
                                                data-section-id="{{ $section->id }}">
                                                <i class="ti ti-trash fs-5"></i>
                                            </a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Add Section -->
    <div class="modal fade" id="addSectionModal" tabindex="-1" role="dialog" aria-labelledby="addSectionModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary text-white">
                    <h5 class="modal-title text-white">Add Section</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sections.store') }}" method="POST">
                        @csrf
                        <div class="box">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="tb-name"
                                                    placeholder="Enter Name here" name="name">
                                                <label for="tb-name">Name</label>
                                            </div>
                                            <span class="validation-text text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex gap-6 m-0">
                        <button type="submit" class="btn btn-success">Add</button>
                        </form>
                        <button class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal"> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Section -->
    @foreach ($sections as $section)
        <div class="modal fade" id="editSectionModal{{ $section->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editSectionModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary text-white">
                        <h5 class="modal-title text-white">Edit Section</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('sections.update', $section->id) }}" method="POST">
                        <div class="add-section-box">
                            <div class="add-section-content">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3 section-name">
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Name" value="{{ $section->name }}">
                                                <span class="validation-text text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="d-flex gap-6 m-0">
                                <button type="submit" class="btn btn-success">Update</button>
                            </form>
                            <button class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal"> Close
                            </button>
                        </div>
                    </div>
                </</div>
            </div>
        </div>
    @endforeach

    @push('scripts')
    <script src="{{ asset('assets')}}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets')}}/js/datatable/datatable-basic.init.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable
            var table = $('#sectionTable').DataTable();

            // Function to initialize modal event listeners
            function initializeModalListeners() {
                document.querySelectorAll('.delete').forEach(function(element) {
                    element.addEventListener('click', function() {
                        var sectionId = this.getAttribute('data-section-id');
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('delete-form-' + sectionId).submit();
                            }
                        });
                    });
                });
            }

            // Initialize modal listeners on page load
            initializeModalListeners();

            // Re-initialize modal listeners on DataTable draw event
            table.on('draw', function() {
                initializeModalListeners();
            });
        });
    </script>
@endpush
</x-app-layout>
