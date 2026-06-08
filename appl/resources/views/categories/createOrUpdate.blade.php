@extends('home')

@section('content')
<h1>
    {{ isset($category) ? 'Sửa thể loại' : 'Thêm thể loại' }}
</h1>

<form
    action="{{ isset($category)
        ? route('categories.update', $category->id)
        : route('categories.store') }}"
    method="POST"
>
    @csrf

    @if(isset($category))
        @method('PUT')
    @endif

    <div>
        <label>Tên thể loại</label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $category->name ?? '') }}"
        >
    </div>

    <div>
        <label>Mô tả</label>

        <textarea
            name="description"
            rows="4"
        >{{ old('description', $category->description ?? '') }}</textarea>
    </div>

    <button type="submit">
        {{ isset($category) ? 'Cập nhật' : 'Thêm mới' }}
    </button>
</form>
@endsection