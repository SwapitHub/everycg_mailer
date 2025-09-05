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
                                    contact
                                </button>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">
                                    Import Contacts <i data-lucide="download"></i>
                                </button>
                            </div>
                            <form method="GET">
                                <div class="set-btn-common btn-set-custom">
                                    <input id="search" class="form-control text-capitalize" name="filter"
                                        type="search" placeholder="Search by contact name, email, group "
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Group name</th>
                                        {{-- <th>Status</th> --}}
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
                                            <td>{{ $list->email }}</td>
                                            <td>{{ $list->group->name }}</td>
                                            {{-- <td>
                                                <span
                                                    class="badge bg-{{ $list->status == 1 ? 'success' : 'danger' }}">{{ $list->status == 1 ? 'Active' : 'Inactive' }}</span>
                                            </td> --}}
                                            <td>{{ $list->created_at }}</td>
                                            <td>{{ $list->updated_at }}</td>
                                            <td>
                                                <button type="button" title="Edit"
                                                    onclick="editGroup({{ $list->id }},'{{ $list->name }}')"
                                                    class="btn btn-primary btn-icon">
                                                    <i data-lucide="edit"></i>
                                                </button>
                                                <button type="button" title="Delete" class="btn btn-danger btn-icon"
                                                    onclick="deleteRecord('{{ route('contact.delete', ['id' => $list->id]) }}')">
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <form novalidate="novalidate" method="POST" id="actionForm" class="novalidate-form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-body">
                        <div class="error-box"></div>

                        <div class="mb-3">
                            <label for="group_id" class="form-label">Group <span class="text-danger">*</span></label>
                            <select class="js-example-basic-single" name="group_id" id="group_id" data-width="100%" required>
                                <option disabled selected>Select your group</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ ucfirst($group->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input id="name" class="form-control text-capitalize" name="name" type="text">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input id="email" class="form-control" name="email" type="email">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submitBtn">
                            Save changes <i data-lucide="loader" class="spin d-none"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalModalLabel">Import contacts</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="btn-close"></button>
                </div>
                <form novalidate="novalidate" action="{{ route('contacts.import') }}" method="POST"
                    id="importModal" class="novalidate-form" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-body">
                        <div class="error-box">

                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Upload file <span class="text-danger">*</span></label>
                            <input id="contact-file" class="form-control text-capitalize" required
                                name="contact-file" type="file"
                                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
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
            $(document).ready(function() {
                // ✅ initialize once with modal as parent
                $('#group_id').select2({
                    dropdownParent: $('#exampleModal')
                });
            });

            function openGroupForm() {
                $("#actionForm")[0].reset();
                $('#group_id').val(null).trigger('change'); // reset select2
                var actionUrl = "{{ route('contact.create') }}";
                $("#exampleModalLabel").text('Add Contact');
                $("#actionForm").attr('action', actionUrl);
                $("#exampleModal").modal('show');
            }

            function editGroup(id) {
                var editUrl = "{{ route('contact.edit', ['id' => ':id']) }}".replace(':id', id);

                $.ajax({
                    url: editUrl,
                    method: "GET",
                    success: function(xhr) {
                        var actionUrl = "{{ route('contact.update', ['id' => ':id']) }}".replace(':id', id);
                        $("#actionForm").attr('action', actionUrl);
                        $("#exampleModalLabel").text('Edit Contact');
                        $("#exampleModal").modal('show');

                        // ✅ set select2 properly
                        $('#group_id').val(xhr.group_id).trigger('change');
                        $("#name").val(xhr.name);
                        $("#email").val(xhr.email);
                    }
                });
            }
        </script>
    @endpush


</x-admin-layout>
