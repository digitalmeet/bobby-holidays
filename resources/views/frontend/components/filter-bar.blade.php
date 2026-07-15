@php
    $activeFilters = collect(['duration', 'budget', 'category'])->filter(fn($k) => request()->filled($k))->count();
@endphp

<form method="GET" action="" class="mb-5">
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-3 p-md-4">
            <div class="row g-3 align-items-end">
                <div class="col-6 col-md-3">
                    <label class="form-label small fw-semibold text-muted mb-1">Duration</label>
                    <select name="duration" class="form-select form-select-sm" style="border-color:#dee2e6;">
                        <option value="">Any Duration</option>
                        <option value="1-3" {{ request('duration') === '1-3' ? 'selected' : '' }}>1 – 3 Days</option>
                        <option value="4-6" {{ request('duration') === '4-6' ? 'selected' : '' }}>4 – 6 Days</option>
                        <option value="7+" {{ request('duration') === '7+' ? 'selected' : '' }}>7+ Days</option>
                    </select>
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label small fw-semibold text-muted mb-1">Budget</label>
                    <select name="budget" class="form-select form-select-sm" style="border-color:#dee2e6;">
                        <option value="">Any Budget</option>
                        <option value="under15" {{ request('budget') === 'under15' ? 'selected' : '' }}>Under ₹15,000</option>
                        <option value="15-30"   {{ request('budget') === '15-30'   ? 'selected' : '' }}>₹15,000 – ₹30,000</option>
                        <option value="30-60"   {{ request('budget') === '30-60'   ? 'selected' : '' }}>₹30,000 – ₹60,000</option>
                        <option value="60plus"  {{ request('budget') === '60plus'  ? 'selected' : '' }}>₹60,000+</option>
                    </select>
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label small fw-semibold text-muted mb-1">Category</label>
                    <select name="category" class="form-select form-select-sm" style="border-color:#dee2e6;">
                        <option value="">Any Category</option>
                        @foreach(['family','couple','group','solo','adventure'] as $cat)
                            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 col-md-3 d-flex gap-2">
                    <button type="submit" class="btn fw-semibold text-white flex-grow-1" style="background:#064f68;font-size:14px;">
                        <i class="fa-solid fa-filter me-1"></i> Filters
                        @if($activeFilters > 0)
                            <span class="badge rounded-pill ms-1" style="background:rgba(255,255,255,0.3);font-size:11px;">{{ $activeFilters }}</span>
                        @endif
                    </button>
                    @if($activeFilters > 0)
                        <a href="{{ url()->current() }}" class="btn btn-outline-secondary fw-semibold" style="font-size:14px;" title="Clear filters">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>
