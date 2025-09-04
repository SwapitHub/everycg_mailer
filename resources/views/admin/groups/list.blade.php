<x-admin-layout>
     <style>
        .card-contact-set {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .set-btn-common {
            display: flex;
            gap: 10px;
        }

        .set-btn-common input#search {
            padding-right: 30px;
        }

        span#select2-group_id-container {
            height: 35px !important;
        }
    </style>
    <div class="page-content container-xxl">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Groups</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="card-contact-set">
                            <div class="set-btn-common">
                                <button class="btn btn-primary" onclick="openGroupForm()">Add
                                group</button>
                            </div>
                            <form method="GET">
                                <div class="set-btn-common btn-set-custom">
                                    <input id="search" class="form-control text-capitalize" name="filter"
                                        type="search" placeholder="Search by name"
                                        value="{{ request('filter') }}">
                                    <button class="btn btn-primary ">Search</button>
                                    <button class="btn btn-secondary" type="reset">Reset</button>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Group name</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($lists as $list)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ ucfirst($list->name) }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $list->status == 1 ? 'success' : 'danger' }}">{{ $list->status == 1 ? 'Active' : 'Inactive' }}</span>
                                            </td>
                                            <td>{{ $list->created_at }}</td>
                                            <td>{{ $list->updated_at }}</td>
                                            <td>
                                                <button type="button" title="Edit"
                                                    onclick="editGroup({{ $list->id }},'{{ $list->name }}',{{ $list->status }})"
                                                    class="btn btn-primary btn-icon">
                                                    <i data-lucide="edit"></i>
                                                </button>
                                                <button type="button" title="Delete" class="btn btn-danger btn-icon"
                                                    onclick="deleteRecord('{{ route('group.delete', ['id' => $list->id]) }}')">
                                                    <i data-lucide="trash-2"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <div class="mt-2">
                                {{ $lists->appends(request()->except(['page', '_token']))->links('pagination::bootstrap-5') }}
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <form novalidate="novalidate" method="POST" id="actionForm" class="novalidate-form">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-body">
                        <div class="error-box">

                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input id="name" class="form-control text-capitalize" name="name" type="text">
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="status" class="form-check-input" id="status"
                                value="1">
                            <label class="form-check-label" for="status">
                                Enable
                            </label>
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
            function openGroupForm() {
                var actionUrl = "{{ route('group.create') }}";
                $("#actionForm")[0].reset();
                $("#status").prop('checked', true);
                $("#status").val(1);
                $("#actionForm").attr('action', actionUrl);
                $("#exampleModal").modal('show');
            }

            function editGroup(id, name, status) {
                var actionUrl = "{{ route('group.update', ['id' => ':id']) }}";
                actionUrl = actionUrl.replace(':id', id);
                $("#exampleModalLabel").text('Edit Group');
                $("#exampleModal").modal('show');
                $("#name").val(name);
                // Corrected checkbox handling
                if (status == 1) {
                    $("#status").prop('checked', true);
                    $("#status").val(1);
                } else {
                    $("#status").prop('checked', false);
                    $("#status").val(0);
                }
                $("#actionForm").attr('action', actionUrl);
            }
            $('#status').on('change', function() {
                if ($(this).is(':checked')) {
                    $(this).val(1);
                } else {
                    $(this).val(0);
                }
            });
        </script>
    @endpush

</x-admin-layout>
