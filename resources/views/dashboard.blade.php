<x-admin-layout>
    <div class="page-content container-xxl">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
            </div>

        </div>

        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow-1">
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">New Groups</h6>
                                </div>
                                <a href="{{route('groups') }}">
                                    <div class="row">
                                        <div class="col-6 col-md-12 col-xl-5">
                                            <h3 class="mb-2">{{ $groupCount }}</h3>
                                            <div class="d-flex align-items-baseline">
                                                @php
                                                    $isPositive = $groupGrowth >= 0;
                                                @endphp
                                                <p class="{{ $isPositive ? 'text-success' : 'text-danger' }}">
                                                    <span>{{ number_format($groupGrowth, 1) }}%</span>
                                                    @if ($isPositive)
                                                        <i data-lucide="arrow-up" class="icon-sm mb-1"></i>
                                                    @else
                                                        <i data-lucide="arrow-down" class="icon-sm mb-1"></i>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-12 col-xl-7">
                                            <div id="groupsChart" class="mt-md-3 mt-xl-0"></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">New Contacts</h6>
                                </div>
                                <a href="{{ route('contacts') }}">
                                    <div class="row">
                                        <div class="col-6 col-md-12 col-xl-5">
                                            <h3 class="mb-2">{{ $contactCount }}</h3>
                                            <div class="d-flex align-items-baseline">
                                                @php
                                                    $isPositive = $contactGrowth >= 0;
                                                @endphp

                                                <p class="{{ $isPositive ? 'text-success' : 'text-danger' }}">
                                                    <span>{{ number_format($contactGrowth, 1) }}%</span>
                                                    @if ($isPositive)
                                                        <i data-lucide="arrow-up" class="icon-sm mb-1"></i>
                                                    @else
                                                        <i data-lucide="arrow-down" class="icon-sm mb-1"></i>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12 col-xl-7">
                                            {{-- <div id="ordersChart" class="mt-md-3 mt-xl-0"></div> --}}
                                            <div id="contactsChart" class="mt-md-3 mt-xl-0"></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Drafts</h6>
                                </div>
                                <a href="{{ route('drafts') }}">
                                    <div class="row">
                                        <div class="col-6 col-md-12 col-xl-5">
                                            <h3 class="mb-2">{{ $draftCount }}</h3>
                                            <div class="d-flex align-items-baseline">
                                                @php
                                                    $isPositive = $draftGrowth >= 0;
                                                @endphp

                                                <p class="{{ $isPositive ? 'text-success' : 'text-danger' }}">
                                                    <span>{{ number_format($draftGrowth, 1) }}%</span>
                                                    @if ($isPositive)
                                                        <i data-lucide="arrow-up" class="icon-sm mb-1"></i>
                                                    @else
                                                        <i data-lucide="arrow-down" class="icon-sm mb-1"></i>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12 col-xl-7">
                                            <div id="draftsChart" class="mt-md-3 mt-xl-0"></div>
                                            {{-- <div id="growthChart" class="mt-md-3 mt-xl-0"></div> --}}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->

    </div>
    @push('scripts')
        <script>
            // Groups chart
            const colors = window.config.colors;
            document.addEventListener("DOMContentLoaded", function() {
                var options = {
                    chart: {
                        type: "line",
                        height: 60,
                        sparkline: {
                            enabled: !0
                        }
                    },
                    series: [{
                        name: 'Groups',
                        data: @json($groupsChartData['totals'])
                    }],
                    xaxis: {
                        categories: @json($groupsChartData['dates'])
                    },
                    markers: {
                        size: 0
                    },
                    stroke: {
                        width: 2,
                        curve: "smooth"
                    },
                    colors: [colors.primary],
                };

                var chart = new ApexCharts(document.querySelector("#groupsChart"), options);
                chart.render();
            });
            // Draft chart
            document.addEventListener("DOMContentLoaded", function() {
                var options = {
                    chart: {
                        type: "bar",
                        height: 60,
                        sparkline: {
                            enabled: true
                        }
                    },
                    series: [{
                        name: "Contacts",
                        data: @json($contactsChartData['totals'])
                    }],
                    xaxis: {
                        categories: @json($contactsChartData['dates'])
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: "60%",
                            borderRadius: 2
                        }
                    },
                    colors: [colors.primary],
                };

                new ApexCharts(document.querySelector("#contactsChart"), options).render();
            });
            //fraft chart
            document.addEventListener("DOMContentLoaded", function() {
                var options = {
                    chart: {
                        type: "line",
                        height: 60,
                        sparkline: {
                            enabled: true
                        }
                    },
                    series: [{
                        name: "Drafts",
                        data: @json($draftsChartData['totals'])
                    }],
                    xaxis: {
                        categories: @json($draftsChartData['dates'])
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: "60%",
                            borderRadius: 2
                        }
                    },
                    colors: [colors.primary],
                };

                new ApexCharts(document.querySelector("#draftsChart"), options).render();
            });
        </script>
    @endpush
</x-admin-layout>
