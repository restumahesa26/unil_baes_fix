@extends('layouts.admin')

@section('title')
    <title>User & Admin</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>User & Admin</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User & Admin</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <!-- Table with outer spacing -->
                <div class="table-responsive">
                    <table class="table table-lg" id="table1">
                        <thead>
                            <tr class="">
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Pekerjaan</th>
                                <th>Roles</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <td class="text-bold-500">{{ $item->name }}</td>
                                    <td class="text-bold-500">{{ $item->email }}</td>
                                    <td class="text-bold-500">{{ $item->pekerjaan }}</td>
                                    <td class="text-bold-500">{{ $item->roles }}</td>
                                    <td class="text-bold-500">
                                        <a href="https://api.whatsapp.com/send?phone=62{{ $item->no_hp }}&text=Permisi..%20kami%20dari%20admin%20Desa%20Rindu%20Hati%20ingin%20" class="btn btn-info" target="_blank">
                                            Hubungi
                                        </a>
                                        @if ($item->roles === 'ADMIN')
                                            <a href="{{ route('profile.set-user', $item->id) }}" class="btn btn-primary">
                                                Set User
                                            </a>
                                        @else
                                            <a href="{{ route('profile.set-admin', $item->id) }}" class="btn btn-primary">
                                                Set Admin
                                            </a>
                                        @endif
                                        <form action="{{ route('profile.delete-user-admin', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-delete">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">Data Kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Email Subscribe</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Email Subscribe</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <!-- Table with outer spacing -->
                <div class="table-responsive">
                    <table class="table table-lg" id="table2">
                        <thead>
                            <tr class="">
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($emails as $email)
                                <tr>
                                    <td class="text-bold-500">{{ $email->email }}</td>
                                    <td class="text-bold-500">
                                        <form action="{{ route('delete-subscribe-email', $email->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-delete">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="8">Data Kosong</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script>
        $(document).ready( function () {
            $('#table1').DataTable({
                ordering: false
            });
        });

        $(document).ready( function () {
            $('#table2').DataTable({
                ordering: false
            });
        });
    </script>
@endpush

@push('addon-style')

@endpush
