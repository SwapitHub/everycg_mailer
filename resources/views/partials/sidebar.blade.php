<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            {{-- Noble<span>UI</span> --}}
            <img src="{{ asset('theme') }}/images/every-cg-logo.png" alt="Logo">
        </a>
        <div class="sidebar-toggler">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav" id="sidebarNav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-lucide="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">web apps</li>
            <li class="nav-item">
                <a href="{{ route('groups') }}" class="nav-link">
                    <i class="link-icon" data-lucide="users"></i>
                    <span class="link-title">Groups</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('contacts') }}" class="nav-link">
                    <i class="link-icon" data-lucide="user-plus"></i>
                    <span class="link-title">Contacts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false"
                    aria-controls="emails">
                    <i class="link-icon" data-lucide="mail"></i>
                    <span class="link-title">Email</span>
                    <i class="link-arrow" data-lucide="chevron-down"></i>
                </a>
                <div class="collapse" data-bs-parent="#sidebarNav" id="emails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('smtp') }}" class="nav-link">SMTP</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('inbox') }}" class="nav-link">Inbox</a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('drafts') }}" class="nav-link">Drafts</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sent') }}" class="nav-link">Sent</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('compose') }}" class="nav-link">Compose</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
