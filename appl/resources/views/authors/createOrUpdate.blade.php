@extends('home')

@section('content')
<h1>
    {{ isset($author) ? 'Sửa tác giả' : 'Thêm tác giả' }}
</h1>

<form
    action="{{ isset($author)
        ? route('authors.update', $author->id)
        : route('authors.store') }}"
    method="POST"
>
    @csrf

    @if(isset($author))
        @method('PUT')
    @endif

    <div>
        <label>Tên tác giả</label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $author->name ?? '') }}"
        >
    </div>

    <div>
        <label>Mô tả</label>

        <textarea
            name="bio"
            rows="4"
        >{{ old('bio', $author->bio ?? '') }}</textarea>
    </div>

    <button type="submit">
        {{ isset($author) ? 'Cập nhật' : 'Thêm mới' }}
    </button>
</form>
@endsection