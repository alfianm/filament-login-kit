@php
    $livewire ??= null;
    $renderHookScopes = $livewire?->getRenderHookScopes() ?? [];
    
    // Konfigurasi gambar
    $sideImage = $sideImage ?? asset('images/login-kit/side-image.jpg');
    $sideImagePosition = $sideImagePosition ?? 'left';
    $backgroundPosition = $backgroundPosition ?? 'center';
    $backgroundSize = $backgroundSize ?? 'cover';
    $overlayOpacity = $overlayOpacity ?? 0.5;
    
    // Konfigurasi form
    $formPosition = $formPosition ?? 'center';
    $formAlignment = $formAlignment ?? 'center';
    $layoutMode = $layoutMode ?? 'split';
    $filamentVersion = $filamentVersion ?? '5';
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
    @props(['after' => null])

    @if($layoutMode === 'overlay')
        {{-- MODE OVERLAY --}}
        <style>
            .flk-overlay {
                position: relative;
                min-height: 100vh;
                width: 100%;
                display: flex;
                justify-content: center;
                padding: 2rem 1.5rem;
            }

            .flk-overlay.position-top {
                align-items: flex-start;
                padding-top: 4rem;
            }

            .flk-overlay.position-center {
                align-items: center;
            }

            .flk-overlay.position-bottom {
                align-items: flex-end;
                padding-bottom: 4rem;
            }

            .flk-overlay-bg {
                position: fixed;
                inset: 0;
                background-size: {{ $backgroundSize }};
                background-position: {{ $backgroundPosition }};
                background-repeat: no-repeat;
                z-index: 0;
            }

            .flk-overlay-mask {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, {{ $overlayOpacity }});
                z-index: 1;
            }

            .flk-overlay-card {
                position: relative;
                z-index: 10;
                width: 100%;
                max-width: 440px;
                background: white;
                border-radius: 0.75rem;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
                padding: 2.5rem;
            }

            .dark .flk-overlay-card {
                background: rgb(31, 41, 55);
            }

            @media (max-width: 640px) {
                .flk-overlay-card {
                    padding: 1.75rem;
                }
            }

            .flk-overlay-card.align-left { text-align: left; }
            .flk-overlay-card.align-center { text-align: center; }
            .flk-overlay-card.align-right { text-align: right; }

            .flk-overlay-brand {
                margin-bottom: 1.5rem;
            }

            .flk-overlay-brand img {
                height: 2.5rem;
                display: inline-block;
            }

            .flk-overlay-brand-text {
                font-size: 1.75rem;
                font-weight: 700;
                color: rgb(17, 24, 39);
            }

            .dark .flk-overlay-brand-text {
                color: white;
            }

            .flk-overlay-form {
                margin-bottom: 1.5rem;
            }

            .flk-overlay-footer {
                font-size: 0.875rem;
                color: rgb(107, 114, 128);
            }

            .dark .flk-overlay-footer {
                color: rgb(156, 163, 175);
            }

            .flk-overlay-footer a {
                color: rgb(245, 158, 11);
                font-weight: 500;
                text-decoration: none;
            }

            .flk-overlay-footer a:hover {
                color: rgb(217, 119, 6);
            }
        </style>

        <div class="flk-overlay position-{{ $formPosition }}">
            <div class="flk-overlay-bg" style="background-image: url('{{ $sideImage }}');"></div>
            <div class="flk-overlay-mask"></div>

            <div class="flk-overlay-card align-{{ $formAlignment }}">
                <div class="flk-overlay-brand">
                    @if ($brandLogo = filament()->getBrandLogo())
                        <img src="{{ $brandLogo }}" alt="{{ filament()->getBrandName() }}">
                    @else
                        <span class="flk-overlay-brand-text">{{ filament()->getBrandName() }}</span>
                    @endif
                </div>

                <div class="flk-overlay-form">
                    {{ $slot }}
                </div>

                <div class="flk-overlay-footer">
                    @if (filament()->hasRegistration())
                        <span>Belum punya akun?</span>
                        <a href="{{ filament()->getRegistrationUrl() }}">Daftar</a>
                    @endif
                    @if (filament()->hasPasswordReset())
                        @if (filament()->hasRegistration())<br>@endif
                        <a href="{{ filament()->getRequestPasswordResetUrl() }}">Lupa password?</a>
                    @endif
                </div>
            </div>
        </div>

    @else
        {{-- MODE SPLIT --}}
        <style>
            .flk-split {
                display: flex;
                min-height: 100vh;
                width: 100%;
            }

            .flk-split .order-1 { order: 1; }
            .flk-split .order-2 { order: 2; }

            @media (max-width: 767px) {
                .flk-split {
                    flex-direction: column;
                }
                .flk-split .order-1,
                .flk-split .order-2 {
                    order: 0 !important;
                }
            }

            /* IMAGE SIDE */
            .flk-image {
                display: none;
                position: relative;
                width: 50%;
                background: #111827;
            }

            @media (min-width: 768px) {
                .flk-image {
                    display: block;
                }
            }

            @media (min-width: 1024px) {
                .flk-image {
                    width: 55%;
                }
            }

            @media (min-width: 1280px) {
                .flk-image {
                    width: 60%;
                }
            }

            .flk-image-bg {
                position: absolute;
                inset: 0;
                background-size: {{ $backgroundSize }};
                background-position: {{ $backgroundPosition }};
                background-repeat: no-repeat;
            }

            .flk-image-overlay {
                position: absolute;
                inset: 0;
                background: rgba(0, 0, 0, {{ $overlayOpacity }});
            }

            .flk-image-content {
                position: relative;
                z-index: 10;
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                padding: 3rem;
                color: white;
            }

            .flk-image-welcome h2 {
                font-size: 2.5rem;
                font-weight: 700;
                margin: 0 0 0.5rem 0;
                text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            }

            @media (min-width: 1024px) {
                .flk-image-welcome h2 {
                    font-size: 3.5rem;
                }
            }

            .flk-image-welcome p {
                font-size: 1.125rem;
                opacity: 0.9;
                margin: 0;
                text-shadow: 0 1px 2px rgba(0,0,0,0.3);
            }

            /* FORM SIDE */
            .flk-form {
                width: 100%;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                background: white;
                padding: 2rem 1.5rem;
            }

            @media (min-width: 768px) {
                .flk-form {
                    width: 50%;
                    padding: 3rem;
                }
            }

            @media (min-width: 1024px) {
                .flk-form {
                    width: 45%;
                }
            }

            @media (min-width: 1280px) {
                .flk-form {
                    width: 40%;
                }
            }

            .dark .flk-form {
                background: rgb(17, 24, 39);
            }

            .flk-form.position-top {
                justify-content: flex-start;
                padding-top: 4rem;
            }

            .flk-form.position-bottom {
                justify-content: flex-end;
                padding-bottom: 4rem;
            }

            .flk-form-inner {
                width: 100%;
                max-width: 360px;
                margin: 0 auto;
            }

            .flk-form-inner.align-left { text-align: left; }
            .flk-form-inner.align-center { text-align: center; }
            .flk-form-inner.align-right { text-align: right; }

            .flk-form-content {
                width: 100%;
            }

            .flk-form-footer {
                margin-top: 1.5rem;
                padding-top: 1.5rem;
                border-top: 1px solid #e5e7eb;
                font-size: 0.875rem;
                color: rgb(107, 114, 128);
            }

            .dark .flk-form-footer {
                color: rgb(156, 163, 175);
                border-top-color: rgb(55, 65, 81);
            }

            .flk-form-footer a {
                color: rgb(245, 158, 11);
                font-weight: 500;
                text-decoration: none;
            }

            .flk-form-footer a:hover {
                color: rgb(217, 119, 6);
            }
        </style>

        <div class="flk-split">
            {{-- IMAGE SIDE --}}
            <div class="flk-image {{ $sideImagePosition === 'right' ? 'order-2' : 'order-1' }}">
                <div class="flk-image-bg" style="background-image: url('{{ $sideImage }}');"></div>
                <div class="flk-image-overlay"></div>
                
                <div class="flk-image-content">
                    <div class="flk-image-welcome">
                        <h2>Selamat Datang</h2>
                        <p>Login untuk melanjutkan</p>
                    </div>
                </div>
            </div>

            {{-- FORM SIDE --}}
            <div class="flk-form position-{{ $formPosition }} {{ $sideImagePosition === 'right' ? 'order-1' : 'order-2' }}">
                <div class="flk-form-inner align-{{ $formAlignment }}">
                    <div class="flk-form-content">
                        {{ $slot }}
                    </div>

                    <div class="flk-form-footer">
                        @if (filament()->hasRegistration())
                            <span>Belum punya akun?</span>
                            <a href="{{ filament()->getRegistrationUrl() }}">Daftar</a>
                        @endif
                        @if (filament()->hasPasswordReset())
                            @if (filament()->hasRegistration())<br>@endif
                            <a href="{{ filament()->getRequestPasswordResetUrl() }}">Lupa password?</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-filament-panels::layout.base>
