<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="pb-4 text-lg font-bold">Daftar Menu</h3>
                    
                    <div class="overflow-x-auto w-full sm:rounded-lg">
                        <table class="w-full min-w-full border border-gray-300 border-collapse dark:border-gray-700">
                            <thead>
                                <tr class="text-gray-900 bg-gray-200 dark:bg-gray-700 dark:text-gray-100">
                                    <th class="px-2 py-2 text-sm text-center border sm:px-6 sm:py-3 sm:text-base md:text-lg">No</th>
                                    <th class="px-2 py-2 text-sm text-center border sm:px-6 sm:py-3 sm:text-base md:text-lg">ID</th>
                                    <th class="px-2 py-2 text-sm text-center border sm:px-6 sm:py-3 sm:text-base md:text-lg">Nama Menu</th>
                                    <th class="px-2 py-2 text-sm text-center border sm:px-6 sm:py-3 sm:text-base md:text-lg">Gambar</th>
                                    <th class="px-2 py-2 text-sm text-center border sm:px-6 sm:py-3 sm:text-base md:text-lg">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $index => $menu)
                                <tr class="border transition hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-2 py-2 text-sm text-center border sm:px-6 sm:py-3 sm:text-base">{{ $index + 1 }}</td>
                                    <td class="px-2 py-2 text-sm text-center border sm:px-6 sm:py-3 sm:text-base">{{ $menu->id }}</td>
                                    <td class="px-2 py-2 text-sm font-bold text-center border sm:px-6 sm:py-3 sm:text-base">{{ $menu->name }}</td>
                                    <td class="px-2 py-2 text-center border sm:px-6 sm:py-3">
                                        <div class="flex space-x-1 overflow-x-auto max-w-[120px] sm:max-w-[200px] mx-auto">
                                            @foreach ($menu->images as $image)
                                                <img src="{{ Storage::disk('s3')->url($image->image_path) }}" 
                                                     alt="Menu Preview" 
                                                     class="w-5 h-5 rounded-md shadow-sm transition-transform cursor-pointer sm:w-8 sm:h-8 hover:scale-105">
                                            @endforeach
                                        </div>
                                    </td>                          
                                    <td class="px-2 py-2 text-center border sm:px-6 sm:py-3">
                                        <a href="{{ route('admin.qr', $menu->id) }}" 
                                            class="inline-block px-3 py-1 text-sm font-bold text-white bg-blue-500 rounded-lg shadow-md transition sm:px-5 sm:py-2 sm:text-base hover:bg-blue-700">
                                            🔗 QR
                                        </a>
                                        <form action="{{ route('admin.delete', $menu->id) }}" method="POST" 
                                            class="inline-block mt-1 sm:mt-2"
                                            onsubmit="return confirm('Yakin ingin menghapus menu ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                class="px-3 py-1 text-sm font-bold text-white bg-red-500 rounded-lg shadow-md transition sm:px-5 sm:py-2 sm:text-base hover:bg-red-700">
                                                ❌ Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <form action="{{ route('admin.upload') }}" method="POST" enctype="multipart/form-data" class="pt-6">
                        @csrf
                        <div class="flex flex-col space-y-4">
                            <div>
                                <label class="block font-bold text-gray-300">Nama Menu</label>
                                <input type="text" name="name" required 
                                    class="px-4 py-2 text-gray-300 rounded border border-gray-600 shadow dark:bg-gray-700 dark:text-white">
                            </div>
                            <div>
                                <label class="block font-bold text-gray-300">Upload Gambar (Maksimal 5 gambar)</label>
                                <input type="file" name="images[]" accept="image/jpeg" multiple required 
                                    class="px-4 py-2 w-full rounded border border-gray-600 shadow dark:bg-gray-700 dark:text-white">
                            </div>
                            <button type="submit" 
                                class="px-5 py-2 font-bold text-white bg-green-500 rounded-lg shadow-md transition hover:bg-green-700">
                                ⬆️ Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
