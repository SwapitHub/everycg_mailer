<x-admin-layout>
    <div class="page-content container-xxl">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Smtp Configuration</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mail name</th>
                                        <th>Mail host</th>
                                        <th>Mail port</th>
                                        <th>Mail username</th>
                                        <th>Mail encryption</th>
                                        <th>Mail from address</th>
                                        <th>Mail from name</th>
                                        <th>Mail password</th>
                                        <th>Updated at</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $list->mail_mailer??'' }}</td>
                                        <td>{{ $list->mail_host??'' }}</td>
                                        <td>{{ $list->mail_port??'' }}</td>
                                        <td>{{ $list->mail_username??'' }}</td>
                                        <td>{{ $list->mail_encryption??'' }}</td>
                                        <td>{{ $list->mail_from_address??'' }}</td>
                                        <td>{{ $list->mail_from_name??'' }}</td>
                                        {{-- <td>{{ $list->mail_password??'' }}</td> --}}
                                        <td>**********</td>
                                        <td>{{ $list->updated_at??'' }}</td>
                                        <td>
                                            <button type="button" title="Edit"
                                                onclick="editConfig({{ $list->id??'' }})"
                                                class="btn btn-primary btn-icon">
                                                <i data-lucide="edit"></i>
                                            </button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update SMTP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <form action="{{ route('smtp.update',['id'=>$list->id??0]) }}" novalidate="novalidate" method="POST" id="actionForm" class="forms-sample novalidate-form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-body">
                        <div class="error-box"></div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Mailer <span class="text-danger">*</span></label>
                                <input class="form-control mb-4 mb-md-0" name="mail_mailer" id="mail_mailer">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mail host <span class="text-danger">*</span></label>
                                <input class="form-control" name="mail_host" id="mail_host">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Mail port <span class="text-danger">*</span></label>
                                <input class="form-control mb-4 mb-md-0" name="mail_port" id="mail_port">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mail username <span class="text-danger">*</span></label>
                                <input class="form-control" name="mail_username" id="mail_username">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Mail encryption</label>
                                <input class="form-control mb-4 mb-md-0" name="mail_encryption" id="mail_encryption">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mail from address <span class="text-danger">*</span></label>
                                <input class="form-control" name="mail_from_address" id="mail_from_address">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Mail from name <span class="text-danger">*</span></label>
                                <input class="form-control mb-4 mb-md-0" name="mail_from_name" id="mail_from_name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="active" id="active" class="form-control">
                                    <option value="1" selected >Active</option>
                                    <option value="0">Diactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <input class="form-control mb-4 mb-md-0" name="mail_password" id="mail_password">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submitBtn">Save changes <i data-lucide="loader"
                                class="spin d-none"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function editConfig(id) {
                const actionUrl = "{{ route('smtp.edit', ['id' => ':id']) }}".replace(':id', id);
                $.ajax({
                    url: actionUrl,
                    method: "GET",
                    success: function(response) {
                        $("#exampleModal").modal('show');

                        const fields = [
                            'mail_mailer',
                            'mail_host',
                            'mail_port',
                            'mail_username',
                            'mail_encryption',
                            'mail_from_address',
                            'mail_from_name',
                            'mail_password',
                            // 'active'
                        ];

                        fields.forEach(field => {
                            $(`#${field}`).val(response[field]);
                        });
                    },
                    error: function(xhr) {
                        console.error("Failed to fetch SMTP config:", xhr.responseText);
                        alert("Unable to load SMTP config. Please try again.");
                    }
                });
            }
        </script>
    @endpush

</x-admin-layout>
