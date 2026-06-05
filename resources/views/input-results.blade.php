<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Hasil Aduan') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">
                <div class="flex flex-col sm:flex-row gap-4 items-end">
                    <div class="flex-1 w-full">
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Cari Nomor Hilir atau Babak</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" id="filterInput" placeholder="Contoh: H001 atau Final" 
                                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition text-sm">
                        </div>
                    </div>
                    <button onclick="loadResults()" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 active:scale-95 text-white px-6 py-2.5 rounded-xl flex items-center justify-center gap-2 font-semibold text-sm shadow-sm transition">
                        <i class="fas fa-sync-alt"></i> Refresh Data
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6" id="resultsList">
                <div class="text-center py-12 bg-white rounded-xl border border-gray-200 shadow-sm text-gray-500">
                    <i class="fas fa-spinner fa-spin text-3xl mb-3 text-indigo-500"></i>
                    <p class="text-sm font-medium">Memuat data aduan...</p>
                </div>
            </div>

        </div>
    </div>

    <script>
        let allResults = [];

        async function loadResults() {
            try {
                const response = await fetch('{{ route("api.aduan.list") }}');
                const data = await response.json();
                allResults = data;
                filterResults(); 
            } catch (error) {
                console.error('Error:', error);
            }
        }

        function filterResults() {
            const filterValue = document.getElementById('filterInput').value.toLowerCase();
            const filtered = allResults.filter(aduan => {
                return (aduan.nomor_hilir && aduan.nomor_hilir.toLowerCase().includes(filterValue)) || 
                       (aduan.babak && aduan.babak.toLowerCase().includes(filterValue));
            });
            renderResults(filtered);
        }

        function renderResults(results) {
            const container = document.getElementById('resultsList');
            
            if (results.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-12 text-gray-500 bg-white rounded-xl border border-gray-200 shadow-sm">
                        <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                        <p class="font-medium text-sm">Tidak ada jadwal aduan yang ditemukan</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = results.map(aduan => {
                // Tentukan class badge pembungkus tombol status awal saat render
                const isStatus0 = aduan.status == 0 ? 'bg-white text-gray-800 shadow-sm border border-gray-200' : 'text-gray-500 hover:bg-gray-200/50';
                const isStatus1 = aduan.status == 1 ? 'bg-amber-500 text-white shadow-sm' : 'text-gray-500 hover:bg-amber-100/50';
                const isStatus2 = aduan.status == 2 ? 'bg-indigo-600 text-white shadow-sm' : 'text-gray-500 hover:bg-indigo-100/50';

                return `
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition hover:shadow-md">
                        <div class="bg-gray-50 px-6 py-3 border-b border-gray-100 flex justify-between items-center">
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                ${aduan.babak || 'Babak N/A'}
                            </span>
                            <h3 class="text-lg font-black text-gray-800 tracking-tight">
                                HILIR: ${aduan.nomor_hilir ? aduan.nomor_hilir.toUpperCase() : '-'}
                            </h3>
                        </div>

                        <div class="p-6 grid grid-cols-1 lg:grid-cols-12 gap-6">
                            <div class="lg:col-span-7 flex flex-col justify-center space-y-3">
                                <div class="bg-blue-50/70 p-4 rounded-xl border-l-4 border-blue-500 flex justify-between items-center">
                                    <div>
                                        <p class="text-[10px] uppercase font-bold tracking-wider text-blue-600 mb-0.5">Jalur Kiri (Ki)</p>
                                        <p class="font-extrabold text-base text-gray-800">${aduan.jalur_kiri?.nama_jalur || '-'}</p>
                                        <p class="text-xs text-gray-500 mt-0.5"><i class="fas fa-map-marker-alt text-blue-400 mr-1"></i>${aduan.jalur_kiri?.asal?.nama_asal || 'Asal N/A'}</p>
                                    </div>
                                    <span class="text-blue-200 text-3xl font-black select-none">KI</span>
                                </div>
                                
                                <div class="bg-red-50/70 p-4 rounded-xl border-l-4 border-red-500 flex justify-between items-center">
                                    <div>
                                        <p class="text-[10px] uppercase font-bold tracking-wider text-red-600 mb-0.5">Jalur Kanan (Ka)</p>
                                        <p class="font-extrabold text-base text-gray-800">${aduan.jalur_kanan?.nama_jalur || '-'}</p>
                                        <p class="text-xs text-gray-500 mt-0.5"><i class="fas fa-map-marker-alt text-red-400 mr-1"></i>${aduan.jalur_kanan?.asal?.nama_asal || 'Asal N/A'}</p>
                                    </div>
                                    <span class="text-red-200 text-3xl font-black select-none">KA</span>
                                </div>
                            </div>

                            <div class="lg:col-span-5 flex flex-col justify-between border-t lg:border-t-0 lg:border-l border-gray-100 pt-4 lg:pt-0 lg:pl-6 space-y-4">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Status Pertandingan</label>
                                    <div class="flex bg-gray-100 p-1 rounded-xl w-full" id="status-group-${aduan.id}">
                                        <button onclick="changeStatusInline(${aduan.id}, 0)" id="btn-status-0-${aduan.id}"
                                            class="flex-1 py-2 rounded-lg text-xs font-bold transition duration-200 ${isStatus0}">
                                            Belum Main
                                        </button>
                                        <button onclick="changeStatusInline(${aduan.id}, 1)" id="btn-status-1-${aduan.id}"
                                            class="flex-1 py-2 rounded-lg text-xs font-bold transition duration-200 ${isStatus1}">
                                            Bersiap
                                        </button>
                                        <button onclick="changeStatusInline(${aduan.id}, 2)" id="btn-status-2-${aduan.id}"
                                            class="flex-1 py-2 rounded-lg text-xs font-bold transition duration-200 ${isStatus2}">
                                            Selesai
                                        </button>
                                    </div>
                                    <input type="hidden" id="status-${aduan.id}" value="${aduan.status}">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Pilih Pemenang</label>
                                    <div class="grid grid-cols-2 gap-2">
                                        <button onclick="updateResult(${aduan.id}, 'kiri')" id="btn-kiri-${aduan.id}"
                                            ${aduan.pemenang === 'kiri' ? 'data-winner="kiri"' : ''}
                                            class="py-2.5 rounded-xl font-bold text-xs transition duration-200 flex items-center justify-center gap-1.5 ${aduan.pemenang === 'kiri' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-blue-50 text-blue-700 hover:bg-blue-100'}">
                                            <i class="fas fa-trophy ${aduan.pemenang === 'kiri' ? 'text-amber-300' : 'text-blue-400'}"></i> Menang Kiri
                                        </button>
                                        <button onclick="updateResult(${aduan.id}, 'kanan')" id="btn-kanan-${aduan.id}"
                                            ${aduan.pemenang === 'kanan' ? 'data-winner="kanan"' : ''}
                                            class="py-2.5 rounded-xl font-bold text-xs transition duration-200 flex items-center justify-center gap-1.5 ${aduan.pemenang === 'kanan' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-red-50 text-red-700 hover:bg-red-100'}">
                                            <i class="fas fa-trophy ${aduan.pemenang === 'kanan' ? 'text-amber-300' : 'text-red-400'}"></i> Menang Kanan
                                        </button>
                                    </div>
                                    <button onclick="clearWinner(${aduan.id})" 
                                        class="w-full mt-2 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-xs font-semibold transition duration-150">
                                        Belum Ada Pemenang
                                    </button>
                                </div>

                                <button onclick="saveResult(${aduan.id})" 
                                    class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 active:scale-98 text-white rounded-xl font-bold text-sm flex items-center justify-center gap-2 shadow-sm transition">
                                    <i class="fas fa-check-circle"></i> Simpan Hasil
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        document.getElementById('filterInput').addEventListener('keyup', filterResults);

        function changeStatusInline(aduanId, statusValue) {
            document.getElementById(`status-${aduanId}`).value = statusValue;

            const btn0 = document.getElementById(`btn-status-0-${aduanId}`);
            const btn1 = document.getElementById(`btn-status-1-${aduanId}`);
            const btn2 = document.getElementById(`btn-status-2-${aduanId}`);

            // Reset class dasar
            btn0.className = "flex-1 py-2 rounded-lg text-xs font-bold transition duration-200 text-gray-500 hover:bg-gray-200/50";
            btn1.className = "flex-1 py-2 rounded-lg text-xs font-bold transition duration-200 text-gray-500 hover:bg-amber-100/50";
            btn2.className = "flex-1 py-2 rounded-lg text-xs font-bold transition duration-200 text-gray-500 hover:bg-indigo-100/50";

            // Pasang class aktif
            if (statusValue === 0) {
                btn0.className = "flex-1 py-2 rounded-lg text-xs font-bold transition duration-200 bg-white text-gray-800 shadow-sm border border-gray-200";
            } else if (statusValue === 1) {
                btn1.className = "flex-1 py-2 rounded-lg text-xs font-bold transition duration-200 bg-amber-500 text-white shadow-sm";
            } else if (statusValue === 2) {
                btn2.className = "flex-1 py-2 rounded-lg text-xs font-bold transition duration-200 bg-indigo-600 text-white shadow-sm";
            }
        }

        async function updateResult(aduanId, pemenang) {
            // Otomatis geser status pertandingan ke 'Selesai' (2) saat tombol pemenang ditekan
            changeStatusInline(aduanId, 2); 
            
            const btnKiri = document.getElementById(`btn-kiri-${aduanId}`);
            const btnKanan = document.getElementById(`btn-kanan-${aduanId}`);

            // Kembalikan ke desain tidak aktif asal
            btnKiri.className = "py-2.5 rounded-xl font-bold text-xs transition duration-200 flex items-center justify-center gap-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100";
            btnKanan.className = "py-2.5 rounded-xl font-bold text-xs transition duration-200 flex items-center justify-center gap-1.5 bg-red-50 text-red-700 hover:bg-red-100";

            const trophyIcon = '<i class="fas fa-trophy text-amber-300"></i>';
            
            if (pemenang === 'kiri') {
                btnKiri.className = "py-2.5 rounded-xl font-bold text-xs transition duration-200 flex items-center justify-center gap-1.5 bg-emerald-600 text-white shadow-sm";
                btnKiri.setAttribute('data-winner', 'kiri');
                btnKanan.removeAttribute('data-winner');
                
                btnKiri.innerHTML = `${trophyIcon} Menang Kiri`;
                btnKanan.innerHTML = '<i class="fas fa-trophy text-red-400"></i> Menang Kanan';
            } else {
                btnKanan.className = "py-2.5 rounded-xl font-bold text-xs transition duration-200 flex items-center justify-center gap-1.5 bg-emerald-600 text-white shadow-sm";
                btnKanan.setAttribute('data-winner', 'kanan');
                btnKiri.removeAttribute('data-winner');
                
                btnKanan.innerHTML = `${trophyIcon} Menang Kanan`;
                btnKiri.innerHTML = '<i class="fas fa-trophy text-blue-400"></i> Menang Kiri';
            }
        }

        async function clearWinner(aduanId) {
            const btnKiri = document.getElementById(`btn-kiri-${aduanId}`);
            const btnKanan = document.getElementById(`btn-kanan-${aduanId}`);
            
            btnKiri.className = "py-2.5 rounded-xl font-bold text-xs transition duration-200 flex items-center justify-center gap-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100";
            btnKanan.className = "py-2.5 rounded-xl font-bold text-xs transition duration-200 flex items-center justify-center gap-1.5 bg-red-50 text-red-700 hover:bg-red-100";
            
            btnKiri.innerHTML = '<i class="fas fa-trophy text-blue-400"></i> Menang Kiri';
            btnKanan.innerHTML = '<i class="fas fa-trophy text-red-400"></i> Menang Kanan';
            
            btnKiri.removeAttribute('data-winner');
            btnKanan.removeAttribute('data-winner');
        }

        async function saveResult(aduanId) {
            const status = document.getElementById(`status-${aduanId}`).value;
            const btnKiri = document.getElementById(`btn-kiri-${aduanId}`);
            const btnKanan = document.getElementById(`btn-kanan-${aduanId}`);
            
            let pemenang = null;
            if (btnKiri.hasAttribute('data-winner')) pemenang = 'kiri';
            if (btnKanan.hasAttribute('data-winner')) pemenang = 'kanan';

            const baseRoute = "{{ route('api.aduan.update', ['id' => 'REPLACE_ID']) }}";
            const finalUrl = baseRoute.replace('REPLACE_ID', aduanId);

            try {
                const response = await fetch(finalUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: parseInt(status),
                        pemenang: pemenang
                    })
                });

                if (response.ok) {
                    alert('Hasil berhasil disimpan');
                    loadResults();
                } else {
                    alert('Gagal menyimpan hasil');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            }
        }

        // Jalankan fetch awal
        loadResults();

        // Auto-refresh data tiap 5 detik
        setInterval(loadResults, 5000);
    </script>
</x-app-layout>