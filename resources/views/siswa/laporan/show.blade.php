<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-800 sm:text-xl">Detail Laporan</h2>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="mx-auto max-w-3xl space-y-4 px-4 sm:px-6 lg:px-8">

            <div class="rounded-lg bg-white p-4 shadow-sm sm:p-6">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                    <div class="min-w-0">
                        <p class="text-xs text-gray-500">{{ $laporan->kode }}</p>
                        <h3 class="break-words text-lg font-semibold">{{ $laporan->judul }}</h3>
                        <p class="text-sm text-gray-500">
                            Kategori: {{ ucfirst($laporan->kategori) }} &middot;
                            {{ $laporan->created_at->format('d M Y H:i') }}
                        </p>
                    </div>
                    <span class="inline-flex w-fit shrink-0 rounded-full px-3 py-1 text-xs font-medium {{ $laporan->badgeClass() }}">
                        {{ ucfirst($laporan->status) }}
                    </span>
                </div>

                <p class="mt-4 whitespace-pre-line break-words text-gray-700">{{ $laporan->isi }}</p>

                @if ($laporan->lampiran)
                    <img src="{{ asset('storage/' . $laporan->lampiran) }}"
                         class="mt-4 max-h-80 w-full rounded-md border object-contain" alt="Lampiran">
                @endif
            </div>

            <div class="rounded-lg bg-white p-4 shadow-sm sm:p-6">
                <h4 class="font-semibold text-gray-900">Tanggapan Admin</h4>
                @if ($laporan->tanggapan)
                    <p class="mt-2 whitespace-pre-line break-words text-gray-700">{{ $laporan->tanggapan }}</p>
                    <p class="mt-2 text-xs text-gray-400">
                        Diproses {{ optional($laporan->diproses_at)->diffForHumans() }}
                    </p>
                @else
                    <p class="mt-2 text-sm text-gray-500">
                        Belum ada tanggapan. Laporan kamu masih {{ $laporan->status }}.
                    </p>
                @endif
            </div>

            <a href="{{ route('laporan.index') }}" class="inline-block text-sm text-indigo-600">
                &larr; Kembali
            </a>
        </div>
    </div>
</x-app-layout>