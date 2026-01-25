<div class="user-management-system">
    <div class="container-fluid py-4">
        <x-slot name="breadcrumbSlot">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb breadcrumb-dots">
                    @foreach($breadcrumbs as $item)
                        <li class="breadcrumb-item {{ $loop->last ? 'active fw-bold text-dark' : '' }}">
                            @if($item['url'] && !$loop->last)
                                <a href="{{ $item['url'] }}" class="text-primary text-decoration-none">{{ $item['label'] }}</a>
                            @else
                                {{ $item['label'] }}
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        </x-slot>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold text-dark">User List Directory</h5>
                <p class="text-muted small mb-0">Managing database records with full metadata visibility.</p>
            </div>

            <div class="card-body p-0 pt-3">
                <div class="container-fluid px-4" wire:ignore>
                    <div class="table-responsive custom-scrollbar pb-3">
                        <table id="userProfileTable" class="table table-hover align-middle mb-0 w-100">
                            <thead class="bg-light-subtle">
                                <tr class="text-uppercase small fw-bold text-secondary opacity-75">
                                    <th class="ps-4"># ID</th>
                                    <th>Identity</th>
                                    <th class="d-none d-md-table-cell">Security</th>
                                    <th class="d-none d-lg-table-cell">Contact</th>
                                    <th class="d-none d-xl-table-cell">Demographics</th>
                                    <th>Full Professional Bio</th>
                                    <th class="d-none d-md-table-cell">Registered</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td class="ps-4 fw-medium text-primary">#{{ $user->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $user->profile && $user->profile->avatar ? asset('storage/'.$user->profile->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=E9ECEF&color=495057' }}" 
                                                 class="rounded-circle border border-2 border-white shadow-sm" width="42" height="42">
                                            <div class="ms-3">
                                                <div class="fw-bold text-dark mb-0">{{ $user->name }}</div>
                                                <div class="small text-muted">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="d-none d-md-table-cell text-center">
                                        <span class="badge bg-light text-dark border fw-normal py-1 px-2">
                                            UID-{{ $user->id }}
                                        </span>
                                    </td>
                                    <td class="d-none d-lg-table-cell">
                                        <div class="small">
                                            <div class="mb-1"><i class="bi bi-phone text-muted p-3"></i>{{ $user->profile->phone ?? '—' }}</div>
                                            <div><i class="bi bi-geo-alt text-muted me-2"></i>{{ $user->profile->city ?? '—' }}</div>
                                        </div>
                                    </td>
                                    <td class="d-none d-xl-table-cell">
                                        <div class="small">
                                            <div class="mb-1 text-capitalize">{{ $user->profile->gender ?? '—' }}</div>
                                            <div class="text-muted">{{ $user->profile->language ?? '—' }}</div>
                                        </div>
                                    </td>
                                    <td style="min-width: 250px;">
                                        <div class="bio-scroll-box small text-muted border-start ps-3">
                                            {{ $user->profile->bio ?? 'No professional biography provided.' }}
                                        </div>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <div class="small text-muted">
                                            <div>{{ $user->created_at->format('M d, Y') }}</div>
                                            <div class="opacity-50 text-xs">{{ $user->updated_at->diffForHumans() }}</div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group shadow-sm bg-white rounded-3 border">
                                            <button class="btn btn-sm btn-white py-2 px-3 text-danger" 
                                                    wire:click="deleteUser({{ $user->id }})" 
                                                    wire:confirm="This action cannot be undone. Delete user #{{ $user->id }}?">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
       div.dt-container div.dt-length select {
            width: 60px;
            display: inline-block;
            margin-right: .5em
        }
</style>

 <script>
    document.addEventListener('livewire:navigated', function () {
        let userTable;
        
        const initUserTable = () => {
            if ($.fn.DataTable.isDataTable('#userProfileTable')) {
                $('#userProfileTable').DataTable().destroy();
            }

            userTable = new DataTable('#userProfileTable', {
                pageLength: 5, 
                lengthMenu: [2, 5, 10, 25, 50],
                order: [[0, 'desc']],
                layout: {
                    topStart: 'search',
                    topEnd: 'pageLength',
                    bottomStart: 'info',
                    bottomEnd: 'paging'   
                },
                language: {
                    search: "",
                    searchPlaceholder: "Search users...",
                    entries: {
                        _: 'users',
                        1: 'user'
                    }
                }
            });
        };

        initUserTable();
        window.addEventListener('contentChanged', () => initUserTable());
    });
</script>
</div>