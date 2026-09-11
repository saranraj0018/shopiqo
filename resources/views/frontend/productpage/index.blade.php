
<section class="relative bg-black text-white pt-[9rem] pb-0 px-4 sm:px-6 lg:px-8 overflow-hidden">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute left-0 top-0 h-[300px] w-[300px] rounded-full bg-white/5 blur-3xl"></div>
        <div class="absolute right-0 bottom-0 h-[280px] w-[280px] rounded-full bg-white/5 blur-3xl"></div>
    </div>

    <div class="relative z-10 max-w-[60rem] mx-auto">
        <div class="text-center text-[13px] text-white/70 mb-8">
            @if(Request::segment(1))
            <span class="text-white capitalize">
                {{ Request::segment(1) }}
            </span>
            @endif
            @if(Request::segment(2))
            <span class="mx-1">/</span>
            <span class="text-white capitalize">
                {{ Request::segment(2) }}
            </span>
            @endif
        </div>

        <div class="flex flex-col xl:flex-row gap-[30px]">
<div class="relative flex flex-col xl:flex-row gap-[20px] w-full xl:w-[50%]">

    <!-- Desktop Thumbnails -->
    <div
        class="hidden xl:flex flex-col gap-4 overflow-y-auto hide-scrollbar w-[90px] h-[350px]">
        @foreach($product->product_gallery_image as $index => $img)
        <button
            onclick="changeMainImage('{{ asset('storage/' . $img->image_path) }}', this)"
            class="thumb-btn border-2 rounded-[10px] {{ $index === 0 ? 'border-black' : 'border-transparent' }}">
            <img
                src="{{ asset('storage/' . $img->image_path) }}"
                class="w-full h-[80px] object-cover rounded-[10px]">
        </button>
        @endforeach
    </div>

    <!-- Main Image -->
    <div class="relative flex-1 w-full h-[300px] xl:h-[350px]">

        <!-- Heart Button -->
        <button
            class="heart-btn absolute top-4 right-4 w-9 h-9 rounded-full bg-black/80 text-white flex items-center justify-center shadow z-10"
            data-product-id="{{ $product->id }}" data-liked="{{ $isWishlisted ? 'true' : 'false' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current transition" viewBox="0 0 24 24">
                <path
                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                    fill="{{ $isWishlisted ? 'red' : 'white' }}" />
            </svg>
        </button>

        <img
            id="mainProductImage"
            src="{{ asset('storage/' . $product->main_image) }}"
            class="w-full h-full object-cover rounded-[12px]">

        <!-- Logo placement overlay: appears once a design is uploaded, draggable to any spot -->
        <div id="logoPlacementOverlay"
            class="hidden absolute z-20 w-16 h-16 -translate-x-1/2 -translate-y-1/2 cursor-move touch-none select-none"
            style="left: 50%; top: 35%;">
            <div class="relative w-full h-full rounded-md ring-2 ring-white shadow-lg bg-white/20 backdrop-blur-sm overflow-hidden">
                <img id="logoPlacementImg" src="" alt="Logo placement preview"
                    class="w-full h-full object-contain p-1 pointer-events-none">
            </div>
            <span class="absolute -bottom-5 left-1/2 -translate-x-1/2 text-[9px] text-white bg-black/70 px-1.5 py-0.5 rounded whitespace-nowrap pointer-events-none">
                Drag to adjust
            </span>
        </div>
    </div>

    <!-- Mobile Thumbnails -->
    <div
        class="flex xl:hidden gap-4 overflow-x-auto hide-scrollbar w-full pt-2">
        @foreach($product->product_gallery_image as $index => $img)
        <button
            onclick="changeMainImage('{{ asset('storage/' . $img->image_path) }}', this)"
            class="thumb-btn min-w-[70px] border-2 rounded-[10px] overflow-hidden {{ $index === 0 ? 'border-black' : 'border-transparent' }}">
            <img
                src="{{ asset('storage/' . $img->image_path) }}"
                class="w-[70px] h-[70px] object-cover">
        </button>
        @endforeach
    </div>

</div>
            <div class="w-full sm:w-[50%] p-[15px] sm:p-0">
                <h1 class="text-[22px] sm:text-[28px] font-medium">
                    {{ $product->name }}
                </h1>
                <div class="flex items-end gap-2 mt-2">
                    @if ($displayPrice)
                    <span class="text-[26px] font-semibold">₹{{ number_format($displayPrice, 2) }}</span>
                    <span class="text-[13px] text-white/70 pb-[4px]">/piece</span>
                    @else
                    <span class="text-[18px] font-semibold text-white/70">Contact us for pricing</span>
                    @endif
                    @if ($reviewStats['count'] > 0)
                    <span class="text-[13px] text-white/60 pb-[4px]">
                        <i class="fa-solid fa-star text-yellow-400 text-[11px]"></i>
                        {{ $reviewStats['average'] }} ({{ $reviewStats['count'] }})
                    </span>
                    @endif
                </div>

                @if ($variantMatrix)
                <div class="mt-6 space-y-4">
                    @if ($variantMatrix['cols']->first()->id !== 'default')
                    <div>
                        <p class="text-[11px] text-white/80 mb-3">Available Colors</p>
                        <div class="flex flex-wrap gap-3">
                            @foreach ($variantMatrix['cols'] as $color)
                            <div class="flex flex-col items-center gap-1">
                                <span class="w-7 h-7 rounded-full border border-white/40"
                                    style="background-color: {{ str_replace(' ', '', strtolower($color->value)) }}"
                                    title="{{ $color->value }}"></span>
                                <span class="text-[9px] text-white/50 lowercase">{{ $color->value }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div>
                        <p class="text-[11px] text-white/80 mb-3">Available Sizes</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($variantMatrix['rows'] as $size)
                            <span class="px-3 py-1 rounded-full border border-white/30 text-[11px] text-white uppercase">
                                {{ $size->value }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <div class="mt-8">
                    <p class="text-[12px] mb-3 text-white/90">Upload Your Design/Logo*</p>

                    <div id="logoDropzone"
                        class="group relative flex flex-col items-center justify-center h-[120px] w-full sm:w-[80%] rounded-xl border border-dashed border-white/30 bg-white/[0.02] cursor-pointer transition-all duration-300 hover:bg-white/[0.05] hover:border-white/50">

                        <!-- Idle state -->
                        <div id="logoDropzoneIdle" class="flex flex-col items-center justify-center pointer-events-none px-4 text-center">
                            <div class="mb-2 flex items-center justify-center w-10 h-10 rounded-full bg-white/10 group-hover:bg-white/20 transition">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 text-white/70 group-hover:text-white transition" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16l4-4a3 3 0 014 0l4 4m0 0l4-4M12 12V4m0 0l-3 3m3-3l3 3" />
                                </svg>
                            </div>
                            <p class="text-[12px] text-white/40 group-hover:text-white/70 transition">
                                Drop Design here or click to upload
                            </p>
                            <p class="text-[10px] text-white/25 mt-1">PNG, JPG or SVG, up to 5MB</p>
                        </div>

                        <!-- Selected-file preview -->
                        <div id="logoDropzonePreview" class="hidden absolute inset-0 flex items-center gap-3 p-3">
                            <img id="logoPreviewImg" class="h-full aspect-square object-contain rounded-lg bg-white/5" alt="Uploaded logo preview">
                            <div class="flex-1 min-w-0 text-left">
                                <p id="logoFileName" class="text-[12px] text-white truncate"></p>
                                <p id="logoFileSize" class="text-[10px] text-white/40"></p>
                            </div>
                            <button type="button" id="logoRemoveBtn"
                                class="shrink-0 w-7 h-7 rounded-full bg-white/10 hover:bg-white/20 text-white/70 hover:text-white flex items-center justify-center transition">
                                <i class="fa-solid fa-xmark text-[12px]"></i>
                            </button>
                        </div>

                        <input type="file" id="logoFileInput" name="design_logo" class="hidden"
                            accept="image/png,image/jpeg,image/svg+xml">
                    </div>
                    <p id="logoError" class="text-[11px] text-red-400 mt-2 hidden"></p>
                </div>

                <!-- SIDE -->
                <div class="mt-5 w-[80%]">
                    <p class="text-[12px] mb-2">Side</p>

                    <div class="flex gap-3" id="logoSideGroup">
                        <button type="button" data-side="front"
                            class="logo-side-btn is-active px-6 h-[34px] bg-white text-black rounded text-[12px] transition">Front</button>
                        <button type="button" data-side="back"
                            class="logo-side-btn px-6 h-[34px] bg-white/10 text-white rounded text-[12px] transition">Back</button>
                        <button type="button" data-side="both"
                            class="logo-side-btn px-6 h-[34px] bg-white/10 text-white rounded text-[12px] transition">Both</button>
                    </div>
                </div>

                <!-- LOGO PLACEMENT -->
                <div class="mt-5 w-[80%]">
                    <p class="text-[12px] mb-2">Logo Placement</p>

                    <div class="flex flex-wrap gap-3" id="logoPositionGroup">
                        <button type="button" data-x="20" data-y="30"
                            class="logo-position-btn px-4 h-[34px] bg-white/10 text-white rounded text-[12px] transition">Left</button>
                        <button type="button" data-x="50" data-y="30"
                            class="logo-position-btn is-active px-4 h-[34px] bg-white text-black rounded text-[12px] transition">Center</button>
                        <button type="button" data-x="80" data-y="30"
                            class="logo-position-btn px-4 h-[34px] bg-white/10 text-white rounded text-[12px] transition">Right</button>
                    </div>
                    <p class="text-[10px] text-white/40 mt-2">
                        Pick a side and a preset above, or drag the logo directly on the product photo to fine-tune the exact spot.
                    </p>
                </div>

                <input type="hidden" id="logoSideInput" name="logo_side" value="front">
                <input type="hidden" id="logoPosXInput" name="logo_position_x" value="50">
                <input type="hidden" id="logoPosYInput" name="logo_position_y" value="30">

                <!-- PRINT TYPE -->
                <div class="mt-5 w-[80%]">
                    <p class="text-[12px] mb-2 text-white">Print Type</p>

                    <select
                        class="w-full h-[40px] bg-black border border-white/20 rounded px-4 text-[12px] text-white outline-none">
                        @foreach ($printTypes as $type)
                        <option class="bg-black text-white">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- TABLE -->
                @if ($variantMatrix && $variantMatrix['type'] === 'bulk')
                <div class="mt-7 border border-white/10 rounded-xl overflow-hidden w-[70%]">
                    <table class="w-full text-[12px]">
                        <thead class="border-b border-white/10">
                            <tr>
                                <th class="p-3 text-left">Quantity</th>
                                <th class="p-3 text-left border-l border-white/10">Price</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($variantMatrix['tiers'] as $tier)
                            <tr class="border-b border-white/10">
                                <td class="p-3">{{ $tier['minimum'] }}-{{ $tier['maximum'] }}</td>
                                <td class="p-3 border-l border-white/10">
                                    {{ $tier['price'] ? '₹' . number_format($tier['price'], 2) : 'Get a Quote' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

            </div>

        </div>

    </div>

    <style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    </style>

</section>

@include('frontend.components.product_script')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const dropzone   = document.getElementById('logoDropzone');
    const fileInput  = document.getElementById('logoFileInput');
    const idleState  = document.getElementById('logoDropzoneIdle');
    const preview    = document.getElementById('logoDropzonePreview');
    const previewImg = document.getElementById('logoPreviewImg');
    const fileName   = document.getElementById('logoFileName');
    const fileSize   = document.getElementById('logoFileSize');
    const removeBtn  = document.getElementById('logoRemoveBtn');
    const errorEl    = document.getElementById('logoError');
    if (!dropzone) return;

    /* ============================================================
       LOGO PLACEMENT — position the uploaded logo on the product photo
    ============================================================ */
    const placementContainer = document.getElementById('mainProductImage')
        ? document.getElementById('mainProductImage').parentElement
        : null;
    const overlay      = document.getElementById('logoPlacementOverlay');
    const overlayImg    = document.getElementById('logoPlacementImg');
    const sideGroup     = document.getElementById('logoSideGroup');
    const positionGroup = document.getElementById('logoPositionGroup');
    const sideInput  = document.getElementById('logoSideInput');
    const posXInput  = document.getElementById('logoPosXInput');
    const posYInput  = document.getElementById('logoPosYInput');

    // Keep the overlay a little inside the edges so it never hangs off the photo.
    const BOUNDS = { minX: 8, maxX: 92, minY: 10, maxY: 88 };

    function setOverlayPosition(xPercent, yPercent) {
        const x = Math.min(BOUNDS.maxX, Math.max(BOUNDS.minX, xPercent));
        const y = Math.min(BOUNDS.maxY, Math.max(BOUNDS.minY, yPercent));
        overlay.style.left = x + '%';
        overlay.style.top = y + '%';
        posXInput.value = Math.round(x);
        posYInput.value = Math.round(y);
    }

    function setActiveButton(group, btn) {
        group.querySelectorAll('button').forEach(function (b) {
            b.classList.remove('is-active', 'bg-white', 'text-black');
            b.classList.add('bg-white/10', 'text-white');
        });
        btn.classList.add('is-active', 'bg-white', 'text-black');
        btn.classList.remove('bg-white/10', 'text-white');
    }

    if (sideGroup) {
        sideGroup.addEventListener('click', function (e) {
            const btn = e.target.closest('.logo-side-btn');
            if (!btn) return;
            setActiveButton(sideGroup, btn);
            sideInput.value = btn.dataset.side;
        });
    }

    if (positionGroup) {
        positionGroup.addEventListener('click', function (e) {
            const btn = e.target.closest('.logo-position-btn');
            if (!btn) return;
            setActiveButton(positionGroup, btn);
            setOverlayPosition(parseFloat(btn.dataset.x), parseFloat(btn.dataset.y));
        });
    }

    // Drag the overlay directly on the product photo to fine-tune the spot.
    if (overlay && placementContainer) {
        let dragging = false;

        overlay.addEventListener('pointerdown', function (e) {
            dragging = true;
            overlay.setPointerCapture(e.pointerId);
        });

        overlay.addEventListener('pointermove', function (e) {
            if (!dragging) return;
            const rect = placementContainer.getBoundingClientRect();
            const xPercent = ((e.clientX - rect.left) / rect.width) * 100;
            const yPercent = ((e.clientY - rect.top) / rect.height) * 100;
            setOverlayPosition(xPercent, yPercent);

            // A manual drag no longer matches any preset button.
            if (positionGroup) {
                positionGroup.querySelectorAll('button').forEach(function (b) {
                    b.classList.remove('is-active', 'bg-white', 'text-black');
                    b.classList.add('bg-white/10', 'text-white');
                });
            }
        });

        ['pointerup', 'pointercancel'].forEach(function (evt) {
            overlay.addEventListener(evt, function () {
                dragging = false;
            });
        });
    }

    const ALLOWED_TYPES = ['image/png', 'image/jpeg', 'image/svg+xml'];
    const MAX_SIZE = 5 * 1024 * 1024; // 5MB

    function showError(message) {
        errorEl.textContent = message;
        errorEl.classList.remove('hidden');
    }

    function clearError() {
        errorEl.textContent = '';
        errorEl.classList.add('hidden');
    }

    function formatSize(bytes) {
        return bytes < 1024 * 1024
            ? Math.round(bytes / 1024) + ' KB'
            : (bytes / (1024 * 1024)).toFixed(1) + ' MB';
    }

    function acceptFile(file) {
        clearError();

        if (!ALLOWED_TYPES.includes(file.type)) {
            showError('Please upload a PNG, JPG or SVG file.');
            resetDropzone();
            return;
        }
        if (file.size > MAX_SIZE) {
            showError('File is too large — max size is 5MB.');
            resetDropzone();
            return;
        }

        // Keep the input's FileList in sync so this works whether the file
        // came from the native picker or a drag-and-drop drop event.
        const dt = new DataTransfer();
        dt.items.add(file);
        fileInput.files = dt.files;

        const reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src = e.target.result;
            fileName.textContent = file.name;
            fileSize.textContent = formatSize(file.size);
            idleState.classList.add('hidden');
            preview.classList.remove('hidden');

            // Mirror the logo onto the placement overlay so it can be positioned.
            if (overlay && overlayImg) {
                overlayImg.src = e.target.result;
                overlay.classList.remove('hidden');
            }
        };
        reader.readAsDataURL(file);
    }

    function resetDropzone() {
        fileInput.value = '';
        previewImg.src = '';
        preview.classList.add('hidden');
        idleState.classList.remove('hidden');

        if (overlay && overlayImg) {
            overlay.classList.add('hidden');
            overlayImg.src = '';
        }
    }

    // Click anywhere on the dropzone (except the remove button) opens the picker
    dropzone.addEventListener('click', function () {
        fileInput.click();
    });

    fileInput.addEventListener('change', function () {
        if (this.files && this.files[0]) acceptFile(this.files[0]);
    });

    removeBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        clearError();
        resetDropzone();
    });

    // Drag and drop
    ['dragenter', 'dragover'].forEach(function (evt) {
        dropzone.addEventListener(evt, function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.add('border-white/70', 'bg-white/10');
        });
    });

    ['dragleave', 'dragend'].forEach(function (evt) {
        dropzone.addEventListener(evt, function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.remove('border-white/70', 'bg-white/10');
        });
    });

    dropzone.addEventListener('drop', function (e) {
        e.preventDefault();
        e.stopPropagation();
        dropzone.classList.remove('border-white/70', 'bg-white/10');

        const file = e.dataTransfer.files && e.dataTransfer.files[0];
        if (file) acceptFile(file);
    });
});
</script>
