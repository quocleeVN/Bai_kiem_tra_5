<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<x-movie-layout>
    <style>
        .dataTables_wrapper {
            font-size: 14px;
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
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
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

        .pagination {
            margin-top: 20px;
        }

        .admin-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
    </style>

    <h1 class="admin-title">DANH SÁCH PHIM</h1>

    <table id="movieTable" class="table table-striped">
        <thead>
            <tr>
                <th>Ảnh đại diện</th>
                <th>Tiêu đề</th>
                <th>Giới thiệu</th>
                <th>Ngày phát hành</th>
                <th>Điểm đánh giá</th>
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
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#movieTable').DataTable({
                responsive: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
                bStateSave: true,
                language: {
                    "sProcessing": "Đang xử lý...",
                    "sLengthMenu": "Hiển thị _MENU_ bộ phim trên trang",
                    "sZeroRecords": "Không tìm thấy bộ phim nào",
                    "sInfo": "Hiển thị _START_ đến _END_ trong tổng số _TOTAL_ bộ phim",
                    "sInfoEmpty": "Hiển thị 0 đến 0 trong tổng số 0 bộ phim",
                    "sInfoFiltered": "(được lọc từ _MAX_ bộ phim)",
                    "sSearch": "Tìm kiếm:",
                    "oPaginate": {
                        "sFirst": "Đầu",
                        "sPrevious": "Trước",
                        "sNext": "Tiếp",
                        "sLast": "Cuối"
                    }
                }
            });
        });
    </script>
</x-movie-layout>