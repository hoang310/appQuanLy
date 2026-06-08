
@extends('home')

@section('content')
<div class="space-y-6" x-data="{ detailModalOpen: false, currentBook: {} }">
    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Danh sách sách</h1>
            <p class="text-sm text-slate-500 mt-1">Quản lý kho sách, thông tin tác giả và số lượng tồn kho.</p>
        </div>
        <a href="{{ route('books.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-md shadow-indigo-100 transition-all">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
            </svg>
            Thêm sách mới
        </a>
    </div>

    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50/70 text-slate-500 text-xs font-semibold uppercase tracking-wider">
                        <th class="px-6 py-4 text-center w-16">ID</th>
                        <th class="px-6 py-4">Hình ảnh</th>
                        <th class="px-6 py-4">Thông tin sách</th>
                        <th class="px-6 py-4">Tác giả / Thể loại</th>
                        <th class="px-6 py-4">Nhà xuất bản (Năm)</th>
                        <th class="px-6 py-4">Mã số (ISBN)</th>
                        <th class="px-6 py-4 text-center">Số lượng</th>
                        <th class="px-6 py-4 text-center">Còn lại</th>
                        <th class="px-6 py-4 text-center w-24">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                    @foreach($books as $book)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 text-center font-mono text-xs text-slate-400">#{{ $book->id }}</td>
                        <td class="px-6 py-4">
                            <div class="w-14 h-20 bg-slate-100 rounded-lg overflow-hidden shadow-sm border border-slate-100">
                                <img src="{{ asset($book->image) }}" class="w-full h-full object-cover" alt="{{ $book->title }}">
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-slate-800 text-base max-w-xs truncate">{{ $book->title }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-slate-700 font-medium">{{ $book->author->name }}</div>
                            <div class="text-xs text-indigo-600 font-medium mt-0.5 bg-indigo-50 inline-block px-2 py-0.5 rounded-md">{{ $book->category->name }}</div>
                        </td>
                        <td class="px-6 py-4 text-slate-500">
                            <div>{{ $book->publisher }}</div>
                            <div class="text-xs text-slate-400 mt-0.5">Năm XB: {{ $book->publish_year }}</div>
                        </td>
                        <td class="px-6 py-4 font-mono text-xs text-slate-500">{{ $book->isbn ?? '---' }}</td>
                        <td class="px-6 py-4 text-center font-medium text-slate-700">{{ $book->quantity }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($book->available_quantity > 0)
                                <span class="px-2.5 py-1 text-xs font-semibold bg-emerald-50 text-emerald-700 rounded-full">{{ $book->available_quantity }} cuốn</span>
                            @else
                                <span class="px-2.5 py-1 text-xs font-semibold bg-rose-50 text-rose-700 rounded-full">Hết sách</span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-1.5">
                                
                                <button 
                                    @click="currentBook = {
                                        title: '{{ addslashes($book->title) }}',
                                        image: '{{ asset($book->image) }}',
                                        author: '{{ addslashes($book->author->name) }}',
                                        category: '{{ addslashes($book->category->name) }}',
                                        publisher: '{{ addslashes($book->publisher) }}',
                                        publish_year: '{{ $book->publish_year }}',
                                        isbn: '{{ $book->isbn }}',
                                        quantity: '{{ $book->quantity }}',
                                        available: '{{ $book->available_quantity }}',
                                        description: '{{ addslashes(preg_replace('/\s+/', ' ', $book->description)) }}'
                                    }; detailModalOpen = true" 
                                    class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" 
                                    title="Xem chi tiết"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </button>

                                <a href="{{ route('books.edit', $book->id) }}" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Sửa thông tin">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                    </svg>
                                </a>

                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sách này?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Xóa sách">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9 9m9 4.342V19a2 2 0 01-2 2H8a2 2 0 01-2-2V13.342M12 7V3.5A1.5 1.5 0 0113.5 2h3A1.5 1.5 0 0118 3.5V7M10 11h4"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div class="text-sm text-slate-500">
                    Hiển thị {{ $books->firstItem() }} đến {{ $books->lastItem() }} trên {{ $books->total() }} sách
                </div>
                <div class="[&_p]:hidden">
                    {{ $books->links() }}
                </div>
            </div>
        </div>

    </div>

    <div 
        x-show="detailModalOpen" 
        class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto"
        style="display: none;"
    >
        <div @click="detailModalOpen = false" class="fixed inset-0 bg-slate-900/60 transition-opacity"></div>

        <div 
            x-show="detailModalOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative bg-white rounded-2xl shadow-xl max-w-2xl w-full overflow-hidden border border-slate-100 z-10"
        >
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 bg-slate-50">
                <h3 class="text-lg font-bold text-slate-800">Thông tin chi tiết sách</h3>
                <button @click="detailModalOpen = false" class="text-slate-400 hover:text-slate-600 p-1.5 hover:bg-slate-200/60 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="flex flex-col items-center sm:items-start">
                    <div class="w-full max-w-[160px] aspect-[3/4] bg-slate-100 rounded-xl overflow-hidden shadow-md border border-slate-200">
                        <img :src="currentBook.image" class="w-full h-full object-cover" :alt="currentBook.title">
                    </div>
                </div>

                <div class="sm:col-span-2 space-y-3.5">
                    <h2 class="text-xl font-bold text-slate-900 leading-tight" x-text="currentBook.title"></h2>
                    
                    <div class="grid grid-cols-2 gap-x-4 gap-y-3 text-sm border-t border-slate-100 pt-3">
                        <div>
                            <span class="block text-xs font-semibold uppercase text-slate-400 tracking-wider">Tác giả</span>
                            <span class="text-slate-700 font-medium" x-text="currentBook.author"></span>
                        </div>
                        <div>
                            <span class="block text-xs font-semibold uppercase text-slate-400 tracking-wider">Thể loại</span>
                            <span class="inline-block px-2 py-0.5 text-xs text-indigo-600 bg-indigo-50 font-medium rounded mt-0.5" x-text="currentBook.category"></span>
                        </div>
                        <div>
                            <span class="block text-xs font-semibold uppercase text-slate-400 tracking-wider">Nhà xuất bản</span>
                            <span class="text-slate-600" x-text="currentBook.publisher"></span>
                        </div>
                        <div>
                            <span class="block text-xs font-semibold uppercase text-slate-400 tracking-wider">Năm xuất bản</span>
                            <span class="text-slate-600" x-text="currentBook.publish_year"></span>
                        </div>
                        <div class="col-span-2">
                            <span class="block text-xs font-semibold uppercase text-slate-400 tracking-wider">Mã số quốc tế (ISBN)</span>
                            <span class="font-mono text-slate-600" x-text="currentBook.isbn ? currentBook.isbn : 'Chưa cập nhật'"></span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-6 bg-slate-50 p-3 rounded-xl border border-slate-100 text-sm mt-2">
                        <div>
                            <span class="text-slate-400 text-xs block">Tổng kho:</span>
                            <span class="font-bold text-slate-700" x-text="currentBook.quantity + ' cuốn'"></span>
                        </div>
                        <div class="border-l border-slate-200 h-8"></div>
                        <div>
                            <span class="text-slate-400 text-xs block">Khả dụng:</span>
                            <span class="font-bold text-emerald-600" x-text="currentBook.available + ' cuốn'"></span>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 pt-3.5 mt-3">
                        <span class="block text-xs font-semibold uppercase text-slate-400 tracking-wider mb-1.5">Tóm tắt nội dung / Mô tả</span>
                        <div 
                            class="text-sm text-slate-600 leading-relaxed max-h-32 overflow-y-auto pr-1 bg-slate-50/50 p-3 rounded-xl border border-dashed border-slate-200"
                            x-text="currentBook.description ? currentBook.description : 'Không có mô tả cho cuốn sách này.'"
                        ></div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-3.5 bg-slate-50 border-t border-slate-100 flex justify-end">
                <button @click="detailModalOpen = false" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition">
                    Đóng lại
                </button>
            </div>
        </div>
    </div>

</div>
@endsection