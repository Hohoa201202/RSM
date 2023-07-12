@extends('layouts.admin._Layout')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <h1>Thống kê</h1>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12 d-flex mb-3">
                    <a href="{{ route('statistical', ['filter' => 1]) }}"
                        class="btn btn-light me-2 @if ($check == 1) active @endif">Hôm nay</a>
                    <a href="{{ route('statistical', ['filter' => 2]) }}"
                        class="btn btn-light me-2 @if ($check == 2) active @endif">Tháng này</a>
                    <a href="{{ route('statistical', ['filter' => 3]) }}"
                        class="btn btn-light me-2 @if ($check == 3) active @endif">Năm nay</a>
                    <a href="{{ route('statistical', ['filter' => null]) }}"
                        class="btn btn-light me-2 @if ($check == null) active @endif">Tất cả</a>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body p-4">
                                    <h5 class="card-title">Hóa đơn </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $order }}</h6>
                                            @if ($percentOrder > 0 && $check === 1)
                                                <span class="text-muted small pt-2 ps-0">Tăng</span>
                                                <span class="text-success small pt-1 fw-bold">{{ $percentOrder }}%</span>
                                                <span class="text-muted small pt-2">so với hôm qua</span>
                                            @elseif($percentOrder < 0 && $check === 1)
                                                <span class="text-muted small pt-2 ps-0">Giảm</span>
                                                <span class="text-danger small pt-1 fw-bold">{{ $percentOrder }}%</span>
                                                <span class="text-muted small pt-2">so với hôm qua</span>
                                            @elseif($percentOrder == 0 && $check === 1)
                                                <span class="text-muted small pt-2">Bằng với hôm qua</span>
                                            @elseif($percentOrder > 0 && $check === 2)
                                                <span class="text-muted small pt-2 ps-0">Tăng</span>
                                                <span class="text-success small pt-1 fw-bold">{{ $percentOrder }}%</span>
                                                <span class="text-muted small pt-2">so với tháng trước</span>
                                            @elseif($percentOrder < 0 && $check === 2)
                                                <span class="text-muted small pt-2 ps-0">Giảm</span>
                                                <span class="text-danger small pt-1 fw-bold">{{ $percentOrder }}%</span>
                                                <span class="text-muted small pt-2">so với tháng trước</span>
                                            @elseif($percentOrder > 0 && $check === 3)
                                                <span class="text-muted small pt-2 ps-0">Tăng</span>
                                                <span class="text-success small pt-1 fw-bold">{{ $percentOrder }}%</span>
                                                <span class="text-muted small pt-2">so với năm trước</span>
                                            @elseif($percentOrder < 0 && $check === 3)
                                                <span class="text-muted small pt-2 ps-0">Giảm</span>
                                                <span class="text-danger small pt-1 fw-bold">{{ $percentOrder }}%</span>
                                                <span class="text-muted small pt-2">so với năm trước</span>
                                            @else
                                                {{-- <span class="small pt-1 fw-bold">%</span> --}}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">


                                <div class="card-body p-4">
                                    <h5 class="card-title">Doanh thu </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ number_format($revenue, 0, '.', '.') }} đ</h6>
                                            @if ($percentDoanhThu > 0 && $check === 1)
                                                <span class="text-muted small pt-2 ps-0">Tăng</span>
                                                <span
                                                    class="text-success small pt-1 fw-bold">{{ $percentDoanhThu }}%</span>
                                                <span class="text-muted small pt-2">so với hôm qua</span>
                                            @elseif($percentDoanhThu < 0 && $check === 1)
                                                <span class="text-muted small pt-2 ps-0">Giảm</span>
                                                <span class="text-danger small pt-1 fw-bold">{{ $percentDoanhThu }}%</span>
                                                <span class="text-muted small pt-2">so với hôm qua</span>
                                            @elseif($percentDoanhThu > 0 && $check === 2)
                                                <span class="text-muted small pt-2 ps-0">Tăng</span>
                                                <span
                                                    class="text-success small pt-1 fw-bold">{{ $percentDoanhThu }}%</span>
                                                <span class="text-muted small pt-2">so với tháng trước</span>
                                            @elseif($percentDoanhThu < 0 && $check === 2)
                                                <span class="text-muted small pt-2 ps-0">Giảm</span>
                                                <span class="text-danger small pt-1 fw-bold">{{ $percentDoanhThu }}%</span>
                                                <span class="text-muted small pt-2">so với tháng trước</span>
                                            @elseif($percentDoanhThu > 0 && $check === 3)
                                                <span class="text-muted small pt-2 ps-0">Tăng</span>
                                                <span
                                                    class="text-success small pt-1 fw-bold">{{ $percentDoanhThu }}%</span>
                                                <span class="text-muted small pt-2">so với năm trước</span>
                                            @elseif($percentDoanhThu < 0 && $check === 3)
                                                <span class="text-muted small pt-2 ps-0">Giảm</span>
                                                <span class="text-danger small pt-1 fw-bold">{{ $percentDoanhThu }}%</span>
                                                <span class="text-muted small pt-2">so với năm trước</span>
                                            @else
                                                {{-- <span class="small pt-1 fw-bold">%</span> --}}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">


                                <div class="card-body p-4">
                                    <h5 class="card-title">Khách hàng</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $customer }}</h6>
                                            @if ($percentCus > 0 && $check === 1)
                                                <span class="text-muted small pt-2 ps-0">Tăng</span>
                                                <span class="text-success small pt-1 fw-bold">{{ $percentCus }}%</span>
                                                <span class="text-muted small pt-2">so với hôm qua</span>
                                            @elseif($percentCus < 0 && $check === 1)
                                                <span class="text-muted small pt-2 ps-0">Giảm</span>
                                                <span class="text-danger small pt-1 fw-bold">{{ $percentCus }}%</span>
                                                <span class="text-muted small pt-2">so với hôm qua</span>
                                            @elseif($percentCus == 0 && $check === 1)
                                                <span class="text-muted small pt-2">Bằng với hôm qua</span>
                                            @elseif($percentCus > 0 && $check === 2)
                                                <span class="text-muted small pt-2 ps-0">Tăng</span>
                                                <span class="text-success small pt-1 fw-bold">{{ $percentCus }}%</span>
                                                <span class="text-muted small pt-2">so với tháng trước</span>
                                            @elseif($percentCus < 0 && $check === 2)
                                                <span class="text-muted small pt-2 ps-0">Giảm</span>
                                                <span class="text-danger small pt-1 fw-bold">{{ $percentCus }}%</span>
                                                <span class="text-muted small pt-2">so với tháng trước</span>
                                            @elseif($percentCus > 0 && $check === 3)
                                                <span class="text-muted small pt-2 ps-0">Tăng</span>
                                                <span class="text-success small pt-1 fw-bold">{{ $percentCus }}%</span>
                                                <span class="text-muted small pt-2">so với năm trước</span>
                                            @elseif($percentCus < 0 && $check === 3)
                                                <span class="text-muted small pt-2 ps-0">Giảm</span>
                                                <span class="text-danger small pt-1 fw-bold">{{ $percentCus }}%</span>
                                                <span class="text-muted small pt-2">so với năm trước</span>
                                            @else
                                                {{-- <span class="small pt-1 fw-bold"></span> --}}
                                            @endif

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- End Customers Card -->

                        <!-- Reports -->
                        <div class="col-12 ">
                            <div class="card">

                                <div class="card-body p-4">
                                    <h5 class="card-title">Tất cả</h5>
                                    <!-- Line Chart -->
                                    <div id="reportsChart"></div>
                                    {{-- <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            new ApexCharts(document.querySelector("#reportsChart"), {
                                                series: [{
                                                    name: 'Hello',
                                                    data: [11, 12, 33, 33, 22, 12, 34],
                                                }, {
                                                    name: 'Revenue',
                                                    data: [11, 32, 45, 32, 34, 52, 41]
                                                }, {
                                                    name: 'Customers',
                                                    data: [15, 11, 32, 18, 9, 24, 11]
                                                }],
                                                chart: {
                                                    height: 350,
                                                    type: 'area',
                                                    toolbar: {
                                                        show: false
                                                    },
                                                },
                                                markers: {
                                                    size: 4
                                                },
                                                colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                                fill: {
                                                    type: "gradient",
                                                    gradient: {
                                                        shadeIntensity: 1,
                                                        opacityFrom: 0.3,
                                                        opacityTo: 0.4,
                                                        stops: [0, 90, 100]
                                                    }
                                                },
                                                dataLabels: {
                                                    enabled: false
                                                },
                                                stroke: {
                                                    curve: 'smooth',
                                                    width: 2
                                                },
                                                xaxis: {
                                                    type: 'datetime',
                                                    categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z",
                                                        "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z",
                                                        "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",
                                                        "2018-09-19T06:30:00.000Z"
                                                    ]
                                                },
                                                tooltip: {
                                                    x: {
                                                        format: 'dd/MM/yy HH:mm'
                                                    },
                                                }
                                            }).render();
                                        });
                                    </script> --}}
                                    <script>
                                        @if ($check === 1)
                                            document.addEventListener("DOMContentLoaded", () => {
                                                const categories = [
                                                    @foreach ($test as $item)
                                                        "{{ $item->DataTime }}",
                                                    @endforeach
                                                ]; // Các giờ trong một ngày
                                                const doanhThuData = [
                                                    @foreach ($test as $item)
                                                        "{{ $item->Total }}",
                                                    @endforeach
                                                ]; // Dữ liệu doanh thu tương ứng với mỗi giờ
                                                const loiNhuanData = [
                                                    @foreach ($test as $item)
                                                        "{{ $item->Total - $item->TotalCost }}",
                                                    @endforeach
                                                ]; // Dữ liệu lợi nhuận tương ứng với mỗi giờ

                                                new ApexCharts(document.querySelector("#reportsChart"), {
                                                    series: [{
                                                            name: 'Doanh thu',
                                                            data: doanhThuData,
                                                        },
                                                        {
                                                            name: 'Lợi nhuận',
                                                            data: loiNhuanData,
                                                        }
                                                    ],
                                                    chart: {
                                                        height: 350,
                                                        type: 'area',
                                                        toolbar: {
                                                            show: false
                                                        },
                                                    },
                                                    markers: {
                                                        size: 4
                                                    },
                                                    colors: ['#4154f1', '#2eca6a'],
                                                    fill: {
                                                        type: "gradient",
                                                        gradient: {
                                                            shadeIntensity: 1,
                                                            opacityFrom: 0.3,
                                                            opacityTo: 0.4,
                                                            stops: [0, 90, 100]
                                                        }
                                                    },
                                                    dataLabels: {
                                                        enabled: false
                                                    },
                                                    stroke: {
                                                        curve: 'smooth',
                                                        width: 2
                                                    },
                                                    xaxis: {
                                                        type: 'category',
                                                        categories: categories,
                                                    },
                                                    tooltip: {
                                                        x: {
                                                            format: 'HH:mm'
                                                        },
                                                    },
                                                    yaxis: {
                                                        labels: {
                                                            formatter: function(value) {
                                                                return value.toLocaleString('vi-VN', {
                                                                    style: 'currency',
                                                                    currency: 'VND'
                                                                });
                                                            }
                                                        },
                                                    },
                                                }).render();
                                            });
                                        @else
                                            document.addEventListener("DOMContentLoaded", () => {
                                                new ApexCharts(document.querySelector("#reportsChart"), {
                                                    series: [{
                                                        name: 'Doanh thu',
                                                        data: [
                                                            @foreach ($test as $item)
                                                                {{ $item->Total }},
                                                            @endforeach
                                                        ],
                                                    }, {
                                                        name: 'Lợi nhuận',
                                                        data: [
                                                            @foreach ($test as $item)
                                                                {{ $item->Total - $item->TotalCost }},
                                                            @endforeach
                                                        ]
                                                    }],
                                                    chart: {
                                                        height: 350,
                                                        type: 'area',
                                                        toolbar: {
                                                            show: false
                                                        },
                                                    },
                                                    markers: {
                                                        size: 4
                                                    },
                                                    colors: ['#4154f1', '#2eca6a'],
                                                    fill: {
                                                        type: "gradient",
                                                        gradient: {
                                                            shadeIntensity: 1,
                                                            opacityFrom: 0.3,
                                                            opacityTo: 0.4,
                                                            stops: [0, 90, 100]
                                                        }
                                                    },
                                                    dataLabels: {
                                                        enabled: false
                                                    },
                                                    stroke: {
                                                        curve: 'smooth',
                                                        width: 2
                                                    },
                                                    xaxis: {
                                                        type: 'datetime',
                                                        categories: [
                                                            @foreach ($test as $item)
                                                                "{{ $item->DataTime }}",
                                                            @endforeach
                                                        ]
                                                    },
                                                    tooltip: {
                                                        x: {
                                                            format: 'dd/MM/yyyy'
                                                        },
                                                    },
                                                    yaxis: {
                                                        labels: {
                                                            formatter: function(value) {
                                                                return value.toLocaleString('vi-VN', {
                                                                    style: 'currency',
                                                                    currency: 'VND'
                                                                });
                                                            }
                                                        },
                                                    },
                                                }).render();
                                            });
                                        @endif
                                    </script>
                                    <!-- End Line Chart -->

                                </div>

                            </div>
                        </div>
                        <!-- End Reports -->

                        <!-- Recent Sales -->
                        <div class="col-8">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body p-4">
                                    <h5 class="card-title">Số lượng bán của mặt hàng</h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">ID</th>
                                                <th scope="col">Mặt hàng</th>
                                                <th scope="col" class="text-center">Danh mục</th>
                                                <th scope="col" class="text-center">Giá bán</th>
                                                <th scope="col" class="text-center">Số lượng bán</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $item)
                                                <tr>
                                                    <th class="text-center" scope="row"><a
                                                            href="#">#{{ $item->IdItems }}</a></th>
                                                    <td class=" d-flex align-items-center"
                                                        style="padding: 1rem; vertical-align:-webkit-baseline-middle !important;">
                                                        <div class="m-b-20 me-3" style="height: 3rem; width: 3rem;">
                                                            <img id="img-account"
                                                                src="{{ asset('files/images/items/' . $item->Avatar) }}"
                                                                alt="Profile" class="rounded-circle-items"
                                                                style="">
                                                        </div>
                                                        {{ $item->ItemsName }}
                                                    </td>
                                                    <td class="text-center">{{ $item->CategoryName }}</a> </td>
                                                    <td class="text-center">
                                                        {{ number_format($item->SalePrice, 0, '.', '.') }} đ</td>
                                                    <td class="text-center">{{ $item->TotalQuantity }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body p-3 pb-0">
                                    <h5 class="card-title">Top 5 mặt hàng bán chạy nhất</span></h5>

                                    <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            echarts.init(document.querySelector("#trafficChart")).setOption({
                                                tooltip: {
                                                    trigger: 'item'
                                                },
                                                legend: {
                                                    top: '2%',
                                                    left: 'center'
                                                },
                                                series: [{
                                                    name: 'Tổng cộng',
                                                    type: 'pie',
                                                    radius: ['40%', '70%'],
                                                    avoidLabelOverlap: false,
                                                    label: {
                                                        show: false,
                                                        position: 'center'
                                                    },
                                                    emphasis: {
                                                        label: {
                                                            show: true,
                                                            fontSize: '18',
                                                            fontWeight: 'bold'
                                                        }
                                                    },
                                                    labelLine: {
                                                        show: false
                                                    },
                                                    data: [
                                                        @foreach ($items->sortByDesc('TotalQuantity')->take(5) as $item)
                                                            {
                                                                value: {{ $item->TotalQuantity }},
                                                                name: "{{ $item->ItemsName }}"
                                                            },
                                                        @endforeach
                                                    ]
                                                }]
                                            });
                                        });
                                    </script>

                                </div>
                            </div>
                        </div>
                        <!-- End Recent Sales -->

                        <!-- Top Selling -->
                        {{-- <div class="col-12">
                            <div class="card top-selling overflow-auto">


                                <div class="card-body p-3 pb-0">
                                    <h5 class="card-title">Top Selling <span>| Today</span></h5>

                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">Preview</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Sold</th>
                                                <th scope="col">Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row"><a href="#"><img
                                                            src="files/images/product-1.jpg" alt=""></a></th>
                                                <td><a href="#" class="text-primary fw-bold">Ut inventore ipsa
                                                        voluptas nulla</a></td>
                                                <td>$64</td>
                                                <td class="fw-bold">124</td>
                                                <td>$5,828</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><a href="#"><img
                                                            src="files/images/product-2.jpg" alt=""></a></th>
                                                <td><a href="#" class="text-primary fw-bold">Exercitationem
                                                        similique doloremque</a></td>
                                                <td>$46</td>
                                                <td class="fw-bold">98</td>
                                                <td>$4,508</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><a href="#"><img
                                                            src="files/images/product-3.jpg" alt=""></a></th>
                                                <td><a href="#" class="text-primary fw-bold">Doloribus nisi
                                                        exercitationem</a></td>
                                                <td>$59</td>
                                                <td class="fw-bold">74</td>
                                                <td>$4,366</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><a href="#"><img
                                                            src="files/images/product-4.jpg" alt=""></a></th>
                                                <td><a href="#" class="text-primary fw-bold">Officiis quaerat sint
                                                        rerum error</a></td>
                                                <td>$32</td>
                                                <td class="fw-bold">63</td>
                                                <td>$2,016</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><a href="#"><img
                                                            src="files/images/product-5.jpg" alt=""></a></th>
                                                <td><a href="#" class="text-primary fw-bold">Sit unde debitis
                                                        delectus repellendus</a></td>
                                                <td>$79</td>
                                                <td class="fw-bold">41</td>
                                                <td>$3,239</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div> --}}
                        <!-- End Top Selling -->

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                {{-- <div class="col-lg-4">

                    <!-- Budget Report -->
                    <div class="card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                    class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>

                        <div class="card-body p-3 pb-0">
                            <h5 class="card-title">Budget Report <span>| This Month</span></h5>

                            <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                                        legend: {
                                            data: ['Allocated Budget', 'Actual Spending']
                                        },
                                        radar: {
                                            // shape: 'circle',
                                            indicator: [{
                                                    name: 'Sales',
                                                    max: 6500
                                                },
                                                {
                                                    name: 'Administration',
                                                    max: 16000
                                                },
                                                {
                                                    name: 'Information Technology',
                                                    max: 30000
                                                },
                                                {
                                                    name: 'Customer Support',
                                                    max: 38000
                                                },
                                                {
                                                    name: 'Development',
                                                    max: 52000
                                                },
                                                {
                                                    name: 'Marketing',
                                                    max: 25000
                                                }
                                            ]
                                        },
                                        series: [{
                                            name: 'Budget vs spending',
                                            type: 'radar',
                                            data: [{
                                                    value: [4200, 3000, 20000, 35000, 50000, 18000],
                                                    name: 'Allocated Budget'
                                                },
                                                {
                                                    value: [5000, 14000, 28000, 26000, 42000, 21000],
                                                    name: 'Actual Spending'
                                                }
                                            ]
                                        }]
                                    });
                                });
                            </script>

                        </div>
                    </div><!-- End Budget Report -->

                    <!-- Website Traffic -->
                    <div class="card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                    class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>

                        <div class="card-body p-3 pb-0">
                            <h5 class="card-title">Website Traffic <span>| Today</span></h5>

                            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    echarts.init(document.querySelector("#trafficChart")).setOption({
                                        tooltip: {
                                            trigger: 'item'
                                        },
                                        legend: {
                                            top: '5%',
                                            left: 'center'
                                        },
                                        series: [{
                                            name: 'Access From',
                                            type: 'pie',
                                            radius: ['40%', '70%'],
                                            avoidLabelOverlap: false,
                                            label: {
                                                show: false,
                                                position: 'center'
                                            },
                                            emphasis: {
                                                label: {
                                                    show: true,
                                                    fontSize: '18',
                                                    fontWeight: 'bold'
                                                }
                                            },
                                            labelLine: {
                                                show: false
                                            },
                                            data: [{
                                                    value: 1048,
                                                    name: 'Search Engine'
                                                },
                                                {
                                                    value: 735,
                                                    name: 'Direct'
                                                },
                                                {
                                                    value: 580,
                                                    name: 'Email'
                                                },
                                                {
                                                    value: 484,
                                                    name: 'Union Ads'
                                                },
                                                {
                                                    value: 300,
                                                    name: 'Video Ads'
                                                }
                                            ]
                                        }]
                                    });
                                });
                            </script>

                        </div>
                    </div><!-- End Website Traffic -->

                </div> --}}
                <!-- End Right side columns -->
            </div>
        </section>

    </main>
@endsection
