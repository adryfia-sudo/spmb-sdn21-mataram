<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="card-title mb-0 fw-bold text-primary">
            <i class="bi bi-geo-alt-fill me-2"></i>Alamat Tempat Tinggal & Lokasi Peta
        </h5>
    </div>

    <div class="card-body">

        {{-- Alamat Lengkap --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
            <textarea 
                class="form-control @error('address') is-invalid @enderror" 
                rows="3" 
                wire:model="address" 
                placeholder="Contoh: Jl. Pendidikan No. 10"></textarea>
            @error('address') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        {{-- Provinsi --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Provinsi</label>
            <input type="text" class="form-control bg-light" value="Nusa Tenggara Barat" readonly>
        </div>

        {{-- Kabupaten / Kota --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Kabupaten / Kota <span class="text-danger">*</span></label>
            <select class="form-select @error('city') is-invalid @enderror" wire:model.live="city">
                <option value="">-- Pilih Kabupaten / Kota --</option>
                @foreach($cities as $cityItem)
                    <option value="{{ $cityItem['code'] }}">{{ $cityItem['name'] }}</option>
                @endforeach
            </select>
            @error('city') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        {{-- Kecamatan --}}
        <div class="mb-3" wire:key="district-container-{{ $city }}">
            <label class="form-label fw-semibold">Kecamatan <span class="text-danger">*</span></label>
            <select class="form-select @error('district') is-invalid @enderror" wire:model.live="district" @disabled(empty($districts))>
                <option value="">-- Pilih Kecamatan --</option>
                @foreach($districts as $districtItem)
                    <option value="{{ $districtItem['code'] }}">{{ $districtItem['name'] }}</option>
                @endforeach
            </select>
            @error('district') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        {{-- Kelurahan / Desa --}}
        <div class="mb-3" wire:key="village-container-{{ $district }}">
            <label class="form-label fw-semibold">Kelurahan / Desa <span class="text-danger">*</span></label>
            <select class="form-select @error('village') is-invalid @enderror" wire:model.live="village" @disabled(empty($villages))>
                <option value="">-- Pilih Kelurahan / Desa --</option>
                @foreach($villages as $villageItem)
                    <option value="{{ $villageItem['code'] }}">{{ $villageItem['name'] }}</option>
                @endforeach
            </select>
            @error('village') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <div class="row">
            {{-- Dusun / Lingkungan --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Dusun / Lingkungan</label>
                <input 
                    type="text" 
                    class="form-control @error('hamlet') is-invalid @enderror" 
                    wire:model="hamlet" 
                    placeholder="Nama Dusun / Lingkungan">
                @error('hamlet') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>

            {{-- Kode Pos --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Kode Pos</label>
                <input 
                    type="text" 
                    class="form-control @error('postal_code') is-invalid @enderror" 
                    wire:model="postal_code" 
                    maxlength="10" 
                    placeholder="Kode Pos">
                @error('postal_code') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>
        </div>

        <div class="row">
            {{-- RT --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">RT</label>
                <input 
                    type="text" 
                    class="form-control @error('rt') is-invalid @enderror" 
                    wire:model="rt" 
                    maxlength="5" 
                    placeholder="RT">
                @error('rt') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>

            {{-- RW --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">RW</label>
                <input 
                    type="text" 
                    class="form-control @error('rw') is-invalid @enderror" 
                    wire:model="rw" 
                    maxlength="5" 
                    placeholder="RW">
                @error('rw') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>
        </div>

        {{-- TITIK KOORDINAT MAP --}}
        <hr class="my-4">
        <div class="mb-3">
            <label class="form-label fw-semibold">
                <i class="bi bi-pin-map-fill text-danger me-1"></i> Titik Lokasi Rumah (Peta)
            </label>
            <p class="text-muted small mb-2">Geser penanda (pin) di peta atau klik area peta untuk menentukan lokasi rumah.</p>

            {{-- MAP CONTAINER ISOLATED --}}
            <div wire:ignore 
                 x-data="initLeafletMap($wire)">
                <div x-ref="map" style="height: 350px; width: 100%; border-radius: 8px; border: 1px solid #dee2e6; z-index: 1;"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label small text-muted">Latitude</label>
                <input type="text" class="form-control bg-light" wire:model="latitude" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label small text-muted">Longitude</label>
                <input type="text" class="form-control bg-light" wire:model="longitude" readonly>
            </div>
        </div>

    </div>
</div>
