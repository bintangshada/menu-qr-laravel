<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            QR Code
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-6 mx-auto max-w-2xl bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <h2 class="mb-4 text-2xl font-bold text-center text-gray-900 dark:text-gray-100">
                            📌 QR Code untuk Menu
                        </h2>
                        
                        <p class="mb-4 text-center text-gray-700 dark:text-gray-300">
                            Scan QR Code di bawah ini untuk melihat menu:
                        </p>
                    
                        @if($qrUrl)
                            <div class="flex justify-center">
                                <img src="{{ $qrUrl }}" alt="QR Code" class="w-48 h-48 rounded-lg border-4 border-gray-300 shadow-lg dark:border-gray-600">
                            </div>
                        @else
                            <p class="font-semibold text-center text-red-500">❌ QR Code tidak tersedia.</p>
                        @endif
                    
                        <div class="mt-4 text-center">
                            <p class="text-gray-700 dark:text-gray-300">Atau kunjungi link berikut:</p>
                            <a href="{{ $url }}" class="font-semibold text-blue-500 break-all hover:underline">
                                {{ $url }}
                            </a>
                        </div>
                    
                        <div class="flex justify-center mt-6">
                            <a href="{{ route('admin.download', ['id' => $menu->id]) }}" 
                               class="flex gap-2 items-center px-5 py-2 font-bold text-white bg-green-500 rounded-lg shadow-md transition hover:bg-green-700">
                                ⬇️ Download QR Code
                            </a>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>