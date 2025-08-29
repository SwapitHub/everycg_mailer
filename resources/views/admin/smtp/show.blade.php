<x-admin-layout>
    <div class="page-content container-xxl">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">SMTP Configuration</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">SMTP Settings</h5>
                        <form action="" method="POST" class="forms-sample">
                            @csrf

                            @php
                                $smtpKeys = [
                                    'MAIL_MAILER' => 'Mailer',
                                    'MAIL_HOST' => 'Mail Host',
                                    'MAIL_PORT' => 'Mail Port',
                                    'MAIL_USERNAME' => 'Mail Username',
                                    'MAIL_PASSWORD' => 'Mail Password',
                                    'MAIL_ENCRYPTION' => 'Mail Encryption',
                                    'MAIL_FROM_ADDRESS' => 'Mail From Address',
                                    'MAIL_FROM_NAME' => 'Mail From Name',
                                ];
                            @endphp

                            <div class="row">
                                @foreach ($smtpKeys as $key => $label)
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">{{ $label }} <span
                                                class="text-danger">*</span></label>
                                        <input type="{{ $key === 'MAIL_PASSWORD' ? 'password' : 'text' }}"
                                            name="settings[{{ $key }}]" class="form-control"
                                            value="{{ old('settings.' . $key, $settings[$key] ?? '') }}">
                                    </div>
                                @endforeach

                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <select name="settings[SMTP_STATUS]" class="form-control">
                                        <option value="1"
                                            {{ ($settings['SMTP_STATUS'] ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0"
                                            {{ ($settings['SMTP_STATUS'] ?? 1) == 0 ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
