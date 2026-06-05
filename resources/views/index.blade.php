<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Pacu Jalur Kuansing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans">

    <header class="bg-gradient-to-r from-blue-700 to-indigo-800 text-white shadow-sm py-3 px-4 sticky top-0 z-10">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-lg font-bold flex items-center gap-2">
                <i class="fa-solid fa-ship text-yellow-400"></i> PACU JALUR DIGITAL
            </h1>
            <p class="text-xs text-blue-100">Pacu Jalur Event {{ date('Y') }}</p>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-3 py-3 space-y-3">

        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-3 flex justify-between items-center sticky top-14 z-10">
            <div class="text-sm">
                <span class="text-gray-500">Total Aduan:</span>
                <span class="font-bold text-indigo-700 ml-2">{{ $daftarAduan->count() }}</span>
            </div>
            <div class="relative flex-1 ml-4">
                <input type="text" id="searchInput" placeholder="Cari jalur atau nomor..." 
                    class="w-full px-3 py-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <i class="fa-solid fa-search absolute right-3 top-2 text-gray-400 text-sm"></i>
            </div>
        </div>

        <div class="space-y-2">

            @forelse($daftarAduan as $aduan)
                <div class="aduan-item bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden" 
                     data-search="{{ strtolower($aduan->jalurKiri->nama_jalur . ' ' . $aduan->jalurKanan->nama_jalur . ' ' . $aduan->nomor_hilir) }}">
                    
                    <div class="px-3 py-2 border-b border-gray-100 flex justify-between items-center text-xs bg-gray-50">
                        <span class="font-semibold text-gray-700">{{ strtoupper($aduan->nomor_hilir) }} <span class="text-indigo-600 font-bold">{{ $aduan->babak }}</span></span>
                        @if($aduan->status == 2)
                            <span class="bg-gray-300 text-gray-700 px-1.5 py-0.5 rounded text-xs font-medium">Selesai</span>
                        @elseif($aduan->status == 1)
                            <span class="bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded text-xs font-medium animate-pulse">Bersiap</span>
                        @else
                            <span class="bg-blue-50 text-blue-600 px-1.5 py-0.5 rounded text-xs font-medium">Belum</span>
                        @endif
                    </div>

                    <div class="p-3 space-y-2">
                        <div class="flex items-center justify-between gap-2 
                            {{ $aduan->status == 2 && $aduan->pemenang == 'kiri' ? 'bg-emerald-50 p-1.5 rounded border border-emerald-200' : 'p-1' }}">
                            <div class="flex items-center gap-2 flex-1">
                                @if($aduan->status == 2 && $aduan->pemenang == 'kiri')
                                    <span class="w-5 h-5 bg-emerald-600 text-white text-xs rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-check" style="font-size: 10px;"></i>
                                    </span>
                                @else
                                    <span class="w-5 h-5 bg-blue-100 text-blue-700 text-xs font-bold rounded-full flex items-center justify-center flex-shrink-0">Ki</span>
                                @endif
                                <div class="min-w-0">
                                    <h4 class="font-semibold text-xs truncate {{ $aduan->status == 2 && $aduan->pemenang == 'kiri' ? 'text-emerald-900' : 'text-gray-900' }}">
                                        {{ $aduan->jalurKiri->nama_jalur }}
                                    </h4>
                                    <p class="text-xs {{ $aduan->status == 2 && $aduan->pemenang == 'kiri' ? 'text-emerald-600' : 'text-gray-500' }} truncate">
                                        {{ $aduan->jalurKiri->asal->nama_asal }}
                                    </p>
                                </div>
                            </div>
                            @if($aduan->status == 2 && $aduan->pemenang == 'kiri')
                                <span class="text-xs font-bold text-emerald-700 flex-shrink-0">✓</span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between gap-2 
                            {{ $aduan->status == 2 && $aduan->pemenang == 'kanan' ? 'bg-emerald-50 p-1.5 rounded border border-emerald-200' : 'p-1' }}">
                            <div class="flex items-center gap-2 flex-1">
                                @if($aduan->status == 2 && $aduan->pemenang == 'kanan')
                                    <span class="w-5 h-5 bg-emerald-600 text-white text-xs rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-check" style="font-size: 10px;"></i>
                                    </span>
                                @else
                                    <span class="w-5 h-5 bg-red-100 text-red-700 text-xs font-bold rounded-full flex items-center justify-center flex-shrink-0">Ka</span>
                                @endif
                                <div class="min-w-0">
                                    <h4 class="font-semibold text-xs truncate {{ $aduan->status == 2 && $aduan->pemenang == 'kanan' ? 'text-emerald-900' : 'text-gray-900' }}">
                                        {{ $aduan->jalurKanan->nama_jalur }}
                                    </h4>
                                    <p class="text-xs {{ $aduan->status == 2 && $aduan->pemenang == 'kanan' ? 'text-emerald-600' : 'text-gray-500' }} truncate">
                                        {{ $aduan->jalurKanan->asal->nama_asal }}
                                    </p>
                                </div>
                            </div>
                            @if($aduan->status == 2 && $aduan->pemenang == 'kanan')
                                <span class="text-xs font-bold text-emerald-700 flex-shrink-0">✓</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-400 bg-white rounded-lg border border-gray-200 p-4">
                    <i class="fa-solid fa-box-open text-2xl mb-2 text-gray-300"></i>
                    <p class="text-sm">Belum ada jadwal aduan.</p>
                </div>
            @endforelse

        </div>

        <footer class="text-center py-4 text-xs text-gray-500 bg-white rounded-lg border border-gray-200 mt-4">
            <p>© 2026 Aldespi Arifin</p>
            <p class="text-xs text-gray-400 mt-1"><i class="fas fa-sync-alt animate-spin mr-1"></i> Live Update</p>
        </footer>

    </main>

    <script>
        let currentSearch = '';

        document.getElementById('searchInput').addEventListener('keyup', function(e) {
            currentSearch = e.target.value.toLowerCase();
            filterAduan();
        });

        function filterAduan() {
            const aduanItems = document.querySelectorAll('.aduan-item');
            aduanItems.forEach(item => {
                const searchData = item.getAttribute('data-search');
                if (searchData.includes(currentSearch)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        async function updateLiveData() {
            try {
                const response = await fetch('/api/aduan/list');
                if (!response.ok) return;

                const data = await response.json();
                const container = document.querySelector('.space-y-2');

                if (data.length === 0) {
                    container.innerHTML = `
                        <div class="text-center py-8 text-gray-400 bg-white rounded-lg border border-gray-200 p-4">
                            <i class="fa-solid fa-box-open text-2xl mb-2 text-gray-300"></i>
                            <p class="text-sm">Belum ada jadwal aduan.</p>
                        </div>
                    `;
                    return;
                }

                container.innerHTML = data.map(aduan => `
                    <div class="aduan-item bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden" 
                         data-search="${(aduan.jalur_kiri.nama_jalur + ' ' + aduan.jalur_kanan.nama_jalur + ' ' + aduan.nomor_hilir).toLowerCase()}">
                        
                        <div class="px-3 py-2 border-b border-gray-100 flex justify-between items-center text-xs bg-gray-50">
                            <span class="font-semibold text-gray-700">${aduan.nomor_hilir.toUpperCase()} <span class="text-indigo-600 font-bold">${aduan.babak}</span></span>
                            ${aduan.status == 2 ? '<span class="bg-gray-300 text-gray-700 px-1.5 py-0.5 rounded text-xs font-medium">Selesai</span>' : 
                              aduan.status == 1 ? '<span class="bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded text-xs font-medium animate-pulse">Bersiap</span>' :
                              '<span class="bg-blue-50 text-blue-600 px-1.5 py-0.5 rounded text-xs font-medium">Belum</span>'}
                        </div>

                        <div class="p-3 space-y-2">
                            <div class="flex items-center justify-between gap-2 
                                ${aduan.status == 2 && aduan.pemenang == 'kiri' ? 'bg-emerald-50 p-1.5 rounded border border-emerald-200' : 'p-1'}">
                                <div class="flex items-center gap-2 flex-1">
                                    ${aduan.status == 2 && aduan.pemenang == 'kiri' ?
                                        '<span class="w-5 h-5 bg-emerald-600 text-white text-xs rounded-full flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-check" style="font-size: 10px;"></i></span>' :
                                        '<span class="w-5 h-5 bg-blue-100 text-blue-700 text-xs font-bold rounded-full flex items-center justify-center flex-shrink-0">Ki</span>'}
                                    <div class="min-w-0">
                                        <h4 class="font-semibold text-xs truncate ${aduan.status == 2 && aduan.pemenang == 'kiri' ? 'text-emerald-900' : 'text-gray-900'}">
                                            ${aduan.jalur_kiri.nama_jalur}
                                        </h4>
                                        <p class="text-xs ${aduan.status == 2 && aduan.pemenang == 'kiri' ? 'text-emerald-600' : 'text-gray-500'} truncate">
                                            ${aduan.jalur_kiri.asal.nama_asal}
                                        </p>
                                    </div>
                                </div>
                                ${aduan.status == 2 && aduan.pemenang == 'kiri' ? '<span class="text-xs font-bold text-emerald-700 flex-shrink-0">✓</span>' : ''}
                            </div>

                            <div class="flex items-center justify-between gap-2 
                                ${aduan.status == 2 && aduan.pemenang == 'kanan' ? 'bg-emerald-50 p-1.5 rounded border border-emerald-200' : 'p-1'}">
                                <div class="flex items-center gap-2 flex-1">
                                    ${aduan.status == 2 && aduan.pemenang == 'kanan' ?
                                        '<span class="w-5 h-5 bg-emerald-600 text-white text-xs rounded-full flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-check" style="font-size: 10px;"></i></span>' :
                                        '<span class="w-5 h-5 bg-red-100 text-red-700 text-xs font-bold rounded-full flex items-center justify-center flex-shrink-0">Ka</span>'}
                                    <div class="min-w-0">
                                        <h4 class="font-semibold text-xs truncate ${aduan.status == 2 && aduan.pemenang == 'kanan' ? 'text-emerald-900' : 'text-gray-900'}">
                                            ${aduan.jalur_kanan.nama_jalur}
                                        </h4>
                                        <p class="text-xs ${aduan.status == 2 && aduan.pemenang == 'kanan' ? 'text-emerald-600' : 'text-gray-500'} truncate">
                                            ${aduan.jalur_kanan.asal.nama_asal}
                                        </p>
                                    </div>
                                </div>
                                ${aduan.status == 2 && aduan.pemenang == 'kanan' ? '<span class="text-xs font-bold text-emerald-700 flex-shrink-0">✓</span>' : ''}
                            </div>
                        </div>
                    </div>
                `).join('');

                // Update total count
                document.querySelector('.text-indigo-700.ml-2').textContent = data.length;

                // Re-apply search filter
                filterAduan();
            } catch (error) {
                console.error('Error updating live data:', error);
            }
        }

        // Update data every 2 seconds
        setInterval(updateLiveData, 2000);
    </script>

</body>
</html>