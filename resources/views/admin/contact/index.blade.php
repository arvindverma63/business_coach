<x-app-layout title="Contact Management | Admin">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3">
                <h4 class="fs-18 fw-semibold m-0">Contact & Inquiries</h4>
                <span class="text-muted">Manage page details and view user messages</span>
            </div>

            <div class="row">
                <div class="col-xl-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">General Contact Info</h5>
                        </div>
                        <div class="card-body">
                            <form id="updateSettingsForm">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Contact Phone</label>
                                    <input type="text" name="phone" class="form-control"
                                        value="{{ $settings->phone }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Contact Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ $settings->email }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Physical Address</label>
                                    <textarea name="address" class="form-control" rows="3">{{ $settings->address }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Office Timing (HTML allowed)</label>
                                    <textarea name="office_timing" class="form-control" rows="4" placeholder="e.g. <div class='time-item'>...</div>">{{ $settings->office_timing }}</textarea>
                                    <small class="text-muted">You can paste the HTML structure here for custom
                                        styling.</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Google Map Iframe URL</label>
                                    <textarea name="google_map_link" class="form-control" rows="3" placeholder="Paste <iframe> code here">{{ $settings->google_map_link }}</textarea>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary w-100" id="btnSaveSettings">Update
                                        Details</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">User Inquiries (Inbox)</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($inquiries as $msg)
                                            <tr id="inquiry-{{ $msg->id }}">
                                                <td class="small">{{ $msg->created_at->format('d M, Y') }}</td>
                                                <td class="fw-medium">{{ $msg->first_name }} {{ $msg->last_name }}</td>
                                                <td><a href="mailto:{{ $msg->email }}">{{ $msg->email }}</a></td>
                                                <td>
                                                    <button class="btn btn-sm btn-light border"
                                                        onclick="viewMessage('{{ addslashes($msg->message) }}')">
                                                        Read Message
                                                    </button>
                                                </td>
                                                <td class="text-end">
                                                    <button class="btn btn-sm btn-outline-danger delete-inquiry"
                                                        data-id="{{ $msg->id }}">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4 text-muted">No messages yet.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            {{ $inquiries->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Update Settings AJAX
            $('#updateSettingsForm').on('submit', function(e) {
                e.preventDefault();
                let btn = $('#btnSaveSettings');
                btn.prop('disabled', true).text('Saving...');

                $.post("{{ route('admin.contact.settings.update') }}", $(this).serialize())
                    .done(function(res) {
                        Swal.fire('Updated!', res.message, 'success');
                    })
                    .fail(function() {
                        Swal.fire('Error', 'Failed to update details', 'error');
                    })
                    .always(() => btn.prop('disabled', false).text('Update Details'));
            });

            // Delete Inquiry AJAX
            $('.delete-inquiry').on('click', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Delete this message?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('admin/contact/inquiry') }}/" + id,
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(res) {
                                $(`#inquiry-${id}`).fadeOut();
                                toastr.success(res.message);
                            }
                        });
                    }
                });
            });

            // Simple Message Viewer
            function viewMessage(msg) {
                Swal.fire({
                    title: 'Message Content',
                    text: msg,
                    confirmButtonText: 'Close'
                });
            }
        </script>
    @endpush
</x-app-layout>
