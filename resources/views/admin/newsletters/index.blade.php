<x-app-layout title="Newsletter Management">
    <div class="container-fluid">
        <div class="py-3 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="m-0 fw-bold">Newsletter Subscribers</h4>
                <p class="text-muted small mb-0">Manage your marketing mailing list</p>
            </div>
            <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addSubscriberModal">
                <i class="mdi mdi-plus-circle me-1"></i> Add Subscriber
            </button>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <form action="{{ route('admin.newsletters.index') }}" method="GET" class="row g-2">
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search by email or name..." value="{{ request('search') }}">
                            <button class="btn btn-light border" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-3" style="width: 50px;">#</th>
                                <th>Subscriber</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th class="text-end pe-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subscribers as $item)
                                <tr id="row-{{ $item->id }}">
                                    <td class="ps-3 text-muted">
                                        {{ ($subscribers->currentPage() - 1) * $subscribers->perPage() + $loop->iteration }}
                                    </td>
                                    <td>
                                        <span class="fw-medium text-dark">{{ $item->name ?? 'Anonymous' }}</span>
                                    </td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox"
                                                data-id="{{ $item->id }}" {{ $item->is_active ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-end pe-3">
                                        <button class="btn btn-sm btn-outline-danger delete-btn"
                                            data-id="{{ $item->id }}">
                                            <i class="mdi mdi-delete-outline"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No subscribers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                <div class="small text-muted">
                    Showing {{ $subscribers->firstItem() ?? 0 }} to {{ $subscribers->lastItem() ?? 0 }} of
                    {{ $subscribers->total() }}
                </div>
                <div>
                    {{ $subscribers->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addSubscriberModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title">New Subscription</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="addSubscriberForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Full Name (Optional)</label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="john@example.com"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btnSave">Save Subscriber</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                // 1. Manual Add via AJAX
                $('#addSubscriberForm').on('submit', function(e) {
                    e.preventDefault();
                    let btn = $('#btnSave');
                    btn.prop('disabled', true).text('Saving...');

                    $.post("{{ route('admin.newsletters.store') }}", $(this).serialize())
                        .done(function(res) {
                            $('#addSubscriberModal').modal('hide');
                            Swal.fire('Success', res.message, 'success').then(() => location.reload());
                        })
                        .fail(function(err) {
                            btn.prop('disabled', false).text('Save Subscriber');
                            let msg = err.responseJSON.message || 'Error occurred';
                            Swal.fire('Error', msg, 'error');
                        });
                });

                // 2. Toggle Status via AJAX
                $('.status-toggle').on('change', function() {
                    let id = $(this).data('id');
                    $.post("{{ route('admin.newsletters.toggle-status') }}", {
                        _token: "{{ csrf_token() }}",
                        id: id
                    }).done(function(res) {
                        toastr.success(res.message);
                    }).fail(function() {
                        toastr.error("Update failed.");
                    });
                });

                // 3. Delete via AJAX
                $('.delete-btn').on('click', function() {
                    let id = $(this).data('id');
                    Swal.fire({
                        title: 'Are you sure?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ url('admin/newsletters') }}/" + id,
                                type: 'DELETE',
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(res) {
                                    $(`#row-${id}`).fadeOut();
                                    toastr.success(res.message);
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
