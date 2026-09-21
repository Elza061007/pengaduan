<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-800 sm:text-xl">Buat Laporan</h2>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('laporan.store') }}"
                  enctype="multipart/form-data"
                  class="space-y-5 rounded-lg bg-white p-4 shadow-sm sm:p-6">
                @csrf

                <div>
                    <x-input-label for="judul" value="Judul Laporan" />
                    <x-text-input id="judul" name="judul" class="mt-1 block w-full"
                                  value="{{ old('judul') }}" required />
                    <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="kategori" value="Kategori" />
                    <select id="kategori" name="kategori"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @foreach (['fasilitas', 'kekerasan', 'guru', 'kebersihan', 'lainnya'] as $k)
                            <option value="{{ $k }}" @selected(old('kategori') === $k)>
                                {{ ucfirst($k) }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="isi" value="Isi Laporan" />
                    <textarea id="isi" name="isi" rows="6" required
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                              placeholder="Ceritakan kejadiannya minimal 20 karakter...">{{ old('isi') }}</textarea>
                    <x-input-error :messages="$errors->get('isi')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="lampiran" value="Lampiran (opsional, max 2MB)" />
                    <input type="file" id="lampiran" name="lampiran" accept="image/*"
                           class="mt-1 block w-full text-sm text-gray-600 file:mr-3 file:rounded-md file:border-0 file:bg-gray-100 file:px-3 file:py-2 file:text-sm" />
                    <x-input-error :messages="$errors->get('lampiran')" class="mt-2" />
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <x-primary-button class="w-full justify-center sm:w-auto">
                        Kirim Laporan
                    </x-primary-button>
                    <a href="{{ route('laporan.index') }}"
                       class="text-center text-sm text-gray-600 sm:text-left">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>