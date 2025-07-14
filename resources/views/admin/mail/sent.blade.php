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
                                        {{-- <li class="nav-item ">
                                            <a class="nav-link d-flex align-items-center" href="{{ route('inbox') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    data-lucide="inbox" class="lucide lucide-inbox icon-lg me-2">
                                                    <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                                    <path
                                                        d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                                                    </path>
                                                </svg>
                                                Inbox
                                                <span class="badge bg-danger fw-bolder ms-auto">2
                                                </span></a>
                                        </li> --}}
                                        <li class="nav-item active">
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

                                        <li class="nav-item">
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
                                                    <span class="badge bg-secondary fw-bolder ms-auto">{{ $draftCount }}</span>
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
                                                <h4 class="me-1">Sent</h4>
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
                                            <button class="btn btn-outline-primary dropdown-toggle"
                                                data-bs-toggle="dropdown" type="button"> With selected <span
                                                    class="caret"></span></button>
                                            <div class="dropdown-menu" role="menu">
                                                <a class="dropdown-item" href="#">Mark as read</a>
                                                <a class="dropdown-item" href="#">Mark as unread</a><a
                                                    class="dropdown-item" href="#">Spam</a>
                                                <div class="dropdown-divider"></div><a
                                                    class="dropdown-item text-danger" href="#">Delete</a>
                                            </div>
                                        </div>
                                        <div class="btn-group me-2">
                                            <button class="btn btn-outline-primary" type="button">Delete</button>
                                        </div>
                                        <div class="btn-group me-2 d-none d-xl-block">
                                            <button class="btn btn-outline-primary dropdown-toggle"
                                                data-bs-toggle="dropdown" type="button">Order by <span
                                                    class="caret"></span></button>
                                            <div class="dropdown-menu" role="menu">
                                                <a class="dropdown-item" href="#">Date</a>
                                                <a class="dropdown-item" href="#">From</a>
                                                <a class="dropdown-item" href="#">Subject</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Size</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-end flex-grow-1">
                                        <span class="me-2">1-10 of 253</span>
                                        <div class="btn-group">
                                            <button class="btn btn-outline-secondary btn-icon" type="button"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    data-lucide="chevron-left" class="lucide lucide-chevron-left">
                                                    <path d="m15 18-6-6 6-6"></path>
                                                </svg></button>
                                            <button class="btn btn-outline-secondary btn-icon" type="button"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    data-lucide="chevron-right" class="lucide lucide-chevron-right">
                                                    <path d="m9 18 6-6-6-6"></path>
                                                </svg></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="email-list">

                                    @foreach ($lists as $list)
                                        <!-- email list item -->
                                        <div class="email-list-item">
                                            <div class="email-list-actions">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input">
                                                </div>
                                            </div>
                                            <a href="#" class="email-list-detail">
                                                <div class="content">
                                                    <span class="from ">To: {{ $list->to_email }}</span>
                                                    <p class="msg"><b>{{ $list->subject }}<b></p>
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
                                                    {{ date('d M', strtotime($list->created_at)) }}
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
</x-admin-layout>
