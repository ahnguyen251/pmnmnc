@extends('layout.customer')

@section('title', 'Sản phẩm - ShopOnline')

@section('content')

    <!-- Hero Section -->
    <div class="hero-section">
        <h1>Sản phẩm của chúng tôi</h1>
        <p>Khám phá bộ sưu tập sản phẩm chất lượng cao với giá tốt nhất</p>
    </div>

    <!-- Filter Bar -->
    <form action="{{ route('customer.product') }}" method="GET" class="filter-bar">
        <div class="filter-group">
            <i class="fas fa-search"></i>
            <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." value="{{ request('keyword') }}">
        </div>
        <div class="filter-group">
            <i class="fas fa-layer-group"></i>
            <select name="category_id">
                <option value="">Tất cả danh mục</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn-filter">
            <i class="fas fa-filter"></i> Lọc
        </button>
    </form>

    <!-- Products Grid -->
    @if ($products->count() > 0)
        <div class="products-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        @if ($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                        @else
                            <div class="no-image">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                        @if ($product->sale_price)
                            <span class="badge-sale">SALE</span>
                        @endif
                    </div>
                    <div class="product-info">
                        <span class="product-category">
                            {{ $product->category ? $product->category->name : 'Chưa phân loại' }}
                        </span>
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <p class="product-desc">{{ Str::limit($product->description, 80) }}</p>
                        <div class="product-bottom">
                            <div class="product-price">
                                @if ($product->sale_price)
                                    <span class="price-old">{{ number_format($product->price) }}đ</span>
                                    <span class="price-current">{{ number_format($product->sale_price) }}đ</span>
                                @else
                                    <span class="price-current">{{ number_format($product->price) }}đ</span>
                                @endif
                            </div>
                            <div class="product-stock">
                                @if ($product->stock > 0)
                                    <span class="in-stock"><i class="fas fa-check-circle"></i> Còn hàng</span>
                                @else
                                    <span class="out-stock"><i class="fas fa-times-circle"></i> Hết hàng</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-box-open"></i>
            <h3>Không tìm thấy sản phẩm</h3>
            <p>Thử thay đổi bộ lọc hoặc từ khóa tìm kiếm</p>
        </div>
    @endif

@endsection

@push('styles')
    <style>
       /* ===== HERO ===== */
.hero-section {
    text-align: center;
    padding: 2.5rem 1rem 1.5rem;
}

.hero-section h1 {
    font-size: 2.2rem;
    font-weight: 800;
    background: linear-gradient(135deg, #2563eb, #1e40af);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.hero-section p {
    color: #64748b;
    font-size: 1.05rem;
}

/* ===== FILTER BAR ===== */
.filter-bar {
    display: flex;
    gap: 1rem;
    align-items: center;
    background: #ffffff;
    padding: 1rem 1.5rem;
    border-radius: 14px;
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.08);
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.filter-group {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex: 1;
    min-width: 200px;
    background: #f1f5f9;
    border-radius: 10px;
    padding: 0.6rem 1rem;
    transition: all 0.2s;
}

.filter-group:focus-within {
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.35);
    background: #fff;
}

.filter-group i {
    color: #94a3b8;
}

.filter-group input,
.filter-group select {
    border: none;
    background: transparent;
    outline: none;
    font-family: 'Inter', sans-serif;
    font-size: 0.9rem;
    color: #0f172a;
    width: 100%;
}

/* ===== BUTTON ===== */
.btn-filter {
    background: linear-gradient(135deg, #2563eb, #1e3a8a);
    color: white;
    border: none;
    padding: 0.7rem 1.6rem;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.25s;
}

.btn-filter:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35);
}

/* ===== PRODUCTS GRID ===== */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
    gap: 1.6rem;
}

/* ===== PRODUCT CARD ===== */
.product-card {
    background: #ffffff;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 3px 14px rgba(0,0,0,0.06);
    transition: all 0.3s;
}

.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 28px rgba(37, 99, 235, 0.15);
}

/* ===== IMAGE ===== */
.product-image {
    position: relative;
    height: 220px;
    overflow: hidden;
    background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s;
}

.product-card:hover img {
    transform: scale(1.08);
}

/* ===== SALE BADGE ===== */
.badge-sale {
    position: absolute;
    top: 12px;
    right: 12px;
    background: #2563eb;
    color: white;
    padding: 4px 12px;
    border-radius: 18px;
    font-size: 0.75rem;
    font-weight: 700;
}

/* ===== INFO ===== */
.product-info {
    padding: 1.2rem;
}

.product-category {
    font-size: 0.75rem;
    font-weight: 600;
    color: #2563eb;
    text-transform: uppercase;
}

.product-name {
    font-size: 1.05rem;
    font-weight: 700;
    margin: 0.4rem 0;
    color: #0f172a;
}

.product-desc {
    font-size: 0.85rem;
    color: #64748b;
    margin-bottom: 1rem;
}

/* ===== BOTTOM ===== */
.product-bottom {
    display: flex;
    justify-content: space-between;
    border-top: 1px solid #f1f5f9;
    padding-top: 0.8rem;
}

.price-old {
    text-decoration: line-through;
    color: #94a3b8;
    font-size: 0.85rem;
}

.price-current {
    font-size: 1.2rem;
    font-weight: 800;
    color: #2563eb;
}

/* ===== STOCK ===== */
.in-stock {
    font-size: 0.8rem;
    color: #22c55e;
}

.out-stock {
    font-size: 0.8rem;
    color: #ef4444;
}

/* ===== EMPTY ===== */
.empty-state {
    text-align: center;
    padding: 4rem 1rem;
    color: #94a3b8;
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 1rem;
}

.empty-state h3 {
    font-size: 1.3rem;
    color: #475569;
}

/* ===== MOBILE ===== */
@media (max-width:768px) {

.hero-section h1 {
    font-size: 1.7rem;
}

.filter-bar {
    flex-direction: column;
}

.filter-group {
    width: 100%;
}

.products-grid {
    grid-template-columns: repeat(auto-fill,minmax(220px,1fr));
}

}
    </style>
@endpush