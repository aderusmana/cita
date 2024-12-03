{{-- <x-app-layout>
    @section('title')
        Approvers
    @endsection

    @push('css')
        <link rel="stylesheet" href="{{ asset('assets') }}/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
        </style>
    @endpush

    <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
        <div class="card-body px-0">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="font-weight-medium mb-0 ml-3">List Approvers</h1>
                <button type="button" class="btn mb-1 bg-primary text-white px-4 fs-4 hover:bg-primary-dark"
                    data-bs-toggle="modal" data-bs-target="#addApproverModal">
                    <i class="ti ti-user-plus text-white me-1 fs-5"></i> Add Approver
                </button>
            </div>
        </div>
    </div>

    <div class="widget-content searchable-container list">
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table search-table align-middle text-nowrap table-bordered" id="approverTable">
                    <thead class="header-item">
                        <th>Section</th>
                        <th>Approver NIK</th>
                        <th>Level</th>
                        <th>Is Special</th>
                        <th>Skip To Level</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($approvers as $approver)
                            <tr>
                                <td>{{ $approver->section->name }}</td>
                                <td>{{ $approver->user->nik . ' - ' . $approver->user->name }}</td>
                                <td>{{ $approver->level }}</td>
                                <td>{{ $approver->is_special ? 'Yes' : 'No' }}</td>
                                <td>{{ $approver->skip_to_level ?? '-' }}</td>
                                <td>
                                    <div class="action-btn">
                                        <a href="javascript:void(0)" class="text-primary edit" data-bs-toggle="modal"
                                            data-bs-target="#editApproverModal{{ $approver->id }}">
                                            <i class="ti ti-pencil fs-5"></i>
                                        </a>
                                        <form id="delete-form-{{ $approver->id }}"
                                            action="{{ route('approvers.destroy', $approver->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:void(0)" class="text-dark delete ms-2"
                                                data-approver-id="{{ $approver->id }}">
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

    <!-- Modal Add Approver -->
    <div class="modal fade" id="addApproverModal" tabindex="-1" role="dialog" aria-labelledby="addApproverModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary text-white">
                    <h5 class="modal-title text-white">Add Approver</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createApproverForm" action="{{ route('approvers.store') }}" method="POST">
                        @csrf
                        <div id="approverLines">
                            <div class="row approver-line">
                                <div class="col-md-2">
                                    <select name="section_id[]" class="form-select">
                                        <option value="">Select Section</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="approver_nik[]" class="form-select">
                                        <option value="">Select Approver</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->nik }}">{{ $user->nik . ' - ' . $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="level[]" class="form-control" placeholder="Level">
                                </div>
                                <div class="col-md-2">
                                    <select name="is_special[]" class="form-select">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="skip_to_level[]" class="form-control" placeholder="Skip To Level">
                                </div>
                                <div class="col-md-2 d-flex">
                                    <button type="button" class="btn btn-sm btn-danger remove-line me-1" style="display: none;">Remove</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary mt-3" id="addLine">Add Line</button>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Add</button>
                    </form>
                    <button class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal"> Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Approver -->
    @foreach ($approvers as $approver)
        <div class="modal fade" id="editApproverModal{{ $approver->id }}" tabindex="-1" role="dialog" aria-labelledby="editApproverModalTitle"
            aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary text-white">
                    <h5 class="modal-title text-white">Edit Approver</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editApproverForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div id="editApproverLines">
                            <div class="row approver-line">
                                <div class="col-md-2">
                                    <select name="section_id[]" class="form-select">
                                        <option value="">Select Section</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}" {{ $approver->section_id == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="approver_nik[]" class="form-select">
                                        <option value="">Select Approver</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->nik }}" {{ $approver->approver_nik == $user->nik ? 'selected' : '' }}>{{ $user->nik . ' - ' . $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="level[]" class="form-control" placeholder="Level" value="{{ $approver->level }}">
                                </div>
                                <div class="col-md-2">
                                    <select name="is_special[]" class="form-select">
                                        <option value="0" {{ $approver->is_special == 0 ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ $approver->is_special == 1 ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="skip_to_level[]" class="form-control" placeholder="Skip To Level" value="{{ $approver->skip_to_level }}">
                                </div>
                                <div class="col-md-2 d-flex">
                                    <button type="button" class="btn btn-sm btn-danger remove-line me-1" style="display: none;">Remove</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary mt-3" id="addEditLine">Add Line</button>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                    <button class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal"> Close
                    </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @push('scripts')
    <script src="{{ asset('assets') }}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/js/datatable/datatable-basic.init.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to add a new line in Add Modal
            document.getElementById('addLine').addEventListener('click', function() {
                var newLine = document.querySelector('#approverLines .approver-line').cloneNode(true);
                newLine.querySelectorAll('input, select').forEach(function(input) {
                    if (input.tagName.toLowerCase() === 'select') {
                        input.selectedIndex = 0; // Reset dropdown to first option
                    } else {
                        input.value = '';
                    }
                });
                newLine.querySelector('.remove-line').style.display = 'inline-block';
                document.getElementById('approverLines').appendChild(newLine);
            });

            // Function to add a new line in Edit Modal
            document.getElementById('addEditLine').addEventListener('click', function() {
                var newLine = document.querySelector('#editApproverLines .approver-line').cloneNode(true);
                newLine.querySelectorAll('input, select').forEach(function(input) {
                    if (input.tagName.toLowerCase() === 'select') {
                        input.selectedIndex = 0; // Reset dropdown to first option
                    } else {
                        input.value = '';
                    }
                });
                newLine.querySelector('.remove-line').style.display = 'inline-block';
                document.getElementById('editApproverLines').appendChild(newLine);
            });

            // Function to remove a line
            document.getElementById('approverLines').addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-line')) {
                    e.target.closest('.approver-line').remove();
                }
            });

            document.getElementById('editApproverLines').addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-line')) {
                    e.target.closest('.approver-line').remove();
                }
            });

            // Initialize DataTable
            $('#approverTable').DataTable({
                "order": [[0, "asc"]],
                "drawCallback": function(settings) {
                    // Function to initialize modal event listeners
                    function initializeModalListeners() {
                        document.querySelectorAll('.delete').forEach(function(element) {
                            element.addEventListener('click', function() {
                                var approverId = this.getAttribute('data-approver-id');
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "You won't be able to revert this!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, delete!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.getElementById('delete-form-' + approverId).submit();
                                    }
                                });
                            });
                        });
                    }

                    // Call the function to initialize modal event listeners
                    initializeModalListeners();
                }
            });

        // Function to initialize modal event listeners
        function initializeModalListeners() {
            document.querySelectorAll('.delete').forEach(function(element) {
                element.addEventListener('click', function() {
                    var approverId = this.getAttribute('data-approver-id');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + approverId).submit();
                        }
                    });
                });
            });
        }

        // Call the function to initialize modal event listeners
        initializeModalListeners();
        });
    </script>
    @endpush
</x-app-layout> --}}

<x-app-layout>
    @section('title')
        Approvers
    @endsection

    @push('css')
        <link rel="stylesheet" href="{{ asset('assets') }}/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
        <style>
            .card {
                border-radius: 0.5rem;
                transition: transform 0.2s;
            }

            .card:hover {
                transform: scale(1.02);
            }

            .card-header {
                background-color: #007bff;
                /* Warna biru */
            }

            .approver-card {
                border: 1px solid #dee2e6;
                border-radius: 0.5rem;
                /* Putih */
            }

            .approver-card:hover {
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .text-primary {
                color: #007bff !important;
                /* Warna biru */
            }

            .text-danger {
                color: #dc3545 !important;
                /* Warna merah */
            }

            .form-control {
                border-radius: 0.5rem;
                border: 1px solid #ced4da;
            }
        </style>
    @endpush

    <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
        <div class="card-body px-0">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="font-weight-medium mb-0 ml-3">List Approvers</h1>
                <button type="button" class="btn mb-1 bg-primary text-white px-4 fs-4 hover:bg-primary-dark"
                    data-bs-toggle="modal" data-bs-target="#addApproverModal">
                    <i class="ti ti-user-plus  me-1 fs-5"></i> Add Approver
                </button>
            </div>
        </div>
    </div>

    <div class="widget-content searchable-container list">
        <!-- Search Bar -->
        <div class="mb-4">
            <input type="text" id="sectionSearch" class="form-control" placeholder="Search by Section">
        </div>

        <div class="row" id="approverCards">
            @foreach ($sections as $section)
                <div class="col-md-4 mb-3 section-card" data-section="{{ strtolower($section->name) }}">
                    <div class="card shadow-sm border-light">
                        <div class="card-header {{ [
                            'bg-primary',
                            'bg-secondary',
                            'bg-success',
                            'bg-danger',
                            'bg-warning',
                            'bg-info',
                            'bg-light',
                            'bg-purple',
                            'bg-pink',
                            'bg-orange',
                            'bg-teal',
                            'bg-cyan',
                            'bg-lime',
                            'bg-indigo',
                        ][$loop->iteration % 14] }}">
                            <h5 class="mb-0">{{ $section->name }}</h5>
                        </div>
                        <div class="card-body">
                            @foreach ($approvers->where('section_id', $section->id) as $approver)
                                <div class="approver-card card mb-2">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <p><strong>NIK:</strong>
                                                {{ $approver->user->nik . ' - ' . $approver->user->name }}</p>
                                            <p><strong>Level:</strong> {{ $approver->level }}</p>
                                            <p><strong>Is Special:</strong> {{ $approver->is_special ? 'Yes' : 'No' }}
                                            </p>
                                            <p><strong>Skip To Level:</strong> {{ $approver->skip_to_level ?? '-' }}</p>
                                        </div>
                                        <div class="action-btn">
                                            <a href="javascript:void(0)" class="text-primary edit"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editApproverModal{{ $approver->id }}">
                                                <i class="ti ti-pencil fs-5"></i>
                                            </a>
                                            <form id="delete-form-{{ $approver->id }}"
                                                action="{{ route('approvers.destroy', $approver->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <a href="javascript:void(0)" class="text-danger delete ms-2"
                                                    data-approver-id="{{ $approver->id }}">
                                                    <i class="ti ti-trash fs-5"></i>
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Add Approver -->
    <div class="modal fade" id="addApproverModal" tabindex="-1" role="dialog" aria-labelledby="addApproverModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary ">
                    <h5 class="modal-title ">Add Approver</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createApproverForm" action="{{ route('approvers.store') }}" method="POST">
                        @csrf
                        <div id="approverLines">
                            <div class="row approver-line">
                                <div class="col-md-2">
                                    <select name="section_id[]" class="form-select">
                                        <option value="">Select Section</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="approver_nik[]" class="form-select">
                                        <option value="">Select Approver</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->nik }}">{{ $user->nik . ' - ' . $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="level[]" class="form-control" placeholder="Level">
                                </div>
                                <div class="col-md-2">
                                    <select name="is_special[]" class="form-select">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="skip_to_level[]" class="form-control"
                                        placeholder="Skip To Level">
                                </div>
                                <div class="col-md-2 d-flex">
                                    <button type="button" class="btn btn-sm btn-danger remove-line me-1"
                                        style="display: none;">Remove</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary mt-3" id="addLine">Add Line</button>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    </form>
                    <button class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal"> Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Approver -->
    @foreach ($approvers as $approver)
        <div class="modal fade" id="editApproverModal{{ $approver->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editApproverModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary ">
                        <h5 class="modal-title text-white">Edit Approver</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editApproverForm" action="{{ route('approvers.update', $approver->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div id="editApproverLines">
                                <div class="row approver-line">
                                    <div class="col-md-2">
                                        <select name="section_id[]" class="form-select">
                                            <option value="">Select Section</option>
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}"
                                                    {{ $approver->section_id == $section->id ? 'selected' : '' }}>
                                                    {{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="approver_nik[]" class="form-select">
                                            <option value="">Select Approver</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->nik }}"
                                                    {{ $approver->approver_nik == $user->nik ? 'selected' : '' }}>
                                                    {{ $user->nik . ' - ' . $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="level[]" class="form-control"
                                            placeholder="Level" value="{{ $approver->level }}">
                                    </div>
                                    <div class="col-md-2">
                                        <select name="is_special[]" class="form-select">
                                            <option value="0" {{ $approver->is_special == 0 ? 'selected' : '' }}>
                                                No</option>
                                            <option value="1" {{ $approver->is_special == 1 ? 'selected' : '' }}>
                                                Yes</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="skip_to_level[]" class="form-control"
                                            placeholder="Skip To Level" value="{{ $approver->skip_to_level }}">
                                    </div>
                                    <div class="col-md-2 d-flex">
                                        <button type="button" class="btn btn-sm btn-danger remove-line me-1"
                                            style="display: none;">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mt-3" id="addEditLine">Add Line</button>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        </form>
                        <button class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal"> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @push('scripts')
        <script src="{{ asset('assets') }}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('assets') }}/js/datatable/datatable-basic.init.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Function to add a new line in Add Modal
                document.getElementById('addLine').addEventListener('click', function() {
                    var newLine = document.querySelector('#approverLines .approver-line').cloneNode(true);
                    newLine.querySelectorAll('input, select').forEach(function(input) {
                        if (input.tagName.toLowerCase() === 'select') {
                            input.selectedIndex = 0; // Reset dropdown to first option
                        } else {
                            input.value = '';
                        }
                    });
                    newLine.querySelector('.remove-line').style.display = 'inline-block';
                    document.getElementById('approverLines').appendChild(newLine);
                });

                // Function to add a new line in Edit Modal
                document.getElementById('addEditLine').addEventListener('click', function() {
                    var newLine = document.querySelector('#editApproverLines .approver-line').cloneNode(true);
                    newLine.querySelectorAll('input, select').forEach(function(input) {
                        if (input.tagName.toLowerCase() === 'select') {
                            input.selectedIndex = 0; // Reset dropdown to first option
                        } else {
                            input.value = '';
                        }
                    });
                    newLine.querySelector('.remove-line').style.display = 'inline-block';
                    document.getElementById('editApproverLines').appendChild(newLine);
                });

                // Function to remove a line
                document.getElementById('approverLines').addEventListener('click', function(e) {
                    if (e.target.classList.contains('remove-line')) {
                        e.target.closest('.approver-line').remove();
                    }
                });

                document.getElementById('editApproverLines').addEventListener('click', function(e) {
                    if (e.target.classList.contains('remove-line')) {
                        e.target.closest('.approver-line').remove();
                    }
                });

                // Initialize DataTable
                $('#approverTable').DataTable({
                    "order": [
                        [0, "asc"]
                    ],
                    "drawCallback": function(settings) {
                        // Function to initialize modal event listeners
                        function initializeModalListeners() {
                            document.querySelectorAll('.delete').forEach(function(element) {
                                element.addEventListener('click', function() {
                                    var approverId = this.getAttribute('data-approver-id');
                                    Swal.fire({
                                        title: 'Are you sure?',
                                        text: "You won't be able to revert this!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Yes, delete!'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            document.getElementById('delete-form-' +
                                                approverId).submit();
                                        }
                                    });
                                });
                            });
                        }

                        // Call the function to initialize modal event listeners
                        initializeModalListeners();
                    }
                });

                // Function to initialize modal event listeners
                function initializeModalListeners() {
                    document.querySelectorAll('.delete').forEach(function(element) {
                        element.addEventListener('click', function() {
                            var approverId = this.getAttribute('data-approver-id');
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('delete-form-' + approverId)
                                    .submit();
                                }
                            });
                        });
                    });
                }

                // Call the function to initialize modal event listeners
                initializeModalListeners();
            });

            document.getElementById('sectionSearch').addEventListener('input', function() {
                var searchValue = this.value.toLowerCase();
                document.querySelectorAll('.section-card').forEach(function(card) {
                    var sectionName = card.getAttribute('data-section');
                    if (sectionName.includes(searchValue)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>

