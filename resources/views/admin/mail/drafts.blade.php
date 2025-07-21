<x-admin-layout>
    <div class="page-content container-xxl">

        <div class="row inbox-wrapper">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-xxl-2 border-end-lg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <button class="navbar-toggle btn btn-icon border d-block d-lg-none"
                                        data-bs-target=".email-aside-nav" data-bs-toggle="collapse" type="button">
                                        <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                data-lucide="chevron-down" class="lucide lucide-chevron-down">
                                                <path d="m6 9 6 6 6-6"></path>
                                            </svg></span>
                                    </button>
                                    <div class="order-first">
                                        <h4>Mail Service</h4>
                                        <p class="text-secondary"> {{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                <div class="d-grid my-3">
                                    <a class="btn btn-primary" href="{{ route('compose') }}">Compose Email</a>
                                </div>
                                <div class="email-aside-nav collapse">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link d-flex align-items-center" href="{{ route('sent') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    data-lucide="mail" class="lucide lucide-mail icon-lg me-2">
                                                    <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"></path>
                                                    <rect x="2" y="4" width="20" height="16" rx="2">
                                                    </rect>
                                                </svg>
                                                Sent Mail
                                            </a>
                                        </li>

                                        <li class="nav-item active">
                                            <a class="nav-link d-flex align-items-center" href="{{ route('drafts') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    data-lucide="file" class="lucide lucide-file icon-lg me-2">
                                                    <path
                                                        d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z">
                                                    </path>
                                                    <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                                </svg>
                                                Drafts
                                                @if ($draftCount)
                                                    <span class="badge bg-secondary fw-bolder ms-auto"
                                                        id="draft-count">{{ $draftCount }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9 col-xxl-10">
                                <div class="p-3 border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <div class="d-flex align-items-end mb-2 mb-lg-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    data-lucide="inbox" class="lucide lucide-inbox text-secondary me-2">
                                                    <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                                    <path
                                                        d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                                                    </path>
                                                </svg>
                                                <h4 class="me-1">Draft</h4>
                                                {{-- <span class="text-secondary">(2 new messages)</span> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <input class="form-control" type="text" placeholder="Search mail...">
                                                <button class="btn btn-icon border bg-transparent" type="button"
                                                    id="button-search-addon"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" data-lucide="search"
                                                        class="lucide lucide-search">
                                                        <path d="m21 21-4.34-4.34"></path>
                                                        <circle cx="11" cy="11" r="8"></circle>
                                                    </svg></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="p-3 border-bottom d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="d-none d-md-flex align-items-center flex-wrap">
                                        <div class="form-check me-3">
                                            <input type="checkbox" class="form-check-input" id="inboxCheckAll">
                                        </div>
                                        <div class="btn-group me-2">
                                            <button class="btn btn-outline-primary" type="button"
                                                id="deleteDrafts">Delete</button>
                                        </div>
                                        <div class="btn-group me-2 d-none d-xl-block">
                                            <button class="btn btn-outline-primary dropdown-toggle"
                                                data-bs-toggle="dropdown" type="button">Order by <span
                                                    class="caret"></span></button>
                                            <div class="dropdown-menu" role="menu">
                                                <a class="dropdown-item" href="#">Date</a>
                                                <a class="dropdown-item" href="#">Subject</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-end flex-grow-1 mt-3">
                                        <span class="me-2">
                                            {{ $drafts->firstItem() }}-{{ $drafts->lastItem() }} of {{ $drafts->total() }}
                                        </span>
                                        <div class="btn-group">
                                            {{-- Previous Page --}}
                                            <a href="{{ $drafts->previousPageUrl() ?? '#' }}"
                                                class="btn btn-outline-secondary btn-icon {{ $drafts->onFirstPage() ? 'disabled' : '' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-chevron-left">
                                                    <path d="m15 18-6-6 6-6"></path>
                                                </svg>
                                            </a>

                                            {{-- Next Page --}}
                                            <a href="{{ $drafts->nextPageUrl() ?? '#' }}"
                                                class="btn btn-outline-secondary btn-icon {{ !$drafts->hasMorePages() ? 'disabled' : '' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-chevron-right">
                                                    <path d="m9 18 6-6-6-6"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <div class="email-list">

                                    @foreach ($drafts as $draft)
                                        <!-- email list item -->
                                        <div class="email-list-item" id="draft-{{ $draft->id }}">
                                            <div class="email-list-actions">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input draft-checkbox"
                                                        id="draft-{{ $draft->id }}"
                                                        data-id="{{ $draft->id }}">
                                                </div>
                                            </div>
                                            <a href="javascript:;" onclick="openDraft({{ $draft->id }})"
                                                class="email-list-detail">
                                                <div class="content">
                                                    <span class="from text-danger">Draft</span>
                                                    <p class="msg">{{ $draft->body }}</p>
                                                </div>
                                                <span class="date">
                                                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            data-lucide="paperclip" class="lucide lucide-paperclip">
                                                            <path d="M13.234 20.252 21 12.3"></path>
                                                            <path
                                                                d="m16 6-8.414 8.586a2 2 0 0 0 0 2.828 2 2 0 0 0 2.828 0l8.414-8.586a4 4 0 0 0 0-5.656 4 4 0 0 0-5.656 0l-8.415 8.585a6 6 0 1 0 8.486 8.486">
                                                            </path>
                                                        </svg> </span>
                                                    {{-- 14 Jan --}}
                                                    {{ date('d M', strtotime($draft->created_at)) }}
                                                </span>
                                            </a>
                                        </div>
                                        <!-- end email list item -->
                                    @endforeach


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center p-3 border-bottom fs-16px">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" data-lucide="edit" class="lucide lucide-edit icon-md me-2">
                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path
                                d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z">
                            </path>
                        </svg>
                        New message
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="btn-close"></button>
                </div>
                <form method="POST" novalidate="novalidate" id="draftFrom">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="m-3 mb-0">
                            <div class="to">
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label">Groups:</label>
                                    <div class="col-md-10">
                                        <select id="group_id" name="group_id" class="form-select "
                                            data-width="100%">
                                            <option value="">Select</option>
                                            @foreach ($groups as $group)
                                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="to">
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label">To:</label>
                                    <div class="col-md-10">
                                        <select id="to_email" name="to_email" class="form-select"
                                            data-width="100%">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="to cc">
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label">Cc</label>
                                    <div class="col-md-10">
                                        <input type="email" name="cc_email" id="cc_email" class="form-control"
                                            data-width="100%">
                                    </div>
                                </div>
                            </div>
                            <div class="subject">
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label">Subject</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="subject"
                                            value="{{ old('subject') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mx-3">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label visually-hidden" for="msgBody">Descriptions
                                    </label>
                                    <textarea class="form-control" id="msgBody" name="body" rows="5" required>{{ old('body') }}</textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <span id="responseMsg" style="margin-left: 10px; font-weight: bold;"></span>
                        <button type="submit" class="btn btn-primary" id="sendBtn">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $("#js-single-select").select2();
            window.deleteDraftUrl = "{{ route('email.remove', ['id' => '__ID__']) }}";

            function openDraft(id) {
                $('#group_id').select2({
                    dropdownParent: $('#exampleModal')
                });
                var actionUrl = "{{ route('drafts.edit', ['id' => ':id']) }}";
                actionUrl = actionUrl.replace(':id', id);
                $.ajax({
                    url: actionUrl,
                    type: 'GET',
                    success: function(response) {
                        var draftId = response.id;
                        var fromUrl = "{{ route('drafts.sent', ['id' => ':id']) }}";
                        fromUrl = fromUrl.replace(':id', draftId);
                        $("#draftFrom").attr('action', fromUrl)
                        $("#exampleModal").modal('show');
                        //console.log(response);
                        $('#group_id').val(response.group_id);
                        setGroups(response.group_id, response.to_email);
                        $('#to_email').val(response.to_email);
                        $('#cc_email').val(response.cc_email);
                        $('input[name="subject"]').val(response.subject);
                        const easyEditor = document.querySelector('#msgBody');
                        if (easyEditor) {
                            if (typeof easymde !== 'undefined') {
                                easymde.toTextArea();
                                easymde = null;
                            }
                            easymde = new EasyMDE({
                                element: easyEditor,
                                autofocus: true
                            });
                            easymde.value(response.body);
                            setTimeout(() => {
                                easymde.codemirror.refresh();
                            }, 100);
                        }
                    },
                    error: function() {
                        alert('Failed to load email data');
                    }
                });
            }

            function setGroups(groupId, toemail) {
                var actionUrl = "{{ route('contact.get', ['groupId' => ':groupId']) }}";
                actionUrl = actionUrl.replace(':groupId', groupId);
                $('#to_email').empty().append('<option value="">Loading...</option>');
                $('#to_email').select2({
                    dropdownParent: $('#exampleModal')
                });
                if (groupId) {
                    $.ajax({
                        url: actionUrl,
                        method: 'GET',
                        success: function(data) {
                            $('#to_email').empty().append('<option value="">Select</option>');

                            $.each(data.contacts, function(key, contact) {
                                $('#to_email').append($('<option></option>').val(contact.email).text(contact
                                    .name + ' — ' + contact.email));
                            });
                            if (toemail) {
                                $('#to_email').val(toemail);
                            }
                        },
                        error: function() {
                            $('#to_email').empty().append('<option value="">No contacts found</option>');
                        }
                    });
                } else {
                    $('#to_email').empty().append('<option value="">Select</option>');
                }
            }


            $('#draftFrom').on('submit', function(e) {
                e.preventDefault();
                var action = $(document.activeElement).val();
                var $button = $(document.activeElement);
                // Disable button and show spinner
                $button.prop('disabled', true);
                $button.data('original-text', $button.html());
                $button.html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                );
                // Clear previous response
                $('#responseMsg').text('');
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize() + '&action=' + action,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#responseMsg').text(response.message).css('color', 'green');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(xhr) {
                        let msg = xhr.responseJSON?.message || 'Something went wrong';
                        $('#responseMsg').text(msg).css('color', 'red');
                    },
                    complete: function() {
                        // Re-enable button and restore text
                        $button.prop('disabled', false);
                        $button.html($button.data('original-text'));
                    }
                });
            });
        </script>
    @endpush
</x-admin-layout>
