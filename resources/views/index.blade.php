<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PacuJalur.online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 text-gray-800 antialiased font-sans">

    <header class="bg-gradient-to-r from-blue-700 to-indigo-800 text-white shadow-sm py-3 px-4 sticky top-0 z-10">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-lg font-bold flex items-center gap-2">
                PACU JALUR
            </h1>
            <p class="text-xs text-blue-100">Event Tahun {{ date('Y') }}</p>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-3 py-3 space-y-3">
        <div class="bg-indigo-900 text-white p-3 rounded-lg shadow-md text-center">
            <h2 class="text-sm font-bold uppercase tracking-wide">UNDIAN PACU JALUR RAYON 1 DITEPIAN TIGO MUARO KEC
                INUMAN I HARI PERTAMA</h2>
        </div>

        <div
            class="bg-white rounded-lg border border-gray-200 shadow-sm p-3 flex justify-between items-center sticky top-14 z-10">
            <div class="text-sm">
                <span class="text-gray-500">Total Aduan:</span>
                <span class="font-bold text-indigo-700 ml-2" id="totalAduan">{{ $daftarAduan->count() }}</span>
            </div>
            <div class="relative flex-1 ml-4">
                <input type="text" id="searchInput" placeholder="Cari jalur..."
                    class="w-full px-3 py-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>

        <div class="space-y-1" id="containerAduan">
    @forelse($daftarAduan as $aduan)
       <div class="aduan-item bg-white p-2 rounded-lg border border-gray-200 shadow-sm flex items-center gap-2 text-[11px]">
    
    <div class="flex-none w-6 flex justify-center">
        @if($aduan->status == 2)
            <div class="w-3 h-3 bg-green-500 rounded-full" title="Selesai"></div>
        @elseif($aduan->status == 1)
            <div class="w-3 h-3 bg-amber-500 rounded-full animate-pulse" title="Sedang Berlangsung"></div>
        @else
            <div class="w-3 h-3 bg-gray-300 rounded-full" title="Antre"></div>
        @endif
    </div>

    <div class="flex-1 grid grid-cols-[1fr_auto_1fr] gap-2 items-center">
        <div class="truncate text-right {{ $aduan->status == 2 && $aduan->pemenang == 'kiri' ? 'font-bold text-green-700' : '' }}">
            {{ $aduan->jalurKiri->nama_jalur }}
        </div>
        
        <div class="text-[9px] text-gray-400 font-bold">VS</div>
        
        <div class="truncate text-left {{ $aduan->status == 2 && $aduan->pemenang == 'kanan' ? 'font-bold text-green-700' : '' }}">
            {{ $aduan->jalurKanan->nama_jalur }}
        </div>
    </div>

    <div class="flex-none text-gray-400 w-8 text-center font-bold">
        #{{ $aduan->nomor_hilir }}
    </div>
</div>
    @empty
        <div class="text-center py-4 text-[10px] text-gray-400">Belum ada jadwal.</div>
    @endforelse
</div>
    </main>

    <footer class="text-center py-4 text-xs text-gray-500 bg-white rounded-lg border border-gray-200 mt-4 mx-3">
        <p>© 2026 Aldespi Arifin</p>
    </footer>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function (e) {
            const query = e.target.value.toLowerCase();
            document.querySelectorAll('.aduan-item').forEach(item => {
                item.style.display = item.getAttribute('data-search').includes(query) ? '' : 'none';
            });
        });

     async function updateLiveData() {
    try {
        const response = await fetch('/api/aduan/list');
        if (!response.ok) return;
        const data = await response.json();
        
        // --- PERBAIKAN: Definisi container di sini ---
        const container = document.getElementById('containerAduan');
        
        container.innerHTML = data.map(aduan => {
            // Tentukan warna titik status
            let statusClass = 'bg-gray-300'; // Default (Antre)
            if (aduan.status == 2) statusClass = 'bg-green-500';
            else if (aduan.status == 1) statusClass = 'bg-amber-500 animate-pulse';

            // Tentukan style pemenang
            const winnerKiri = (aduan.status == 2 && aduan.pemenang == 'kiri') ? 'font-bold text-green-700' : '';
            const winnerKanan = (aduan.status == 2 && aduan.pemenang == 'kanan') ? 'font-bold text-green-700' : '';

            return `
                <div class="aduan-item bg-white p-2 rounded-lg border border-gray-200 shadow-sm flex items-center gap-2 text-[11px]" 
                     data-search="${(aduan.jalur_kiri.nama_jalur + ' ' + aduan.jalur_kanan.nama_jalur).toLowerCase()}">
                    
                    <div class="flex-none w-6 flex justify-center">
                        <div class="w-3 h-3 ${statusClass} rounded-full"></div>
                    </div>

                    <div class="flex-1 grid grid-cols-[1fr_auto_1fr] gap-2 items-center text-center overflow-hidden">
                        <div class="truncate ${winnerKiri}">${aduan.jalur_kiri.nama_jalur}</div>
                        <div class="text-[9px] text-gray-400 font-bold">VS</div>
                        <div class="truncate ${winnerKanan}">${aduan.jalur_kanan.nama_jalur}</div>
                    </div>

                    <div class="flex-none text-gray-400 w-8 text-center font-bold">
                        #${aduan.nomor_hilir}
                    </div>
                </div>
            `;
        }).join('');

        // Update jumlah total aduan
        document.getElementById('totalAduan').textContent = data.length;
        
    } catch (error) {
        console.error('Gagal memperbarui data:', error);
    }
}

// Jalankan setiap 2 detik
setInterval(updateLiveData, 2000);
    </script>
</body>

</html>