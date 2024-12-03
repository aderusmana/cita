<x-app-layout>
    @section('title')
        My Ideas
    @endsection

    <div class="card w-100 position-relative overflow-hidden">
        <div class="px-4 py-3 border-bottom">
          <h4 class="card-title mb-0">My Ideas</h4>
        </div>
        <div class="card-body p-4">
          <div class="table-responsive mb-4 border rounded-1">
            <table class="table text-nowrap mb-0 align-middle">
              <thead class="text-dark fs-4">
                <tr>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Title</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Tracking</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Like</h6>
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($ideasWithLikes as $idea)
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{ asset('assets') }}/images/profile/{{ $idea->avatar ?? 'user-9.jpg' }}" class="rounded-circle" width="40" height="40">
                      <div class="ms-3">
                        <h6 class="fs-4 fw-semibold mb-0">{{ $idea->title }}</h6>
                        <span class="badge @if($idea->category_id == 1) bg-success @elseif($idea->category_id == 2) bg-primary @elseif($idea->category_id == 3) bg-warning @elseif($idea->category_id == 4) bg-info @else bg-secondary @endif">{{ $idea->category['name'] ?? 'Kategori Tidak Diketahui' }}</span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="mb-0 fw-normal fs-4">{{ $idea->status }}</p>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      @php
                          $approvalPath = $idea->approval_path ? json_decode($idea->approval_path, true) : [];
                      @endphp
                      @foreach($approvalPath as $approval)
                          @php
                              $user = \App\Models\User::where('nik', $approval['approver_nik'])->first();
                              $initial = $user ? strtoupper(substr($user->name, 0, 1)) : 'N/A';
                              $colors = ['bg-primary', 'bg-success', 'bg-warning', 'bg-info', 'bg-danger'];
                              $color = $colors[$loop->iteration % 5];
                          @endphp
                          <a href="javascript:void(0)" class="{{ $color }} text-white fs-6 round-40 rounded-circle me-n2 card-hover border  border-white d-flex align-items-center justify-content-center">
                              {{ $initial }}
                          </a>
                      @endforeach
                      @if($idea->status == 'Published')
                          <span class="badge bg-success text-white fs-2 card-hover border  border-white d-flex align-items-center justify-content-center">
                              Approved
                          </span>
                      @elseif($idea->status == 'Rejected')
                          <span class="badge bg-danger text-white fs-2 card-hover border  border-white d-flex align-items-center justify-content-center">
                              Rejected
                          </span>
                      @endif
                    </div>
                  </td>
                  <td>
                    <h6 class="fs-4 fw-semibold mb-0">{{ $idea->likes_count }}</h6>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</x-app-layout>
