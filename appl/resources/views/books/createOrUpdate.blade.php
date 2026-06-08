
@extends('home')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <div class="flex items-center space-x-3">
        <a href="{{ route('books.index') }}" class="p-2 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-xl transition" title="Quay lại">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">
                {{ isset($book) ? "Sửa thông tin sách" : "Thêm sách mới" }}
            </h1>
            <p class="text-sm text-slate-500 mt-0.5">Điền đầy đủ các thông tin chi tiết của cuốn sách vào hệ thống.</p>
        </div>
    </div>

    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden">
        
        <form 
            action="{{ isset($book) ? route('books.update', $book->id) : route('books.store') }}" 
            method="POST" 
            enctype="multipart/form-data"
            class="p-6 sm:p-8 space-y-6"
        >
            @csrf
            @if(isset($book))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tên sách <span class="text-rose-500">*</span></label>
                    <input 
                        type="text" 
                        name="title" 
                        value="{{ old('title', $book->title ?? '') }}" 
                        placeholder="Nhập tiêu đề sách đầy đủ..."
                        class="w-full px-4 py-2.5 text-sm text-slate-800 bg-white border border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all @error('title') border-rose-500 ring-2 ring-rose-500/10 @enderror"
                    >
                    @error('title') <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Mã số quốc tế (ISBN)</label>
                    <input 
                        type="text" 
                        name="isbn" 
                        value="{{ old('isbn', $book->isbn ?? '') }}" 
                        placeholder="Ví dụ: 978-3-16-148410-0"
                        class="w-full px-4 py-2.5 text-sm font-mono text-slate-800 bg-white border border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all"
                    >
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nhà xuất bản</label>
                    <input 
                        type="text" 
                        name="publisher" 
                        value="{{ old('publisher', $book->publisher ?? '') }}" 
                        placeholder="Nhập tên nhà xuất bản..."
                        class="w-full px-4 py-2.5 text-sm text-slate-800 bg-white border border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all"
                    >
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tác giả <span class="text-rose-500">*</span></label>
                    <select name="author_id" class="w-full px-4 py-2.5 text-sm text-slate-800 bg-white border border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ old('author_id', $book->author_id ?? '') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Thể loại <span class="text-rose-500">*</span></label>
                    <select name="category_id" class="w-full px-4 py-2.5 text-sm text-slate-800 bg-white border border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $book->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Năm xuất bản</label>
                    <input 
                        type="number" 
                        name="publish_year" 
                        value="{{ old('publish_year', $book->publish_year ?? '') }}" 
                        placeholder="Ví dụ: 2026"
                        class="w-full px-4 py-2.5 text-sm text-slate-800 bg-white border border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all"
                    >
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Tổng số kho</label>
                        <input 
                            type="number" 
                            name="quantity" 
                            value="{{ old('quantity', $book->quantity ?? '') }}" 
                            class="w-full px-4 py-2.5 text-sm text-slate-800 bg-white border border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Khả dụng (Còn lại)</label>
                        <input 
                            type="number" 
                            name="available_quantity" 
                            value="{{ old('available_quantity', $book->available_quantity ?? '') }}" 
                            class="w-full px-4 py-2.5 text-sm text-slate-800 bg-white border border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all"
                        >
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Hình ảnh bìa sách</label>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 p-4 border border-dashed border-slate-200 rounded-xl bg-slate-50/50">
                        <div class="w-20 h-28 bg-white border border-slate-200 rounded-lg overflow-hidden flex-shrink-0 shadow-sm flex items-center justify-center text-slate-400">
                            @if(isset($book) && $book->image)
                                <img src="{{ asset($book->image) }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-8 h-8 opacity-40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V6.75zm.375 0a.375 0 11-.75 0 .375 0 01.75 0z"></path>
                                </svg>
                            @endif
                        </div>
                        <div class="space-y-1">
                            <input 
                                type="file" 
                                name="image"
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all cursor-pointer"
                            >
                            <p class="text-xs text-slate-400">Hỗ trợ các định dạng định dạng: JPG, PNG, WEBP (Tỉ lệ 3:4 khuyến nghị).</p>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tóm tắt nội dung / Mô tả</label>
                    <textarea 
                        name="description" 
                        rows="4" 
                        placeholder="Nhập tóm tắt sơ lược hoặc ghi chú nội dung cho cuốn sách..."
                        class="w-full px-4 py-2.5 text-sm text-slate-800 bg-white border border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all"
                    >{{ old('description', $book->description ?? '') }}</textarea>
                </div>

            </div>

            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-slate-100">
                <a 
                    href="{{ route('books.index') }}" 
                    class="px-4 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition"
                >
                    Hủy bỏ
                </a>
                <button 
                    type="submit" 
                    class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-md shadow-indigo-100 transition-all"
                >
                    {{ isset($book) ? 'Cập nhật thông tin' : 'Lưu & Thêm sách' }}
                </button>
            </div>

        </form>
    </div>
</div>
@endsection