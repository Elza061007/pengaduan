<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-lg font-semibold text-gray-800 sm:text-xl">Laporan Saya</h2>
            <a href="{{ route('laporan.create') }}"
               class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                + Buat Laporan
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="mx-auto max-w-5xl space-y-4 px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="rounded-md bg-green-50 p-4 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @forelse ($laporans as $laporan)
                <a href="{{ route('laporan.show', $laporan) }}"
                   class="block rounded-lg bg-white p-4 shadow-sm transition hover:shadow sm:p-5">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between sm:gap-4">
                        <div class="min-w-0">
                            <p class="text-xs text-gray-500">{{ $laporan->kode }}</p>
                            <h3 class="truncate font-semibold text-gray-900">{{ $laporan->judul }}</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ Str::limit($laporan->isi, 120) }}
                            </p>
                            <p class="mt-2 text-xs text-gray-400">
                                Dikirim {{ $laporan->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <span class="inline-flex w-fit shrink-0 rounded-full px-3 py-1 text-xs font-medium {{ $laporan->badgeClass() }}">
                            {{ ucfirst($laporan->status) }}
                        </span>
                    </div>
                </a>
            @empty
                <div class="rounded-lg bg-white p-8 text-center text-gray-500 shadow-sm sm:p-10">
                    Belum ada laporan. Klik "Buat Laporan" untuk mulai.
                </div>
            @endforelse

            <div class="pt-2">
                {{ $laporans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>