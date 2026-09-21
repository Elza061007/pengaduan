<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-800 sm:text-xl">Kelola Laporan</h2>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="mx-auto max-w-3xl space-y-4 px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="rounded-md bg-green-50 p-4 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="rounded-lg bg-white p-4 shadow-sm sm:p-6">
                <p class="text-xs text-gray-500">{{ $laporan->kode }}</p>
                <h3 class="break-words text-lg font-semibold">{{ $laporan->judul }}</h3>
                <p class="text-sm text-gray-500">
                    {{ $laporan->user->name }} ({{ $laporan->user->kelas ?? '-' }}) &middot;
                    {{ $laporan->created_at->format('d M Y H:i') }}
                </p>
                <p class="mt-4 whitespace-pre-line break-words text-gray-700">{{ $laporan->isi }}</p>

                @if ($laporan->lampiran)
                    <img src="{{ asset('storage/' . $laporan->lampiran) }}"
                         class="mt-4 max-h-80 w-full rounded-md border object-contain" alt="Lampiran">
                @endif
            </div>

            <form method="POST" action="{{ route('admin.laporan.update', $laporan) }}"
                  class="space-y-4 rounded-lg bg-white p-4 shadow-sm sm:p-6">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="status" value="Ubah Status" />
                    <select id="status" name="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @foreach (['menunggu', 'diproses', 'selesai', 'ditolak'] as $s)
                            <option value="{{ $s }}" @selected($laporan->status === $s)>
                                {{ ucfirst($s) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-input-label for="tanggapan" value="Tanggapan untuk Siswa" />
                    <textarea id="tanggapan" name="tanggapan" rows="5"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('tanggapan', $laporan->tanggapan) }}</textarea>
                </div>

                <x-primary-button class="w-full justify-center sm:w-auto">
                    Simpan
                </x-primary-button>
            </form>

            <form method="POST" action="{{ route('admin.laporan.destroy', $laporan) }}"
                  onsubmit="return confirm('Yakin hapus laporan ini?')">
                @csrf
                @method('DELETE')
                <button class="text-sm text-red-600 hover:underline">Hapus laporan</button>
            </form>

            <a href="{{ route('admin.laporan.index') }}" class="inline-block text-sm text-indigo-600">
                &larr; Kembali
            </a>
        </div>
    </div>
</x-app-layout>