@extends('home')

@section('content')

<h1>Danh sách tác giả</h1>

<a href="{{ route('authors.create') }}">
    Thêm tác giả
</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Tên tác giả</th>
        <th>Thông tin</th>
        <th>Thao tác</th>
    </tr>

    @foreach($authors as $author)
    <tr>
        <td>{{ $author->id }}</td>
        <td>{{ $author->name }}</td>
        <td>{{ $author->bio }}</td>

        <td>
            <a href="{{ route('authors.edit', $author->id) }}">
                Sửa
            </a>

            <form
                action="{{ route('authors.destroy', $author->id) }}"
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