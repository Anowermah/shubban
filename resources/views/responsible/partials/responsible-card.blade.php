@section('page-styles')
<style>
.responsible-section {
    padding: 4rem 0;
    background: #f8f9fa;
    min-height: calc(100vh - 100px);
}

.section-title {
    text-align: center;
    color: #004d40;
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 3rem;
}

.row.g-5 {
    margin-top: 5rem;
}

.card {
    border: none;
    background: white;
    border-radius: 20px;
    overflow: visible;
    box-shadow: 0 3px 20px rgba(0, 0, 0, 0.06);
    padding: 2rem 1.5rem;
    text-align: center;
    transition: transform 0.3s ease;
    height: calc(100% - 5rem);
    margin-top: 5rem;
}

.card:hover {
    transform: translateY(-5px);
}

.image-wrapper {
    width: 180px;
    height: 180px;
    margin: -90px auto 1.5rem;
    position: relative;
}

.profile-image {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid white;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    background: #00bcd4;
}

.profile-placeholder {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: #00bcd4;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 5px solid white;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}

.profile-placeholder i {
    font-size: 3rem;
    color: white;
}

.card-title {
    color: #004d40;
    font-size: 1.75rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
    font-family: 'SolaimanLipi', Arial, sans-serif;
}

.card-subtitle {
    color: #00695c;
    font-size: 1.1rem;
    margin-bottom: 1rem;
    font-family: 'SolaimanLipi', Arial, sans-serif;
}

.address-info {
    margin: 1rem 0;
    padding: 1rem 0;
    border-top: 1px solid #e0f2f1;
    border-bottom: 1px solid #e0f2f1;
}

.area, .address {
    color: #546e7a;
    font-size: 0.95rem;
    margin-bottom: 0.5rem;
    font-family: 'SolaimanLipi', Arial, sans-serif;
}

.area:last-child, .address:last-child {
    margin-bottom: 0;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-top: 1rem;
}

.contact-link {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    color: #0288d1;
    text-decoration: none;
    font-size: 0.95rem;
    padding: 0.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.contact-link:hover {
    background: rgba(2, 136, 209, 0.1);
    color: #0277bd;
}

.contact-link i {
    font-size: 1.1rem;
}

@media (max-width: 991.98px) {
    .card {
        padding: 1.75rem 1.25rem;
        height: calc(100% - 4.5rem);
        margin-top: 4.5rem;
    }
    
    .image-wrapper {
        width: 160px;
        height: 160px;
        margin: -80px auto 1.25rem;
    }
    
    .card-title {
        font-size: 1.5rem;
    }
    
    .card-subtitle {
        font-size: 1rem;
    }
}

@media (max-width: 767.98px) {
    .responsible-section {
        padding: 3rem 0;
    }
    
    .section-title {
        font-size: 2rem;
        margin-bottom: 2.5rem;
    }
    
    .card {
        height: calc(100% - 4rem);
        margin-top: 4rem;
    }
    
    .image-wrapper {
        width: 140px;
        height: 140px;
        margin: -70px auto 1rem;
    }
    
    .card-title {
        font-size: 1.35rem;
    }
    
    .contact-link {
        font-size: 0.9rem;
    }
}
</style>
@endsection

<div class="responsible-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title">{{ $title }}</h2>
            </div>
        </div>
        
        <div class="row g-5">
            @forelse($managers as $manager)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="image-wrapper">
                        @if($manager->image)
                            <img src="{{ asset('storage/' . $manager->image) }}" class="profile-image" alt="{{ $manager->name }}">
                        @else
                            <div class="profile-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                    
                    <h3 class="card-title">{{ $manager->name }}</h3>
                    <p class="card-subtitle">{{ $manager->designation }}</p>
                    
                    @if($manager->area || $manager->address)
                        <div class="address-info">
                            @if($manager->area)
                                <p class="area">{{ $manager->area }}</p>
                            @endif
                            @if($manager->address)
                                <p class="address">{{ $manager->address }}</p>
                            @endif
                        </div>
                    @endif
                    
                    <div class="contact-info">
                        @if($manager->phone)
                            <a href="tel:{{ $manager->phone }}" class="contact-link">
                                <i class="fas fa-phone"></i>
                                <span>{{ $manager->phone }}</span>
                            </a>
                        @endif
                        @if($manager->email)
                            <a href="mailto:{{ $manager->email }}" class="contact-link">
                                <i class="fas fa-envelope"></i>
                                <span>{{ $manager->email }}</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    কোন দায়িত্বশীল ব্যক্তি পাওয়া যায়নি।
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
