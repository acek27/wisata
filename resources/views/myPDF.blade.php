<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>
        Pengunjung Wisata Jember {{(int)date('Y')}}
    </title>
</head>
<body>
<style type="text/css">
    table tr td,
    table tr th{
        font-size: 8pt;
    }
    table tr th{
        text-align: center;
    }
    td{
        text-transform: capitalize;
    }
</style>
@can('admin')
<h5 style="text-align: center; margin-top: 5px; margin-bottom: 5px">
    Pengunjung Wisata Kabupaten Jember Tahun {{(int)date('Y')}}
</h5>
@endcan
@can('adminwisata')
    <h5 style="text-align: center; margin-top: 5px; margin-bottom: 5px">
        Pengunjung Wisata {{ Auth::user()->name }} Kabupaten Jember Tahun {{(int)date('Y')}}
    </h5>
@endcan
<br>
<table class='table table-bordered'>
    <thead>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Nama Wisata</th>
        <th>Jumlah Wisatawan</th>
        <th>Asal Wisatawan</th>
        <th>Keterangan</th>
    </tr>
    </thead>
    <tbody>
    @php $i=1 @endphp
    @foreach($data as $p)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{$p->tanggal_dataPengunjung}}</td>
            <td>{{$p->nama_wisata}}</td>
            <td>{{$p->jumlah_dataPengunjung}}</td>
            <td>{{$p->asal}}</td>
            <td>{{$p->status_pengunjung}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<footer class="footer">
    <div class="container">
        <div class="text-center" id="copyright">
            &copy; {{(int)date('Y')}}, Kabupaten Jember.
            <br>Designed by
            <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
        </div>
    </div>
</footer>
</body>
</html>
