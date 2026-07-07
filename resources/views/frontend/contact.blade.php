@extends('layouts.frontend')

@section('content')
    <section class="py-5 bg-light">

        <div class="container">

            <div class="text-center mb-5">

                <h1 class="fw-bold">
                    Contact Us
                </h1>

                <p>
                    We would love to hear from you.
                </p>

            </div>

            <div class="row">

                <!-- Contact Details -->

                <div class="col-lg-5">

                    <div class="card shadow p-4">

                        <h3 class="fw-bold mb-4">
                            Nature's Gold Honey
                        </h3>

                        <p>
                            📍 Hastinapur, Hyderabad,
                            Telangana, India
                        </p>

                        <p>
                            📞 Phone:
                            <br>
                            +91 7981806490
                        </p>

                        <p>
                            📧 Email:
                            <br>
                            info@naturesgoldhoney.com
                        </p>

                        <p>
                            🕒 Business Hours:
                            <br>
                            9:00 AM - 8:00 PM
                        </p>

                    </div>

                </div>

                <!-- Contact Form -->

                <div class="col-lg-7">

                    <div class="card shadow p-4">

                        <h3 class="fw-bold mb-4">
                            Send Message
                        </h3>

                        <form>

                            <div class="mb-3">

                                <input type="text" class="form-control" placeholder="Your Name">

                            </div>

                            <div class="mb-3">

                                <input type="text" class="form-control" placeholder="Phone Number">

                            </div>

                            <div class="mb-3">

                                <input type="email" class="form-control" placeholder="Email">

                            </div>

                            <div class="mb-3">

                                <textarea class="form-control" rows="5" placeholder="Message"></textarea>

                            </div>

                            <button class="btn btn-warning px-4">

                                Send Message

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Map -->

    <section class="py-4">

        <div class="container">

            <h3 class="text-center fw-bold mb-4">
                Find Our Store
            </h3>

            <div class="ratio ratio-21x9">

                <iframe src="YOUR_GOOGLE_MAP_EMBED_URL" allowfullscreen="" loading="lazy">
                </iframe>

            </div>

        </div>

    </section>
@endsection
