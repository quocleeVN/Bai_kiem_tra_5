<link rel="stylesheet" href="{{asset('library/bootstrap.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="{{asset('library/jquery-3.7.1.js')}}"></script>
<script src="{{asset('library/popper.min.js')}}"></script>
<script src="{{asset('library/bootstrap.bundle.min.js')}}"></script>

<x-movie-layout>
    <style>
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 24px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #0066cc;
            box-shadow: 0 0 0 2px rgba(0, 102, 204, 0.2);
        }

        .form-control-file {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }

        .textarea-control {
            min-height: 120px;
            resize: vertical;
        }

        .btn-submit {
            background-color: #28a745;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            margin: 0 auto;
        }

        .btn-submit:hover {
            background-color: #218838;
        }

        .btn-back {
            background-color: #6c757d;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: #5a6268;
            color: white;
            text-decoration: none;
        }

        .button-group {
            text-align: center;
            margin-top: 30px;
        }

        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }

        .image-preview {
            margin-top: 10px;
            max-width: 200px;
            max-height: 200px;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: none;
        }
    </style>

    <div class="form-container">
        <h1 class="form-title">Thêm Phim Mới</h1>

        @if(session('success'))
        <div class="alert alert-success" style="margin-bottom: 20px;">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{url('/them-phim')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="movie_name">Tên tiếng Anh *</label>
                <input type="text" class="form-control" id="movie_name" name="movie_name" required
                    value="{{ old('movie_name') }}" placeholder="Nhập tên phim bằng tiếng Anh">
                @error('movie_name')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="movie_name_vn">Tên tiếng Việt *</label>
                <input type="text" class="form-control" id="movie_name_vn" name="movie_name_vn" required
                    value="{{ old('movie_name_vn') }}" placeholder="Nhập tên phim bằng tiếng Việt">
                @error('movie_name_vn')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="release_date">Ngày phát hành *</label>
                <input type="date" class="form-control" id="release_date" name="release_date" required
                    value="{{ old('release_date') }}">
                @error('release_date')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="overview_vn">Mô tả *</label>
                <textarea class="form-control textarea-control" id="overview_vn" name="overview_vn" required
                    placeholder="Nhập mô tả chi tiết về phim">{{ old('overview_vn') }}</textarea>
                @error('overview_vn')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Ảnh đại diện *</label>
                <input type="file" class="form-control-file" id="image" name="image" required
                    accept="image/*" onchange="previewImage(this)">
                <img id="imagePreview" class="image-preview" alt="Preview">
                @error('image')
                <div class="error-message">{{ $message }}</div>
                @enderror
                <small style="color: #666; margin-top: 5px; display: block;">Chọn file ảnh (JPEG, PNG, JPG, GIF) - tối đa 2MB</small>
            </div>

            <div class="button-group">
                <a href="{{url('/danh-sach-phim')}}" class="btn-back">Quay lại</a>
                <button type="submit" class="btn-submit">Thêm phim</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            var preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.style.display = 'none';
            }
        }
    </script>
</x-movie-layout>