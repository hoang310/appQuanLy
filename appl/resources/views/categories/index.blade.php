@extends('home')

@section('content')

<h1>Danh sách thể loại</h1>

<a href="{{ route('categories.create') }}">
    Thêm thể loại
</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Tên thể loại</th>
        <th>Mô tả</th>
        <th>Thao tác</th>
    </tr>

    @foreach($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        <td>{{ $category->description }}</td>

        <td>
            <a href="{{ route('categories.edit', $category->id) }}">
                Sửa
            </a>

            <form
                action="{{ route('categories.destroy', $category->id) }}"
                method="POST"
            >
                @csrf
                @method('DELETE')

                <button type="submit">
                    Xóa
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection