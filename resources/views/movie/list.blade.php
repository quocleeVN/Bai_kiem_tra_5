<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<x-movie-layout>
    <style>
        .dataTables_wrapper {
            font-size: 14px;
            margin: 20px 0;
        }

        .dataTables_top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ddd;
        }

        .dataTables_length {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dataTables_length select {
            padding: 6px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 13px;
            cursor: pointer;
        }

        .dataTables_filter {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dataTables_filter input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 250px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background-color: #f8f9fa;
        }

        table th {
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
            font-weight: bold;
            background-color: #f5f5f5;
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }

        table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .dataTables_bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
        }

        .dataTables_info {
            color: #666;
            font-size: 13px;
        }

        .dataTables_paginate {
            display: flex;
            gap: 5px;
        }

        .paginate_button {
            padding: 6px 10px;
            margin: 0 2px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            background-color: white;
            color: #666;
            text-decoration: none;
            font-size: 12px;
        }

        .paginate_button:hover {
            background-color: #f0f0f0;
            border-color: #999;
        }

        .paginate_button.current {
            background-color: #0066cc;
            color: white;
            border-color: #0066cc;
            font-weight: bold;
        }

        .paginate_button.disabled {
            color: #ccc;
            cursor: not-allowed;
            opacity: 0.5;
        }

        .paginate_button.disabled:hover {
            background-color: white;
            border-color: #ddd;
        }

        .movie-img {
            width: 50px;
            height: auto;
            border-radius: 3px;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 3px;
            color: white;
            font-size: 12px;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .admin-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .btn-action {
            display: inline-block;
            padding: 6px 12px;
            margin: 0 3px;
            border-radius: 3px;
            text-decoration: none;
            font-size: 12px;
            cursor: pointer;
            border: 1px solid transparent;
        }

        .btn-view {
            background-color: #0066cc;
            color: white;
        }

        .btn-view:hover {
            background-color: #0052a3;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .btn-add {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-add:hover {
            background-color: #218838;
        }
    </style>

    <h1 class="admin-title">DANH SÁCH PHIM</h1>

    <div style="margin-bottom: 20px; text-align: right;">
        <a href="{{url('/them-phim')}}" class="btn-action btn-add">Thêm</a>
    </div>

    <table id="movieTable" class="table table-striped">
        <thead>
            <tr>
                <th>Ảnh đại diện</th>
                <th>Tiêu đề</th>
                <th>Giới thiệu</th>
                <th>Ngày phát hành</th>
                <th>Điểm đánh giá</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movies as $movie)
            <tr>
                <td>
                    @if($movie->image)
                    <img src="{{asset('storage/'.$movie->image)}}" alt="{{$movie->movie_name_vn}}" class="movie-img">
                    @else
                    <span>N/A</span>
                    @endif
                </td>
                <td>{{$movie->movie_name_vn}}</td>
                <td>{{Str::limit($movie->overview_vn, 100)}}</td>
                <td>{{$movie->release_date}}</td>
                <td>
                    @if($movie->vote_average >= 7)
                    <span class="badge badge-success">{{$movie->vote_average}}</span>
                    @else
                    <span class="badge badge-danger">{{$movie->vote_average}}</span>
                    @endif
                </td>
                <td class="actions-column">
                    <a href="{{url('/detail/'.$movie->id)}}" class="btn-action btn-view">Xem</a>
                    <a href="{{url('/delete/'.$movie->id)}}" class="btn-action btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa phim này?');">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#movieTable').DataTable({
                responsive: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
                bStateSave: true,

            });
        });
    </script>
</x-movie-layout>