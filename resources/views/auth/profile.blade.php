@extends('layouts.app')

@section('title', 'URBAN VIBE | Profil Saya')

@section('content')
<section class="py-5 my-5" style="background-color: #0b0b0b;">
    <div class="container pt-5 text-white">
        <h2 class="fw-bold mb-4"><i class="bi bi-person-circle text-primary me-2"></i>Profil Saya</h2>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card bg-dark rounded-4 border border-secondary p-4 text-center mb-4">
                    <div class="mx-auto bg-primary rounded-circle d-flex align-items-center justify-content-center shadow-sm mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-person-fill fs-1 text-white"></i>
                    </div>
                    <h4 class="fw-bold m-0 text-white">{{ $user->name }}</h4>
                    <p class="text-secondary small mb-4">{{ $user->email }}</p>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100 py-2.5 rounded-3 fw-semibold shadow-sm">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </button>
                    </form>
                </div>

                <div class="list-group list-group-custom rounded-4 border border-secondary overflow-hidden shadow-sm">
                    <a href="{{ route('profile.index', ['tab' => 'dikemas']) }}" class="list-group-item list-group-item-action bg-dark text-white border-0 border-bottom border-secondary p-3 {{ $tab == 'dikemas' ? 'active-profile' : '' }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="bi bi-box-seam text-primary me-3 fs-5"></i>Barang Dikemas</div>
                            <span class="badge bg-secondary rounded-pill px-2.5 py-1 text-dark fw-bold">{{ $counts['dikemas'] }}</span>
                        </div>
                    </a>
                    <a href="{{ route('profile.index', ['tab' => 'dikirim']) }}" class="list-group-item list-group-item-action bg-dark text-white border-0 border-bottom border-secondary p-3 {{ $tab == 'dikirim' ? 'active-profile' : '' }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="bi bi-truck text-primary me-3 fs-5"></i>Barang Dikirim</div>
                            <span class="badge bg-secondary rounded-pill px-2.5 py-1 text-dark fw-bold">{{ $counts['dikirim'] }}</span>
                        </div>
                    </a>
                    <a href="{{ route('profile.index', ['tab' => 'dinilai']) }}" class="list-group-item list-group-item-action bg-dark text-white border-0 border-bottom border-secondary p-3 {{ $tab == 'dinilai' ? 'active-profile' : '' }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="bi bi-star text-primary me-3 fs-5"></i>Barang Dinilai</div>
                            <span class="badge bg-secondary rounded-pill px-2.5 py-1 text-dark fw-bold">{{ $counts['dinilai'] }}</span>
                        </div>
                    </a>
                    <a href="{{ route('profile.index', ['tab' => 'voucher']) }}" class="list-group-item list-group-item-action bg-dark text-white border-0 p-3 {{ $tab == 'voucher' ? 'active-profile' : '' }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="bi bi-ticket-perforated text-primary me-3 fs-5"></i>Diskon & Voucher</div>
                            <span class="badge bg-success text-white px-2.5 py-1 rounded-2" style="font-size: 0.75rem;">Info</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card bg-dark rounded-4 border border-secondary p-4 min-frame-height">

                    @if($tab == 'dikemas')
                        <h5 class="fw-bold mb-4 border-bottom border-secondary pb-2"><i class="bi bi-box-seam text-primary me-2"></i>Daftar Barang Dikemas</h5>
                        @if($orders->isEmpty())
                            <div class="text-center py-5 my-3">
                                <i class="bi bi-clock-history fs-1 text-secondary mb-3 d-block"></i>
                                <p class="text-secondary mb-0">Belum ada pesanan yang sedang dikemas.</p>
                            </div>
                        @else
                            @foreach($orders as $order)
                                <div class="p-3 bg-black rounded-3 border border-secondary mb-3">
                                    <div class="d-flex justify-content-between border-bottom border-secondary pb-2 mb-2 small text-secondary">
                                        <span>Invoice: <strong class="text-white">{{ $order->invoice }}</strong></span>
                                        <span class="badge bg-warning text-dark text-uppercase">
                                            {{ $order->status == 'processing' ? 'Diproses / Dikemas' : $order->status }}
                                        </span>
                                    </div>
                                    @if($order->orderDetails)
                                        @foreach($order->orderDetails as $detail)
                                            <div class="d-flex align-items-center justify-content-between py-2 border-bottom border-secondary border-opacity-25">
                                                <!-- PERBAIKAN: Menampilkan Nama Produk diikuti ukuran, misal: Urban Vibe Shirt (XL) -->
                                                <div class="text-white fw-bold small">
                                                    {{ $detail->product->name ?? 'Produk Bawaan' }}
                                                    <span class="text-primary ms-1">({{ $detail->size ?? 'XL' }})</span>
                                                </div>
                                                <div class="text-secondary small">{{ $detail->quantity }}x</div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                        @endif

                    @elseif($tab == 'dikirim')
                        <h5 class="fw-bold mb-4 border-bottom border-secondary pb-2"><i class="bi bi-truck text-primary me-2"></i>Lacak Pengiriman</h5>
                        @if($orders->isEmpty())
                            <div class="text-center py-5 my-3">
                                <i class="bi bi-card-list fs-1 text-secondary mb-3 d-block"></i>
                                <p class="text-secondary mb-0">Tidak ada pengiriman aktif saat ini.</p>
                            </div>
                        @else
                            @foreach($orders as $order)
                                <div class="p-3 bg-black rounded-3 border border-secondary mb-3">
                                    <div class="d-flex justify-content-between border-bottom border-secondary pb-2 mb-2 small text-secondary">
                                        <span>Invoice: <strong class="text-white">{{ $order->invoice }}</strong></span>
                                        <span class="badge bg-info text-dark text-uppercase">Dalam Pengiriman</span>
                                    </div>
                                    <p class="small text-secondary mb-0">Kurir: {{ $order->courier ?? 'Ekspedisi Urban Vibe' }}</p>
                                </div>
                            @endforeach
                        @endif

                    @elseif($tab == 'dinilai')
                        <h5 class="fw-bold mb-4 border-bottom border-secondary pb-2"><i class="bi bi-star text-primary me-2"></i>Ulasan & Penilaian</h5>
                        @if($orders->isEmpty())
                            <div class="text-center py-5 my-3">
                                <i class="bi bi-chat-left-heart fs-1 text-secondary mb-3 d-block"></i>
                                <p class="text-secondary mb-0">Semua barang telah dinilai. Terima kasih atas ulasanmu!</p>
                            </div>
                        @else
                            @foreach($orders as $order)
                                <div class="p-3 bg-black rounded-3 border border-secondary mb-3">
                                    <p class="small text-success mb-1">Pesanan Selesai - {{ $order->invoice }}</p>
                                    <button class="btn btn-sm btn-primary mt-2">Beri Penilaian Bintang</button>
                                </div>
                            @endforeach
                        @endif

                    @elseif($tab == 'voucher')
                        <h5 class="fw-bold mb-4 border-bottom border-secondary pb-2">
                            <i class="bi bi-ticket-perforated text-primary me-2"></i>Voucher Kamu <span class="fs-6 text-secondary fw-normal">({{ $totalCompleted }} Pesanan Selesai)</span>
                        </h5>
                        <div class="row g-3">
                            @forelse($availableVouchers as $voucher)
                                <div class="col-md-6">
                                    <div class="p-3 border {{ $voucher['class'] }} rounded-3 bg-black bg-opacity-50 d-flex align-items-between justify-content-between shadow-sm {{ $voucher['is_locked'] ? 'opacity-50' : '' }}">
                                        <div>
                                            <span class="badge {{ str_replace('border', 'bg', $voucher['class']) }} mb-2 text-dark fw-bold">{{ $voucher['title'] }}</span>
                                            <h6 class="fw-bold text-white mb-1">{{ $voucher['desc'] }}</h6>
                                            @if($voucher['is_locked'])
                                                <small class="text-warning" style="font-size: 0.75rem;"><i class="bi bi-lock-fill me-1"></i>{{ $voucher['requirement'] }}</small>
                                            @else
                                                <small class="text-success" style="font-size: 0.75rem;"><i class="bi bi-check-circle-fill me-1"></i>Siap Digunakan</small>
                                            @endif
                                            @if(!empty($voucher['expiry']))
                                                <div class="mt-2 small text-secondary">
                                                    <i class="bi bi-calendar-event me-1"></i>Masa berlaku: {{ $voucher['expiry'] }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="text-end ps-3 border-start border-secondary border-opacity-25 my-auto">
                                            <span class="fw-bold text-white fs-5 d-block">{{ $voucher['percent'] }}</span>
                                            @if(!$voucher['is_locked'])
                                                <span class="badge bg-primary mt-1" style="font-size: 0.65rem;">{{ $voucher['code'] }}</span>
                                            @else
                                                <span class="text-secondary d-block mt-1" style="font-size: 0.65rem;">Locked</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center w-100 text-secondary py-4">Belum ada voucher yang tersedia.</div>
                            @endforelse
                        </div>
                    @endif </div>
            </div>
        </div>
    </div>
</section>

<style>
    .min-frame-height { min-height: 380px; }
    .list-group-custom .list-group-item { transition: all 0.2s ease; cursor: pointer; }
    .list-group-custom .list-group-item:hover { background-color: #161616 !important; padding-left: 20px !important; }
    .active-profile { background-color: #0d6efd !important; color: #fff !important; font-weight: bold; }
    .active-profile i { color: #fff !important; }
</style>
@endsection
