<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-lg shadow-lg p-6 mb-8">
                <h3 class="text-2xl font-bold mb-2">Selamat Datang Admin</h3>
                <p class="text-blue-100">Sistem Informasi Pacu Jalur Digital - Manajemen Data Master</p>
            </div>

            <!-- Quick Shortcuts -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-bolt text-yellow-500"></i> Akses Cepat
                </h3>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    <a href="{{ route('input-results') }}" class="bg-gradient-to-br from-red-500 to-red-600 text-white rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition p-4 flex flex-col items-center gap-2 text-center">
                        <i class="fas fa-dice text-2xl"></i>
                        <span class="text-sm font-semibold">Input Hasil</span>
                    </a>

                    <a href="/" class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition p-4 flex flex-col items-center gap-2 text-center">
                        <i class="fas fa-eye text-2xl"></i>
                        <span class="text-sm font-semibold">Lihat Aduan</span>
                    </a>

                    <button onclick="openModal('modalAsal')" class="bg-gradient-to-br from-indigo-500 to-indigo-600 text-white rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition p-4 flex flex-col items-center gap-2 text-center">
                        <i class="fas fa-plus text-2xl"></i>
                        <span class="text-sm font-semibold">Asal</span>
                    </button>

                    <button onclick="openModal('modalJalur')" class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition p-4 flex flex-col items-center gap-2 text-center">
                        <i class="fas fa-plus text-2xl"></i>
                        <span class="text-sm font-semibold">Jalur</span>
                    </button>

                    <button onclick="openModal('modalAduan')" class="bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition p-4 flex flex-col items-center gap-2 text-center">
                        <i class="fas fa-plus text-2xl"></i>
                        <span class="text-sm font-semibold">Aduan</span>
                    </button>

                    <button onclick="openModal('modalUser')" class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition p-4 flex flex-col items-center gap-2 text-center">
                        <i class="fas fa-plus text-2xl"></i>
                        <span class="text-sm font-semibold">User</span>
                    </button>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-chart-bar text-blue-600"></i> Statistik Cepat
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg shadow p-4 border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">User Terdaftar</p>
                                <p class="text-3xl font-black text-blue-600">{{ $totalUser ?? 0 }}</p>
                            </div>
                            <i class="fas fa-users text-5xl text-blue-200 opacity-50"></i>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg shadow p-4 border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Jalur</p>
                                <p class="text-3xl font-black text-green-600">{{ $totalJalur ?? 0 }}</p>
                            </div>
                            <i class="fas fa-water text-5xl text-green-200 opacity-50"></i>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg shadow p-4 border-l-4 border-purple-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Asal</p>
                                <p class="text-3xl font-black text-purple-600">{{ $totalAsal ?? 0 }}</p>
                            </div>
                            <i class="fas fa-map text-5xl text-purple-200 opacity-50"></i>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-lg shadow p-4 border-l-4 border-orange-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Aduan Hilir</p>
                                <p class="text-3xl font-black text-orange-600">{{ $totalAduan ?? 0 }}</p>
                            </div>
                            <i class="fas fa-book text-5xl text-orange-200 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Data Master -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-database text-indigo-600"></i> Data Master
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Asal -->
                    <button onclick="openModal('modalAsal')" class="bg-white rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition p-6 border-l-4 border-blue-600 text-left">
                        <div class="flex items-center justify-between mb-3">
                            <i class="fas fa-map text-blue-600 text-3xl"></i>
                            <span class="bg-blue-100 text-blue-600 text-xs font-bold px-2 py-1 rounded">Kelola</span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Asal</h4>
                        <p class="text-sm text-gray-600">Tambah, edit, dan hapus data Asal</p>
                        <div class="mt-4 text-sm text-gray-500">
                            <strong class="text-blue-600">{{ $totalAsal ?? 0 }}</strong> Asal terdaftar
                        </div>
                    </button>

                    <!-- Jalur -->
                    <button onclick="openModal('modalJalur')" class="bg-white rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition p-6 border-l-4 border-green-600 text-left">
                        <div class="flex items-center justify-between mb-3">
                            <i class="fas fa-water text-green-600 text-3xl"></i>
                            <span class="bg-green-100 text-green-600 text-xs font-bold px-2 py-1 rounded">Kelola</span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Jalur</h4>
                        <p class="text-sm text-gray-600">Tambah, edit, dan hapus data Jalur</p>
                        <div class="mt-4 text-sm text-gray-500">
                            <strong class="text-green-600">{{ $totalJalur ?? 0 }}</strong> jalur terdaftar
                        </div>
                    </button>

                    <!-- Aduan/Hilir -->
                    <button onclick="openModal('modalAduan')" class="bg-white rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition p-6 border-l-4 border-orange-600 text-left">
                        <div class="flex items-center justify-between mb-3">
                            <i class="fas fa-book text-orange-600 text-3xl"></i>
                            <span class="bg-orange-100 text-orange-600 text-xs font-bold px-2 py-1 rounded">Kelola</span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Aduan Hilir</h4>
                        <p class="text-sm text-gray-600">Tambah, edit, dan kelola jadwal aduan</p>
                        <div class="mt-4 text-sm text-gray-500">
                            <strong class="text-orange-600">{{ $totalAduan ?? 0 }}</strong> aduan terjadwal
                        </div>
                    </button>

                    <!-- User -->
                    <button onclick="openModal('modalUser')" class="bg-white rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition p-6 border-l-4 border-purple-600 text-left">
                        <div class="flex items-center justify-between mb-3">
                            <i class="fas fa-users text-purple-600 text-3xl"></i>
                            <span class="bg-purple-100 text-purple-600 text-xs font-bold px-2 py-1 rounded">Kelola</span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">User</h4>
                        <p class="text-sm text-gray-600">Tambah, edit, dan hapus data pengguna admin</p>
                        <div class="mt-4 text-sm text-gray-500">
                            <strong class="text-purple-600">{{ $totalUser ?? 0 }}</strong> user terdaftar
                        </div>
                    </button>
                </div>
            </div>

            <!-- Menu Transaksi/Proses -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-cogs text-indigo-600"></i> Proses & Transaksi
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Hasil Undian -->
                    <a href="{{ route('input-results') }}" class="bg-white rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition p-6 border-l-4 border-red-600">
                        <div class="flex items-center justify-between mb-3">
                            <i class="fas fa-dice text-red-600 text-3xl"></i>
                            <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded">Akses</span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Input Hasil Undian</h4>
                        <p class="text-sm text-gray-600">Kelola hasil undian dan pemenang aduan</p>
                    </a>

                    <!-- Generate Report -->
                    <a href="#" class="bg-white rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition p-6 border-l-4 border-indigo-600">
                        <div class="flex items-center justify-between mb-3">
                            <i class="fas fa-file-pdf text-indigo-600 text-3xl"></i>
                            <span class="bg-indigo-100 text-indigo-600 text-xs font-bold px-2 py-1 rounded">Download</span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Laporan</h4>
                        <p class="text-sm text-gray-600">Generate laporan dan export data hasil aduan</p>
                    </a>

                    <!-- Settings -->
                    <a href="#" class="bg-white rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition p-6 border-l-4 border-gray-600">
                        <div class="flex items-center justify-between mb-3">
                            <i class="fas fa-sliders-h text-gray-600 text-3xl"></i>
                            <span class="bg-gray-100 text-gray-600 text-xs font-bold px-2 py-1 rounded">Pengaturan</span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Pengaturan Sistem</h4>
                        <p class="text-sm text-gray-600">Konfigurasi dan pengaturan aplikasi</p>
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-bolt text-yellow-500"></i> Aksi Cepat
                </h3>
                <div class="flex flex-wrap gap-3">
                    <button onclick="openModal('modalAsal')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition">
                        <i class="fas fa-plus"></i> Tambah Asal
                    </button>
                    <button onclick="openModal('modalJalur')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition">
                        <i class="fas fa-plus"></i> Tambah Jalur
                    </button>
                    <button onclick="openModal('modalAduan')" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition">
                        <i class="fas fa-plus"></i> Tambah Aduan
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Asal -->
    <div id="modalAsal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">Tambah Asal</h3>
                <button onclick="closeModal('modalAsal')" class="text-2xl leading-none">&times;</button>
            </div>
            <form id="formAsal" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Asal</label>
                    <input type="text" name="nama_asal" placeholder="Masukkan nama Asal" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="flex gap-3 justify-end">
                    <button type="button" onclick="closeModal('modalAsal')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Jalur -->
    <div id="modalJalur" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="bg-green-600 text-white px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">Tambah Jalur</h3>
                <button onclick="closeModal('modalJalur')" class="text-2xl leading-none">&times;</button>
            </div>
            <form id="formJalur" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Jalur</label>
                    <input type="text" name="nama_jalur" placeholder="Masukkan nama jalur" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Desa</label>
                    <input type="text" name="desa" placeholder="Masukkan nama desa" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Asal</label>
                    <select name="Asal_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Pilih Asal</option>
                        @foreach($AsalList ?? [] as $kec)
                            <option value="{{ $kec->id }}">{{ $kec->nama_asal }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-3 justify-end">
                    <button type="button" onclick="closeModal('modalJalur')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Aduan Hilir -->
    <div id="modalAduan" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full max-h-96 overflow-y-auto">
            <div class="bg-orange-600 text-white px-6 py-4 flex justify-between items-center sticky top-0">
                <h3 class="text-lg font-bold">Tambah Aduan Hilir</h3>
                <button onclick="closeModal('modalAduan')" class="text-2xl leading-none">&times;</button>
            </div>
            <form id="formAduan" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Hilir</label>
                    <input type="text" name="nomor_hilir" placeholder="Contoh: H001" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Babak</label>
                    <select name="babak" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        <option value="">Pilih Babak</option>
                        <option value="Penyisihan">Penyisihan</option>
                        <option value="16 Besar">16 Besar</option>
                        <option value="8 Besar">8 Besar</option>
                        <option value="Semi Final">Semi Final</option>
                        <option value="Final">Final</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jalur Kiri</label>
                    <select name="jalur_kiri_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        <option value="">Pilih Jalur</option>
                        @foreach($jalurList ?? [] as $j)
                            <option value="{{ $j->id }}">{{ $j->nama_jalur }} - {{ $j->Asal->nama_asal }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jalur Kanan</label>
                    <select name="jalur_kanan_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        <option value="">Pilih Jalur</option>
                        @foreach($jalurList ?? [] as $j)
                            <option value="{{ $j->id }}">{{ $j->nama_jalur }} - {{ $j->Asal->nama_asal }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        <option value="">Pilih Status</option>
                        <option value="0">Belum Main</option>
                        <option value="1">Sedang Bersiap</option>
                        <option value="2">Selesai</option>
                    </select>
                </div>
                <div class="flex gap-3 justify-end">
                    <button type="button" onclick="closeModal('modalAduan')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal User -->
    <div id="modalUser" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="bg-purple-600 text-white px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">Tambah User</h3>
                <button onclick="closeModal('modalUser')" class="text-2xl leading-none">&times;</button>
            </div>
            <form id="formUser" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="name" placeholder="Masukkan nama user" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" placeholder="Masukkan email" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                </div>
                <div class="flex gap-3 justify-end">
                    <button type="button" onclick="closeModal('modalUser')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Close modal when clicking outside
        document.querySelectorAll('[id^="modal"]').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal(this.id);
                }
            });
        });

        // Form Asal
        document.getElementById('formAsal').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            try {
                const response = await fetch('{{ route("api.asal.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token')
                    }
                });
                
                if (response.ok) {
                    alert('Asal berhasil ditambahkan');
                    closeModal('modalAsal');
                    location.reload();
                } else {
                    alert('Gagal menambahkan Asal');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            }
        });

        // Form Jalur
        document.getElementById('formJalur').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            try {
                const response = await fetch('{{ route("api.jalur.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token')
                    }
                });
                
                if (response.ok) {
                    alert('Jalur berhasil ditambahkan');
                    closeModal('modalJalur');
                    location.reload();
                } else {
                    alert('Gagal menambahkan jalur');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            }
        });

        // Form Aduan
        document.getElementById('formAduan').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            try {
                const response = await fetch('{{ route("api.aduan.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token')
                    }
                });
                
                if (response.ok) {
                    alert('Aduan berhasil ditambahkan');
                    closeModal('modalAduan');
                    location.reload();
                } else {
                    alert('Gagal menambahkan aduan');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            }
        });

        // Form User
        document.getElementById('formUser').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            try {
                const response = await fetch('{{ route("api.user.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token')
                    }
                });
                
                if (response.ok) {
                    alert('User berhasil ditambahkan');
                    closeModal('modalUser');
                    location.reload();
                } else {
                    alert('Gagal menambahkan user');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            }
        });
    </script>

</x-app-layout>
