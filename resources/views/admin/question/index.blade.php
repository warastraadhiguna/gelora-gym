@include('sweetalert::alert')

<a href="{{ URL::to('/admin/web/question/create'); }}" class="btn btn-primary mb-3"><i class="fas fa-plus"
        aria-hidden="true"></i> Tambah</a>


<table id="example1" class="table table-bordered table-striped" width="100%">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Pertanyaan</th>
            <th>Jawaban</th>
            <th>Urutan</th>
            <th>Status</th>
            <th width="18%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($questions as $question)
        <tr>
            <td class="align-middle">{{ $loop->iteration }}</td>
            <td>{{ $question->question  }}</td>
            <td>{{ $question->answer  }}</td>
            <td>{{ $question->index  }}</td>
            <td>{{ $question->is_published === "1" ? "Publikasi" : "Non Publikasi"  }}</td>
            <td class="align-middle">
                <div class="d-flex">
                    <a href="{{ URL::to('/admin/web/question/' . $question->id . "/edit") }}"
                        class="btn btn-success mx-2  btn-sm"> <i class="fas fa-edit"></i> Edit</a>

                    <form action="{{ URL::to('/admin/web/question/' . $question->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button onclick="return confirm('Anda yakin menghapus data ini?')" type="submit"
                            class="btn btn-danger  btn-sm"><i class="fas fa-times"></i> Hapus</button>
                    </form>
                </div>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>