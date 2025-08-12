@vite('resources/js/app.js')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

<script>
    // kiriman dari controller
    window.riwayatPratinjau = @json($riwayatPratinjau ?? []);
</script>

<x-layout>
    <div x-data="designer()" x-init="init()">
        <div class="flex">
            <!-- Sidebar -->
            <div class="bg-white w-40 py-8 flex flex-col items-center gap-8 rounded-l-2xl border border-gray-200">
                <button @click="tab = 'produk'" :class="{ 'font-bold text-black': tab === 'produk' }"
                    class="flex flex-col items-center gap-1 focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 4l4-2h8l4 2v2a2 2 0 01-2 2v12a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 01-2-2V4z" />
                    </svg>
                    <span>Jenis Produk</span>
                </button>
                <button @click="tab = 'warna'" :class="{ 'font-bold text-black': tab === 'warna' }"
                    class="flex flex-col items-center gap-1 focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <circle cx="7.5" cy="10.5" r="1.5" />
                        <circle cx="16.5" cy="10.5" r="1.5" />
                        <circle cx="12" cy="16.5" r="1.5" />
                    </svg>
                    <span>Warna</span>
                </button>
                <button @click="tab = 'unggah'" :class="{ 'font-bold text-black': tab === 'unggah' }"
                    class="flex flex-col items-center gap-1 focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M16 16v-4a4 4 0 00-8 0v4" />
                        <path d="M12 12v6m0 0l-3-3m3 3l3-3" />
                        <path d="M20 16.58A5 5 0 0018 7h-1.26A8 8 0 104 15.25" />
                    </svg>
                    <span>Unggah</span>
                </button>
                <button @click="tab = 'teks'" :class="{ 'font-bold text-black': tab === 'teks' }"
                    class="flex flex-col items-center gap-1 focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <text x="2" y="20" font-size="20" font-family="Arial" fill="black">Aa</text>
                    </svg>
                    <span>Teks</span>
                </button>
            </div>

            <!-- Main -->
            <div class="flex-1 flex flex-col items-center justify-center bg-gray-100 rounded-r-2xl p-8">
                <!-- Preview -->
                <div id="preview-area"
                    class="relative w-96 h-[500px] flex items-center justify-center rounded-xl shadow mb-6 overflow-hidden [isolation:isolate]">
                    <!-- BASE PNG (tekstur/garis kaos) -->
                    <img x-ref="baseImg" :src="baseSrc" alt="Base"
                        class="absolute inset-0 w-full h-full object-contain select-none pointer-events-none" />

                    <!-- OVERLAY WARNA DIMASK KE BENTUK PRODUK -->
                    <div class="absolute inset-0 pointer-events-none" :style="colorMaskStyle"></div>
                    <!-- Optional: highlight tipis biar tekstur makin muncul -->
                    <div class="absolute inset-0 pointer-events-none" :style="highlightMaskStyle"></div>

                    <!-- Upload PNG/JPG -->
                    <template x-if="uploadedImage">
                        <div class="absolute z-20"
                            :style="`
                                                                                                                                                left: calc(50% + ${uploadedX}px);
                                                                                                                                                top: calc(50% + ${uploadedY}px);
                                                                                                                                                width: ${uploadedWidth}px;
                                                                                                                                                height: ${uploadedHeight}px;
                                                                                                                                                transform: translate(-50%, -50%) rotate(${uploadedRotate}deg);
                                                                                                                                            `"
                            @mousedown.prevent="dragging = true; dragOffsetX = $event.clientX - uploadedX; dragOffsetY = $event.clientY - uploadedY;"
                            @touchstart.prevent="dragging = true; dragOffsetX = $event.touches[0].clientX - uploadedX; dragOffsetY = $event.touches[0].clientY - uploadedY;">
                            <img :src="uploadedImage" alt="Upload" class="w-full h-full object-contain cursor-move"
                                draggable="false" style="pointer-events:none;" />
                            <!-- resize handle -->
                            <div class="absolute right-0 bottom-0 w-6 h-6 bg-white rounded-full border border-gray-300 flex items-center justify-center cursor-se-resize z-30"
                                @mousedown.prevent="resizing = true; resizeStartX = $event.clientX; resizeStartY = $event.clientY; resizeStartWidth = uploadedWidth; resizeStartHeight = uploadedHeight;"
                                @touchstart.prevent="resizing = true; resizeStartX = $event.touches[0].clientX; resizeStartY = $event.touches[0].clientY; resizeStartWidth = uploadedWidth; resizeStartHeight = uploadedHeight;">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M15 19h4v-4" />
                                    <path d="M19 19l-6-6" />
                                </svg>
                            </div>
                            <!-- delete -->
                            <button
                                class="absolute left-0 top-0 w-6 h-6 bg-white rounded-full border border-gray-300 flex items-center justify-center z-30"
                                @click="uploadedImage = null" type="button">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M6 6l12 12M6 18L18 6" />
                                </svg>
                            </button>
                        </div>
                    </template>

                    <!-- Teks -->
                    <template x-if="previewText">
                        <div class="absolute z-30 select-none"
                            :style="`
                                                                                                                                                left: calc(50% + ${textX}px);
                                                                                                                                                top: calc(70% + ${textY}px);
                                                                                                                                                width: ${textWidth}px;
                                                                                                                                                height: ${textHeight}px;
                                                                                                                                                transform: translate(-50%, -50%) rotate(${textRotate}deg);
                                                                                                                                            `"
                            @mousedown.prevent="textDragging = true; textDragOffsetX = $event.clientX - textX; textDragOffsetY = $event.clientY - textY;"
                            @touchstart.prevent="textDragging = true; textDragOffsetX = $event.touches[0].clientX - textX; textDragOffsetY = $event.touches[0].clientY - textY;">
                            <div class="w-full h-full flex items-center justify-center cursor-pointer"
                                @dblclick="textEditing = true">
                                <template x-if="!textEditing">
                                    <span class="font-bold text-center break-words"
                                        :style="`font-size:${textFontSize}px;color:${textColor};`"
                                        x-text="previewText"></span>
                                </template>
                                <template x-if="textEditing">
                                    <input type="text" x-model="previewText" @blur="textEditing = false"
                                        class="w-full h-full text-center font-bold text-black bg-white/80 border border-blue-400 rounded"
                                        autofocus />
                                </template>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Controls -->
                <div class="flex flex-col items-center gap-2 mb-4" x-show="uploadedImage">
                    <label class="text-sm">Rotasi Gambar: <span x-text="uploadedRotate"></span>°</label>
                    <input type="range" min="-180" max="180" step="1" x-model="uploadedRotate"
                        class="w-64">
                </div>

                <div class="flex flex-col items-center gap-2 mb-4" x-show="previewText">
                    <label class="text-sm">Rotasi Teks: <span x-text="textRotate"></span>°</label>
                    <input type="range" min="-180" max="180" step="1" x-model="textRotate"
                        class="w-64">
                    <div class="flex items-center gap-4 mt-3">
                        <button type="button" @click="textFontSize = Math.max(8, textFontSize - 2)"
                            class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-2xl font-bold shadow hover:bg-gray-300">-</button>
                        <span class="text-base font-semibold">Ukuran: <span x-text="textFontSize"></span></span>
                        <button type="button" @click="textFontSize = Math.min(120, textFontSize + 2)"
                            class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-2xl font-bold shadow hover:bg-gray-300">+</button>
                    </div>
                </div>

                <!-- Form -->
                <div class="w-full max-w-md">
                    <div x-show="tab === 'produk'">
                        <label class="block mb-2 font-semibold">Jenis Produk</label>
                        <select x-model="produk" class="block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="kaos">Kaos</option>
                            <option value="kemeja">Kemeja</option>
                            <option value="hoodie">Hoodie</option>
                            <option value="jaket">Jaket</option>
                            <option value="almamater">Almamater</option>
                        </select>
                    </div>

                    <div x-show="tab === 'warna'">
                        <label class="block mb-2 font-semibold">Pilih Warna Produk</label>
                    </div>

                    @if (isset($warnaBahan))
                        <div x-show="tab === 'warna'">
                            @foreach ($warnaBahan as $bahan => $warnas)
                                <div class="mb-2">
                                    <div class="font-semibold text-sm mb-1">{{ $bahan }}</div>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($warnas as $warna)
                                            <div class="text-center cursor-pointer"
                                                x-on:click="previewColor = '{{ $warna['hex'] }}'">
                                                <div class="w-8 h-8 rounded-full border border-gray-300 inline-block mb-1"
                                                    style="background: {{ $warna['hex'] }}"></div>
                                                <div class="text-[10px]">{{ $warna['nama'] }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div x-show="tab === 'warna'">
                            <input type="color" x-model="previewColor"
                                class="h-10 w-20 border-none p-0 bg-transparent" />
                        </div>
                    @endif

                    <div x-show="tab === 'unggah'">
                        <label class="block mb-2 font-semibold">Upload Gambar</label>
                        <input type="file" @change="updateImage($event)" class="block w-full" accept="image/*" />
                    </div>

                    <div x-show="tab === 'teks'">
                        <label class="block mb-2 font-semibold">Teks Custom</label>
                        <input type="text" x-model="previewText" class="block w-full border rounded px-3 py-2"
                            placeholder="Masukkan teks..." />
                        <label class="block mt-4 mb-1 font-semibold">Warna Teks</label>
                        <input type="color" x-model="textColor" class="h-10 w-20 border-none p-0 bg-transparent" />
                    </div>

                    <button type="button" @click="downloadPreview"
                        class="mt-6 px-8 py-2 rounded-md bg-[#1e335f] text-white font-semibold hover:bg-[#162547] transition">
                        Submit & Download
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function designer() {
            const STORAGE_BASE = @js(asset('storage'));

            return {
                // UI state
                tab: 'produk',
                produk: 'kaos',
                previewColor: '#00bcd4',

                // base png sesuai struktur public/img/*-default.png
                baseMap: {
                    kaos: @js(asset('img/kaos-default.png')),
                    kemeja: @js(asset('img/kemeja-default.png')),
                    hoodie: @js(asset('img/hoodie-default.png')),
                    jaket: @js(asset('img/jaket-default.png')),
                    almamater: @js(asset('img/almamater-default.png')),
                },

                baseSrc: @js(asset('img/kaos-default.png')),

                // upload & text state
                uploadedImage: null,
                uploadedX: 0,
                uploadedY: 0,
                uploadedWidth: 128,
                uploadedHeight: 128,
                uploadedRotate: 0,
                dragging: false,
                resizing: false,
                dragOffsetX: 0,
                dragOffsetY: 0,
                resizeStartX: 0,
                resizeStartY: 0,
                resizeStartWidth: 128,
                resizeStartHeight: 128,

                previewText: '',
                textX: 0,
                textY: 0,
                textRotate: 0,
                textEditing: false,
                textWidth: 120,
                textHeight: 32,
                textResizing: false,
                textResizeStartX: 0,
                textResizeStartY: 0,
                textResizeStartWidth: 120,
                textResizeStartHeight: 32,
                textDragging: false,
                textDragOffsetX: 0,
                textDragOffsetY: 0,
                textFontSize: 24,
                textColor: '#000000',

                riwayatPratinjau: window.riwayatPratinjau || [],

                // ======== MASK STYLES (biar background gak ikut ketint) ========
                get colorMaskStyle() {
                    const src = this.baseSrc;
                    return `
                        background:${this.previewColor};
                        /* clip warna ke bentuk produk */
                        -webkit-mask-image:url('${src}');
                        mask-image:url('${src}');
                        -webkit-mask-repeat:no-repeat; mask-repeat:no-repeat;
                        -webkit-mask-position:center; mask-position:center;
                        -webkit-mask-size:contain; mask-size:contain;
                        mix-blend-mode:multiply;
                        opacity:.9;
                    `;
                },
                get highlightMaskStyle() {
                    const src = this.baseSrc;
                    return `
                        background:white;
                        -webkit-mask-image:url('${src}');
                        mask-image:url('${src}');
                        -webkit-mask-repeat:no-repeat; mask-repeat:no-repeat;
                        -webkit-mask-position:center; mask-position:center;
                        -webkit-mask-size:contain; mask-size:contain;
                        mix-blend-mode:screen;
                        opacity:.15;
                    `;
                },
                // ================================================================

                get filteredRiwayat() {
                    return this.riwayatPratinjau.filter(i => i.jenis_produk === this.produk);
                },

                setPreviewFromRiwayat() {
                    if (this.filteredRiwayat.length > 0) {
                        const foto = this.filteredRiwayat[0].foto_pratinjau; // relatif dari storage
                        this.uploadedImage = `${STORAGE_BASE}/${foto}`;
                    } else {
                        this.uploadedImage = null;
                    }
                },

                updateImage(e) {
                    const file = e.target.files?.[0];
                    if (!file) return;
                    this.uploadedImage = URL.createObjectURL(file);
                },

                async downloadPreview() {
                    const preview = document.getElementById('preview-area');
                    const rect = preview.getBoundingClientRect();

                    const scale = 2; // kualitas export
                    const W = Math.round(rect.width * scale);
                    const H = Math.round(rect.height * scale);

                    const canvas = document.createElement('canvas');
                    canvas.width = W;
                    canvas.height = H;
                    const ctx = canvas.getContext('2d');

                    // 1) BASE
                    const base = await this.loadImg(this.baseSrc, true);
                    const dest = this.getContainRect(W, H, base.naturalWidth, base.naturalHeight);

                    // buat layer warna dari base (pakai alpha base)
                    const tint = document.createElement('canvas');
                    tint.width = dest.w;
                    tint.height = dest.h;
                    const tctx = tint.getContext('2d');
                    tctx.drawImage(base, 0, 0, dest.w, dest.h);
                    tctx.globalCompositeOperation = 'source-in';
                    tctx.fillStyle = this.previewColor;
                    tctx.fillRect(0, 0, dest.w, dest.h);

                    // gambar ke kanvas final: warna dulu, lalu shading base (multiply)
                    ctx.drawImage(tint, dest.x, dest.y);
                    ctx.globalCompositeOperation = 'multiply';
                    ctx.drawImage(base, dest.x, dest.y, dest.w, dest.h);
                    ctx.globalCompositeOperation = 'source-over';

                    // 2) GAMBAR UPLOAD (jika ada)
                    if (this.uploadedImage) {
                        const up = await this.loadImg(this.uploadedImage, false); // blob: gak perlu CORS
                        const w = this.uploadedWidth * scale;
                        const h = this.uploadedHeight * scale;
                        const cx = W / 2 + this.uploadedX * scale;
                        const cy = H / 2 + this.uploadedY * scale;
                        ctx.save();
                        ctx.translate(cx, cy);
                        ctx.rotate(this.uploadedRotate * Math.PI / 180);
                        ctx.drawImage(up, -w / 2, -h / 2, w, h);
                        ctx.restore();
                    }

                    // 3) TEKS (jika ada)
                    if (this.previewText) {
                        ctx.save();
                        ctx.translate(W / 2 + this.textX * scale, H * 0.70 + this.textY * scale);
                        ctx.rotate(this.textRotate * Math.PI / 180);
                        ctx.font = `bold ${Math.round(this.textFontSize * scale)}px Arial`;
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.fillStyle = this.textColor;
                        ctx.fillText(this.previewText, 0, 0);
                        ctx.restore();
                    }

                    // 4) DOWNLOAD
                    const url = canvas.toDataURL('image/png');
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'desain.png';
                    a.click();
                },

                // helper: load image (asset pakai CORS anon, blob/local tidak)
                loadImg(src, useCors = true) {
                    return new Promise((resolve, reject) => {
                        const img = new Image();
                        if (useCors) img.crossOrigin = 'anonymous';
                        img.onload = () => resolve(img);
                        img.onerror = reject;
                        img.src = src;
                    });
                },

                // helper: hitung "contain" rect
                getContainRect(W, H, iW, iH) {
                    const r = iW / iH,
                        R = W / H;
                    let w, h, x, y;
                    if (r > R) {
                        w = W;
                        h = W / r;
                        x = 0;
                        y = (H - h) / 2;
                    } else {
                        h = H;
                        w = H * r;
                        y = 0;
                        x = (W - w) / 2;
                    }
                    return {
                        x: Math.round(x),
                        y: Math.round(y),
                        w: Math.round(w),
                        h: Math.round(h)
                    };
                },

                preload() {
                    const img = new Image();
                    img.crossOrigin = 'anonymous';
                    img.src = this.baseSrc;
                    img.onload = () => {
                        if (this.$refs.baseImg) this.$refs.baseImg.src = this.baseSrc;
                    };
                    img.onerror = () => console.warn('Base image not found:', this.baseSrc);
                },

                init() {
                    this.preload();

                    // mouse
                    window.addEventListener('mousemove', (e) => {
                        if (this.resizing) {
                            this.uploadedWidth = Math.max(32, this.resizeStartWidth + (e.clientX - this
                                .resizeStartX));
                            this.uploadedHeight = Math.max(32, this.resizeStartHeight + (e.clientY - this
                                .resizeStartY));
                        }
                        if (this.dragging) {
                            this.uploadedX = e.clientX - this.dragOffsetX;
                            this.uploadedY = e.clientY - this.dragOffsetY;
                        }
                        if (this.textDragging) {
                            this.textX = e.clientX - this.textDragOffsetX;
                            this.textY = e.clientY - this.textDragOffsetY;
                        }
                    });
                    window.addEventListener('mouseup', () => {
                        this.resizing = this.dragging = this.textDragging = false;
                    });

                    // touch
                    window.addEventListener('touchmove', (e) => {
                        if (this.resizing) {
                            this.uploadedWidth = Math.max(32, this.resizeStartWidth + (e.touches[0].clientX - this
                                .resizeStartX));
                            this.uploadedHeight = Math.max(32, this.resizeStartHeight + (e.touches[0].clientY - this
                                .resizeStartY));
                        }
                        if (this.dragging) {
                            this.uploadedX = e.touches[0].clientX - this.dragOffsetX;
                            this.uploadedY = e.touches[0].clientY - this.dragOffsetY;
                        }
                        if (this.textDragging) {
                            this.textX = e.touches[0].clientX - this.textDragOffsetX;
                            this.textY = e.touches[0].clientY - this.textDragOffsetY;
                        }
                    }, {
                        passive: false
                    });
                    window.addEventListener('touchend', () => {
                        this.resizing = this.dragging = this.textDragging = false;
                    });

                    // ganti base saat produk berubah
                    this.$watch('produk', (val) => {
                        this.baseSrc = this.baseMap[val] || this.baseMap.kaos;
                        this.preload();
                        this.setPreviewFromRiwayat();
                    });

                    // pertama kali
                    this.setPreviewFromRiwayat();
                },
            }
        }
    </script>
</x-layout>
