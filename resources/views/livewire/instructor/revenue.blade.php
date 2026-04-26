<div> 

    <x-slot name="breadcrumbSlot">
        <nav class="py-2 bg-light border-bottom mb-4">
            <div class="container">
                <ol class="breadcrumb mb-0 small">
                    @foreach($breadcrumbs as $item)
                        <li class="breadcrumb-item {{ $loop->last ? 'active fw-bold' : '' }}">
                            @if($item['url'] && !$loop->last)
                                <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                            @else
                                {{ $item['label'] }}
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
        </nav>
    </x-slot>

    <div class="container">

        <div class="row mb-1">
            <div class="col-6 col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h6>Total Revenue</h6>
                        <h4 class="fw-bold text-success">₹{{ number_format($totalRevenue,2) }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h6>Total Orders</h6>
                        <h4 class="fw-bold">{{ $totalOrders }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h6>Total Students</h6>
                        <h4 class="fw-bold">{{ $totalStudents }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="card shadow-sm">
            <div class="card-header fw-bold">
                Orders & Payments
            </div>

            <div wire:ignore.self>
                <div class="table-responsive">
                    <table id="ordersTable" class="table table-hover align-middle w-100">
                        <thead class="table-light">
                            <tr>
                                <th>#ID</th>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Method</th>
                                <th>Transaction</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $order->user->name ?? 'N/A' }}<br>
                                        <small class="text-muted">{{ $order->user->email ?? '' }}</small>
                                    </td>

                                    <td>
                                        {{ $order->course->title ?? 'N/A' }}
                                    </td>

                                    <td class="fw-bold text-success">
                                        ₹{{ number_format($order->payment->amount ?? 0,2) }}
                                    </td>

                                    <td>
                                        @if(optional($order->payment)->status === 'success')
                                            <span class="badge bg-success">Paid</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>

                                    <td>{{ $order->payment->payment_method ?? '-' }}</td>

                                    <td>{{ $order->payment->transaction_id ?? '-' }}</td>

                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">
                                        No orders found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

{{-- 
<script>
document.addEventListener("DOMContentLoaded", () => {

    let dataTableInstance = null;

    function initDataTable() {

        const tableEl = document.getElementById('ordersTable');
        if (!tableEl) return;

        if ($.fn.DataTable.isDataTable(tableEl)) {
            $(tableEl).DataTable().destroy();
        }

        dataTableInstance = $(tableEl).DataTable({

            dom:
                "<'row align-items-center mb-3'<'col-md-6'l><'col-md-6 text-md-end text-start'f>>" +
                "<'row'<'col-12'tr>>" +
                "<'row align-items-center mt-3'<'col-md-5'i><'col-md-7 text-md-end text-start'p>>",

            pageLength: 2,
            lengthMenu: [5, 10, 25, 50],
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            processing: true,

            responsive: {
                details: {
                    type: 'column',
                    target: -1
                }
            },
            scrollX: true,

            columnDefs: [
                { responsivePriority: 1, targets: 1 }, // Student
                { responsivePriority: 2, targets: 3 }, // Amount
                { responsivePriority: 3, targets: 4 }, // Status
                { responsivePriority: 4, targets: 7 }, // Date (fixed index)

                { orderable: false, targets: [1] },

                // Width control (prevents compression)
                { width: "5%", targets: 0 },
                { width: "20%", targets: 1 },
                { width: "25%", targets: 2 },
                { width: "10%", targets: 3 },
                { width: "10%", targets: 4 },
                { width: "10%", targets: 5 },
                { width: "10%", targets: 6 },
                { width: "10%", targets: 7 }
            ],

            order: [[7, 'desc']],

            language: {
                search: "",
                searchPlaceholder: "Search orders...",
                lengthMenu: "_MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ orders",
                paginate: {
                    previous: "‹",
                    next: "›"
                }
            }
        });
    }

    setTimeout(initDataTable, 200);

    document.addEventListener("livewire:navigated", () => {
        setTimeout(initDataTable, 200);
    });

});
</script> --}}

</div>