@extends('layouts.adminFullPage')

@push('header')
    @vite(['resources/js/tableArticle.js'])
@endpush

@section('content')
<div x-data="articleHandler" x-init="fetchArticles">
    <table id="search-table">
        <thead>
            <tr class="">
                <th class="flex items-center">
                    <span class="flex items-center">
                        Title
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Author
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Created at
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Action
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
                <template x-for="article in articles" :key="article.id">
                    <tr>
                        <td>hai</td>
                        <td>aku</td>
                        <td>now</td>
                        <td>ngantuk</td>
                    </tr>
                </template>
            <template x-if="articles.length > 0">
                <template x-for="article in articles" :key="article.id">
                    <tr>
                        <td>hai</td>
                        <td>aku</td>
                        <td>now</td>
                        <td>ngantuk</td>
                    </tr>
                </template>
            </template>
            <tr class="bg-white border-b hover:bg-gray-50">
                <td x-text="articles.length" class="font-medium text-gray-900 whitespace-nowrap">hai</td>
                <td>aku</td>
                <td>now</td>
                <td>ngantuk</td>
            </tr>

                {{-- <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ Str::limit($article['title'], 110) }}
                </td>
                <td>
                    {{ Str::limit($article->user->name, 20) }}
                </td>
                <td>{{ $article->created_at->diffForHumans() }}</td>
                <td>
                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <a href="{{ route('admin.article.show', $article->id) }}" type="button" class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-s-lg hover:bg-blue-600 focus:text-white dark:bg-blue-700 dark:text-white dark:hover:bg-blue-800 dark:focus:text-white">
                        Show
                        </a>
                        <a href="{{ route('admin.article.update', $article->id) }}" type="button" class="px-4 py-2 text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:text-white dark:bg-green-700 dark:text-white dark:hover:bg-green-800 dark:focus:text-white">
                        Edit
                        </a>
                        <button data-modal-target="delete-modal-{{ $article->id }}" data-modal-toggle="delete-modal-{{ $article->id }}" type="button" class="px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-e-lg hover:bg-red-600 focus:text-white dark:bg-red-700 dark:text-white dark:hover:bg-red-800 dark:focus:text-white">
                        Delete
                        </button>
                        <div id="delete-modal-{{ $article->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal-{{ $article->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin akan menghapus artikel ini?</h3>
                                        <form action="{{ route('admin.article.destroy', $article->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Delete
                                            </button>
                                        </form>
                                        <button data-modal-hide="delete-modal-{{ $article->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr> --}}
        </tbody>
    </table>
</div>
@endsection
@push('script')
    <script>
        function articleHandler() {
            return {
                articles: [],
                articleModal: false,
                isLoading: false,
                error: null,
                message: null,
                async fetchArticles() {
                    this.isLoading = true;
                    try {
                        const response = await axios.get('/articles');
                        console.log(response.data);
                        this.articles = response.data.data; // Asumsikan API mengembalikan array objek sparing
                        console.log(this.articles);
                        console.log('Articles data:', JSON.parse(JSON.stringify(this.articles)));
                    } catch (error) {
                        console.error('Terjadi Kesalahan Di Server:', error);
                    } finally {
                        this.isLoading = false;
                    }
                },
                async createArtcle(articleId) {
                    try {
                        const response = await axios.post(`/articles/${articleId}/request`);
                        console.log(response.data);
                        this.fetchArticles(); // Refresh data sparing
                        this.message = response.data.message || 'Permintaan sparing berhasil dikirim.';
                    } catch (error) {
                        console.error('Terjadi Kesalahan:', error);
                        this.error = error.response.data.errors || 'Terjadi kesalahan saat mengirim permintaan sparing.'
                    }
                }
            }
        }
    </script>
@endpush