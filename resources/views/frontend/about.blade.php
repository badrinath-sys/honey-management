@extends('layouts.frontend')

@section('content')
    <!-- About Hero -->
    <section class="py-5 bg-light">
        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-6">

                    <h1 class="fw-bold mb-3">
                        About Nature's Gold Honey
                    </h1>

                    <p class="lead">
                        Pure Natural Honey From Our Own Bee Farms
                    </p>

                    <p>
                        Welcome to Nature's Gold Honey. Our store is located in
                        <strong>Hastinapur, Hyderabad</strong>.
                    </p>

                    <p>
                        We, <strong>Badrinath</strong> and my friend
                        <strong>Santhosh</strong>, personally take care of our bee
                        colonies and follow natural beekeeping practices to produce
                        pure and natural honey.
                    </p>

                    <p>
                        Every drop of honey is carefully harvested, hygienically
                        packed, and delivered while preserving its natural taste,
                        aroma, and nutritional value.
                    </p>

                </div>

                <div class="col-lg-6">

                    <img src="{{ asset('assets/images/hero.png') }}" class="img-fluid">
                </div>

            </div>

        </div>
    </section>

    <!-- Founders -->
    <section class="py-5">

        <div class="container">

            <div class="text-center mb-4">

                <h2 class="fw-bold">
                    Meet The Founders
                </h2>

            </div>

            <div class="row justify-content-center">

                <div class="col-md-4">

                    <div class="card shadow text-center p-4">

                        <h4>
                            Badrinath
                        </h4>

                        <p>
                            Founder
                        </p>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card shadow text-center p-4">

                        <h4>
                            Santhosh
                        </h4>

                        <p>
                            Co-Founder
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Why Choose Us -->

    <section class="py-5 bg-light">

        <div class="container">

            <h2 class="text-center fw-bold mb-5">
                Why Choose Nature's Gold Honey?
            </h2>

            <div class="row">

                <div class="col-md-4 mb-3">

                    <div class="card shadow h-100 text-center p-4">

                        <h4>🍯 Pure Honey</h4>

                        <p>
                            100% natural honey without artificial additives.
                        </p>

                    </div>

                </div>

                <div class="col-md-4 mb-3">

                    <div class="card shadow h-100 text-center p-4">

                        <h4>🐝 Natural Beekeeping</h4>

                        <p>
                            Honey produced from healthy bee colonies.
                        </p>

                    </div>

                </div>

                <div class="col-md-4 mb-3">

                    <div class="card shadow h-100 text-center p-4">

                        <h4>✅ Quality Promise</h4>

                        <p>
                            Hygienically packed with care.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Mission Vision -->

    <section class="py-5">

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <h3 class="fw-bold">
                        Our Mission
                    </h3>

                    <p>
                        To provide pure natural honey while supporting sustainable
                        and ethical beekeeping practices.
                    </p>

                </div>

                <div class="col-md-6">

                    <h3 class="fw-bold">
                        Our Vision
                    </h3>

                    <p>
                        To become one of India's trusted natural honey brands through
                        quality and customer satisfaction.
                    </p>

                </div>

            </div>

        </div>

    </section>
@endsection
