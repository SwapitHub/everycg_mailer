<x-admin-layout>
    <div class="page-content container-xxl">

        <div class="row inbox-wrapper">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-xxl-2 border-end-lg">
                                <div class="aside-content">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <button class="navbar-toggle btn btn-icon border d-block d-lg-none"
                                            data-bs-target=".email-aside-nav" data-bs-toggle="collapse" type="button">
                                            <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" data-lucide="chevron-down"
                                                    class="lucide lucide-chevron-down">
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
                                            {{-- <li class="nav-item">
                                                <a class="nav-link d-flex align-items-center" href="{{ route('inbox') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" data-lucide="inbox"
                                                        class="lucide lucide-inbox icon-lg me-2">
                                                        <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                                        <path
                                                            d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                                                        </path>
                                                    </svg>
                                                    Inbox
                                                    <span class="badge bg-danger fw-bolder ms-auto">2
                                                    </span></a>
                                            </li> --}}
                                            <li class="nav-item">
                                                <a class="nav-link d-flex align-items-center"
                                                    href="{{ route('sent') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" data-lucide="mail"
                                                        class="lucide lucide-mail icon-lg me-2">
                                                        <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"></path>
                                                        <rect x="2" y="4" width="20" height="16" rx="2">
                                                        </rect>
                                                    </svg>
                                                    Sent
                                                </a>
                                            </li>
                                            {{-- <li class="nav-item">
                                                <a class="nav-link d-flex align-items-center" href="#">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" data-lucide="briefcase"
                                                        class="lucide lucide-briefcase icon-lg me-2">
                                                        <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                                        <rect width="20" height="14" x="2" y="6" rx="2">
                                                        </rect>
                                                    </svg>
                                                    Important
                                                    <span class="badge bg-secondary fw-bolder ms-auto">4
                                                    </span></a>
                                            </li> --}}
                                            <li class="nav-item">
                                                <a class="nav-link d-flex align-items-center" href="#">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" data-lucide="file"
                                                        class="lucide lucide-file icon-lg me-2">
                                                        <path
                                                            d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z">
                                                        </path>
                                                        <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                                    </svg>
                                                    Drafts
                                                    @if ($draftCount)
                                                        <span class="badge bg-secondary fw-bolder ms-auto">{{ $draftCount }}</span>
                                                    @endif
                                                </a>
                                            </li>

                                        </ul>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 col-xxl-10">
                                <div>
                                    <div class="d-flex align-items-center p-3 border-bottom fs-16px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" data-lucide="edit"
                                            class="lucide lucide-edit icon-md me-2">
                                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path
                                                d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z">
                                            </path>
                                        </svg>
                                        New message
                                    </div>
                                </div>
                                <form action="{{ route('send.email') }}" method="POST" id="composeEmail">
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="m-3 mb-0">
                                        <div class="to">
                                            <div class="row mb-3">
                                                <label class="col-md-2 col-form-label">Groups:</label>
                                                <div class="col-md-10">
                                                    <select class="js-example-basic-single form-select"
                                                        data-width="100%" name="group_id">
                                                        <option value="">Select</option>
                                                        @foreach ($groups as $group)
                                                            <option value="{{ $group->id }}"
                                                                {{ old('group_id') == $group->id ? 'selected' : '' }}>
                                                                {{ $group->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="to">
                                            <div class="row mb-3">
                                                <label class="col-md-2 col-form-label">To:</label>
                                                <div class="col-md-10">
                                                    <select class="js-example-basic-single form-select"
                                                        data-width="100%" name="to_email" required>
                                                        <option value="">Select</option>
                                                        @foreach ($contacts as $contact)
                                                            <option value="{{ $contact->email }}"
                                                                {{ old('email') == $contact->email ? 'selected' : '' }}>
                                                                {{ $contact->name }}
                                                                —
                                                                <span
                                                                    style="color: #999 !important">{{ $contact->email }}</span>
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="to cc">
                                            <div class="row mb-3">
                                                <label class="col-md-2 col-form-label">Cc</label>
                                                <div class="col-md-10">
                                                    <select class="js-example-basic-multiple form-select"
                                                        multiple="multiple" data-width="100%" name="cc_email">
                                                        <option value="TX">Select</option>
                                                        @foreach ($contacts as $contact)
                                                            <option value="{{ $contact->email }}">
                                                                {{ $contact->name }}
                                                                —
                                                                <span
                                                                    style="color: #999 !important">{{ $contact->email }}</span>
                                                            </option>
                                                        @endforeach
                                                    </select>

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
                                                <label class="form-label visually-hidden"
                                                    for="easyMdeEditor">Descriptions
                                                </label>
                                                <textarea class="form-control" name="body" id="easyMdeEditor" rows="5" style="display: none;">{{ old('body') }}</textarea>
                                            </div>
                                        </div>
                                        <div>
                                            {{-- <div class="col-md-12">
                                                <button class="btn btn-primary me-1 mb-1" type="submit"
                                                    name="action" value="send">
                                                    Send</button>
                                                <button class="btn btn-primary me-1 mb-1" type="submit"
                                                    name="action" value="draft">
                                                    <i data-lucide="file" style="height:15px"></i> Save as Draft
                                                </button>
                                                <button class="btn btn-secondary me-1 mb-1" type="button">
                                                    Cancel</button>
                                                <span id="responseMsg"
                                                    style="margin-left: 10px; font-weight: bold;"></span>
                                            </div> --}}
                                            <div class="col-md-12" id="form-actions">
                                                <button class="btn btn-primary me-1 mb-1" type="submit"
                                                    name="action" value="send" id="sendBtn">
                                                    Send
                                                </button>

                                                <button class="btn btn-primary me-1 mb-1" type="submit"
                                                    name="action" value="draft" id="draftBtn">
                                                    <i data-lucide="file" style="height:15px"></i> Save as Draft
                                                </button>

                                                <button class="btn btn-secondary me-1 mb-1" type="reset">
                                                    Cancel
                                                </button>

                                                <span id="responseMsg"
                                                    style="margin-left: 10px; font-weight: bold;"></span>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        <script>
            $('#composeEmail').on('submit', function(e) {
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
