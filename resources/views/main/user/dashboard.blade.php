<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Dashboard</h2>
            </div>
        </div>
    </div>
</div>


<div class="content">
    <div class="container-fluid">
        <div class="row">

            @include('main.user.menu')

            <div class="col-md-7 col-lg-8 col-xl-9">
                <div class="card">
                    <div class="card-body pt-0">

                        <nav class="user-tabs mb-4">
                            <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#pat_appointments"
                                        data-bs-toggle="tab">Data Sewa</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="#pat_prescriptions" data-bs-toggle="tab">Prescriptions</a>
                                </li> --}}
                            </ul>
                        </nav>


                        <div class="tab-content pt-0">
                            <div id="pat_appointments" class="tab-pane fade show active">
                                <div class="card card-table mb-0">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Gedung</th>
                                                        <th>No Nota</th>
                                                        <th>Tanggal</th>
                                                        <th>Biaya</th>               
                                                        <th>Status</th>
                                                        <th>#</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($receipts as $receipt)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="{{ URL::to('/building') . "/" . $receipt->receiptDetails[0]->schedule->court->building->id }}"
                                                                    class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                        src="{{ URL::to('/storage') . '/' .  $receipt->receiptDetails[0]->schedule->court->building->image_url; }}"
                                                                        alt="Building">
                                                                </a>
                                                                <a href="{{ URL::to('/building') . "/" . $receipt->receiptDetails[0]->schedule->court->building->id }}">{{ $receipt->receiptDetails[0]->schedule->court->building->name }}
                                                                    <span>{{ $receipt->receiptDetails[0]->schedule->court->building->type->name }}</span></a>
                                                            </h2>
                                                        </td>
                                                        <td> <span class="d-block text-info">{{ $receipt->number }}</span>
                                                        </td>
                                                        <td>{{ DateFormat($receipt->created_at, "D MMMM Y") }}</td>
                                                        <td><?php 
                                                            $total = 0;
                                                            foreach ($receipt->receiptDetails as $receiptDetail) {
                                                                $total = $total + $receiptDetail->price;
                                                            }

                                                            echo "Rp. " . NumberFormat($total);
                                                        ?></td>
                                                        <td>
                                                            @include('main.booking.status')
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a target="_blank" href="{{ URL::to('/receipt') . "/" . $receipt->id}}"
                                                                    class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> Lihat
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @if(count($receipts) > 0)
                                                        @if($page*$limit > count($receipts))
                                                            <tr>
                                                                <td colspan="7" class="text-center">Data sudah termuat semua...</td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td colspan="7" class="text-center"><a href="{{ URL::to('/dashboard?page=' . ($page+1)) }}"><u>Muat lebih banyak...</u></a></td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>