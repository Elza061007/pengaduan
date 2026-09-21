<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-800 sm:text-xl">Kelola Laporan</h2>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="mx-auto max-w-7xl space-y-5 px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="rounded-md bg-green-50 p-4 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-2 gap-3 sm:gap-4 md:grid-cols-4">
                @foreach ($statistik as $label => $jumlah)
                    <div class="rounded-lg bg-white p-3 shadow-sm sm:p-4">
                        <p class="text-xs uppercase text-gray-500">{{ $label }}</p>
                        <p class="text-xl font-bold text-gray-900 sm:text-2xl">{{ $jumlah }}</p>
                    </div>
                @endforeach
            </div>

            <form method="GET" class="flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul..."
                       class="w-full rounded-md border-gray-300 text-sm sm:w-auto sm:flex-1">
                <select name="status" class="w-full rounded-md border-gray-300 text-sm sm:w-auto">
                    <option value="">Semua status</option>
                    @foreach (['menunggu', 'diproses', 'selesai', 'ditolak'] as $s)
                        <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                <button class="w-full rounded-md bg-gray-800 px-4 py-2 text-sm text-white sm:w-auto">
                    Filter
                </button>
            </form>

            <!-- Tampilan tabel: desktop/tablet -->
            <div class="hidden overflow-x-auto rounded-lg bg-white shadow-sm sm:block">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-left text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3">Kode</th>
                            <th class="px-4 py-3">Pelapor</th>
                            <th class="px-4 py-3">Judul</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($laporans as $laporan)
                            <tr>
                                <td class="px-4 py-3 text-gray-500">{{ $laporan->kode }}</td>
                                <td class="px-4 py-3">
                                    {{ $laporan->user->name }}
                                    <span class="block text-xs text-gray-400">{{ $laporan->user->kelas }}</span>
                                </td>
                                <td class="px-4 py-3 font-medium">{{ Str::limit($laporan->judul, 40) }}</td>
                                <td class="px-4 py-3">{{ ucfirst($laporan->kategori) }}</td>
                                <td class="px-4 py-3">
                                    <span class="rounded-full px-2 py-1 text-xs {{ $laporan->badgeClass() }}">
                                        {{ ucfirst($laporan->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-500">{{ $laporan->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.laporan.show', $laporan) }}"
                                       class="text-indigo-600 hover:underline">Kelola</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-10 text-center text-gray-500">
                                    Belum ada laporan masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tampilan kartu: HP -->
            <div class="space-y-3 sm:hidden">
                @forelse ($laporans as $laporan)
                    <a href="{{ route('admin.laporan.show', $laporan) }}"
                       class="block rounded-lg bg-white p-4 shadow-sm">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-xs text-gray-500">{{ $laporan->kode }}</p>
                                <p class="truncate font-medium text-gray-900">{{ $laporan->judul }}</p>
                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $laporan->user->name }} &middot; {{ $laporan->user->kelas }}
                                </p>
                                <p class="mt-1 text-xs text-gray-400">
                                    {{ ucfirst($laporan->kategori) }} &middot; {{ $laporan->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                            <span class="shrink-0 rounded-full px-2 py-1 text-xs {{ $laporan->badgeClass() }}">
                                {{ ucfirst($laporan->status) }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="rounded-lg bg-white p-8 text-center text-gray-500 shadow-sm">
                        Belum ada laporan masuk.
                    </div>
                @endforelse
            </div>

            <div class="pt-2">
                {{ $laporans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>