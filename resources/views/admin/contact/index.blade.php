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
                                    <label class="form-label">Office Timing (HTML Editor)</label>
                                    <div id="office-timing-editor" style="height: 250px; background: white; border: 1px solid #ddd; border-radius: 4px;"></div>
                                    <input type="hidden" name="office_timing" id="office_timing" value="{{ $settings->office_timing }}">
                                    <small class="text-muted d-block mt-2">Format your office hours with proper line breaks and styling.</small>
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
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-4 text-muted">No messages yet.
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

    @push('styles')
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @endpush

    @push('scripts')
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Initialize Quill Editor
            const quill = new Quill('#office-timing-editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['blockquote', 'code-block'],
                        [{ 'header': [1, 2, 3, false] }],
                        ['link'],
                        ['clean']
                    ]
                },
                placeholder: 'e.g. Monday - Friday: 9 AM - 6 PM\nSaturday: 10 AM - 4 PM\nSunday: Closed'
            });

            // Load existing content into Quill
            const officeTimingValue = document.getElementById('office_timing').value;
            if (officeTimingValue) {
                quill.root.innerHTML = officeTimingValue;
            }

            // Update Settings AJAX
            $('#updateSettingsForm').on('submit', function(e) {
                e.preventDefault();

                // Get Quill content
                const officeTimingContent = quill.root.innerHTML;
                document.getElementById('office_timing').value = officeTimingContent;

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
