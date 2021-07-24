@extends('layouts.front')
@section('content')
<!-- Masthead-->
<header class="masthead">
    {{-- <div id="container" style="position: relative; width: 500px; height: 300px;"></div> --}}
    <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
        <div class="d-flex justify-content-center">
            <div id="tvaksin" class="text-center" style="display: none">
                <h1 class="mx-auto my-0 text-uppercase" id="dosis1">335.254</h1>
                <h2 class="text-white-50 mx-auto mt-2 mb-5">Orang Sudah Divaksin Dosis 1</h2>
                <h1 class="mx-auto my-0 text-uppercase" id="dosis2">335.254</h1>
                <h2 class="text-white-50 mx-auto mt-2 mb-5">Orang Sudah Divaksin Dosis 2</h2>
                <a class="btn btn-primary" href="/register">Vaksin Sekarang!</a>
            </div>
        </div>
    </div>
</header>
<!-- About-->
<section class="about-section text-center" id="presentase">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8" id="tsasaran" style="display: none">
                <h2 class="text-white mb-4"><b>Total Sasaran Vaksin</b></span></h2>
                <h2 class="text-white mb-4"><span class="sasaranvaksin"></span></h2>
                <p class="text-white-50">
                    <b><span id="dari">%</span> dari 100 penduduk sasaran vaksisansi sudah dapat 1 dosis</b><br>
                    (target total sasaran vaksisansi sampai tahap akhir)
                </p>
            </div>
        </div>
        <img class="img-fluid" src="{{ asset('vaccine.png') }}" alt="..." style="height: 40vh"/>
    </div>
</section>
<!-- Projects-->
<section class="projects-section bg-light" id="statistik">
    <div class="container px-4 px-lg-5">
        <!-- Featured Project Row-->
        <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
            <div class="col-xl-8 col-lg-7">
                {{-- <img class="img-fluid mb-3 mb-lg-0"
                    src="{{ asset('front/assets/img/bg-masthead.jpg') }}" alt="..." /> --}}
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="featured-text text-center text-lg-left">
                    <h4>Kasus Covid Di Indonesia</h4>
                    <p class="text-black-50 mb-0">Dari Perbandingan data disamping kasus suspek yang sembuh lebih dari 50%. dengan vaksinsai yang optimal sehingga dapat memenuhi target 80% penduduk Indonesia. diharapkan dapat kembali ke New Normal
                    </p>
                </div>
            </div>
        </div>
        <!-- Project One Row-->
        <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
            <div class="col-lg-6"><img class="img-fluid"
                    src="https://jatengprov.go.id/wp-content/uploads/2021/01/downloadfile-8.jpg" alt="..." style="height: 370px;  object-fit: cover"/></div>
            <div class="col-lg-6">
                <div class="bg-black text-center h-100 project">
                    <div class="d-flex h-100">
                        <div class="project-text w-100 my-auto text-center text-lg-left">
                            <h4 class="text-white" id="sasaransdmk"></h4>
                            <p class="mb-0 text-white-50">Total Sasaran Vaksinasi SDMK (Sumber Daya Manusia Kesehatan)</p>
                            <hr class="d-none d-lg-block mb-0 ms-0" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Project Two Row-->
        <div class="row gx-0 justify-content-center">
            <div class="col-lg-6"><img class="img-fluid"
                    src="https://pict-a.sindonews.net/dyn/620/pena/news/2021/03/26/34/377642/klikdokter-gelar-vaksinasi-covid19-gratis-untuk-lansia-ini-cara-daftarnya-llx.jpg" alt="..." style="height: 370px;  object-fit: cover"/></div>
            <div class="col-lg-6 order-lg-first">
                <div class="bg-black text-center h-100 project">
                    <div class="d-flex h-100">
                        <div class="project-text w-100 my-auto text-center text-lg-right">
                            <h4 class="text-white" id="sasaranlansia"></h4>
                            <p class="mb-0 text-white-50">Total Sasaran Vaksinasi Lansia</p>
                            <hr class="d-none d-lg-block mb-0 me-0" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Project Three Row-->
        <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
            <div class="col-lg-6"><img class="img-fluid"
                    src="https://assets.pikiran-rakyat.com/crop/0x0:0x0/x/photo/2021/05/27/600760628.jpeg" alt="..." style="height: 370px;  object-fit: cover"/></div>
            <div class="col-lg-6">
                <div class="bg-black text-center h-100 project">
                    <div class="d-flex h-100">
                        <div class="project-text w-100 my-auto text-center text-lg-left">
                            <h4 class="text-white" id="sasaranpublik"></h4>
                            <p class="mb-0 text-white-50">Total Sasaran Petugas Publik</p>
                            <hr class="d-none d-lg-block mb-0 ms-0" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Signup-->
{{-- <section class="signup-section" id="signup">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5">
            <div class="col-md-10 col-lg-8 mx-auto text-center">
                <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                <h2 class="text-white mb-5">Subscribe to receive updates!</h2>
                <!-- * * * * * * * * * * * * * * *-->
                <!-- * * SB Forms Contact Form * *-->
                <!-- * * * * * * * * * * * * * * *-->
                <!-- This form is pre-integrated with SB Forms.-->
                <!-- To make this form functional, sign up at-->
                <!-- https://startbootstrap.com/solution/contact-forms-->
                <!-- to get an API token!-->
                <form class="form-signup" id="contactForm" data-sb-form-api-token="API_TOKEN">
                    <!-- Email address input-->
                    <div class="row input-group-newsletter">
                        <div class="col"><input class="form-control" id="emailAddress" type="email"
                                placeholder="Enter email address..." aria-label="Enter email address..."
                                data-sb-validations="required,email" /></div>
                        <div class="col-auto"><button class="btn btn-primary disabled" id="submitButton"
                                type="submit">Notify Me!</button></div>
                    </div>
                    <div class="invalid-feedback mt-2" data-sb-feedback="emailAddress:required">An email is required.
                    </div>
                    <div class="invalid-feedback mt-2" data-sb-feedback="emailAddress:email">Email is not valid.</div>
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center mb-3 mt-2 text-white">
                            <div class="fw-bolder">Form submission successful!</div>
                            To activate this form, sign up at
                            <br />
                            <a
                                href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage">
                        <div class="text-center text-danger mb-3 mt-2">Error sending message!</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section> --}}
<!-- Contact-->
<section class="contact-section bg-black">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                        <h4 class="text-uppercase m-0">Address</h4>
                        <hr class="my-4 mx-auto" />
                        <div class="small text-black-50">Gedung Sujudi, Jl. H. R. Rasuna Said No.Kav 4 - 9, RT.9/RW.4, Kuningan, Kuningan Tim., Kuningan, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12950</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-envelope text-primary mb-2"></i>
                        <h4 class="text-uppercase m-0">Email</h4>
                        <hr class="my-4 mx-auto" />
                        <div class="small text-black-50"><a href="mailto:kontak@kemkes.go.id">kontak@kemkes.go.id</a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-mobile-alt text-primary mb-2"></i>
                        <h4 class="text-uppercase m-0">Phone</h4>
                        <hr class="my-4 mx-auto" />
                        <div class="small text-black-50">021-5201590</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="social d-flex justify-content-center">
            <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
            <a class="mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
            <a class="mx-2" href="#!"><i class="fab fa-github"></i></a>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function () {
        $.ajax({
            url: "/api/covid/all",
            method: "GET",
            success: function (data) {
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jumlah Kasus Per hari ini'],
                        datasets: [{
                                label: 'POSITIF',
                                data: [data.positif],
                                backgroundColor: 'rgba(79,129,189,0.2)',
                                borderColor: 'RGB(79,129,189)',
                                borderWidth: 1
                            },
                            {
                                label: 'DIRAWAT',
                                data: [data.dirawat],
                                backgroundColor: 'RGBA(192,80,77,0.2)',
                                borderColor: 'RGB(192,80,77)',
                                borderWidth: 1
                            },
                            {
                                label: 'SEMBUH',
                                data: [data.sembuh],
                                backgroundColor: 'RGBA(155,187,89,0.2)',
                                borderColor: 'RGB(155,187,89)',
                                borderWidth: 1
                            },
                            {
                                label: 'MENINGGAL',
                                data: [data.meninggal],
                                backgroundColor: 'RGBA(75, 192, 192, 0.2)',
                                borderColor: 'RGB(75, 192, 192)',
                                borderWidth: 1
                            },
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
        $.ajax({
            url: "/api/covid/vaksin",
            method: "GET",
            success: function (data) {
                $("#dosis1").text(numeral(data.vaksinasi1).format('0,0'));
                $("#dosis2").text(numeral(data.vaksinasi2).format('0,0'));
                $(".sasaranvaksin").text(numeral(data.totalsasaran).format('0,0'));
                $("#sasaransdmk").text(numeral(data.sasaranvaksinsdmk).format('0,0'));
                $("#sasaranlansia").text(numeral(data.sasaranvaksinlansia).format('0,0'));
                $("#sasaranpublik").text(numeral(data.sasaranvaksinpetugaspublik).format('0,0'));
                persen = data.vaksinasi1 / data.totalsasaran * 100;
                // console.log(persen);
                $("#dari").text(numeral(persen).format('0,0'));
                $("#tvaksin").fadeIn('slow');
                $("#tsasaran").fadeIn('slow');
            }
        });
    });

</script>
@endsection
