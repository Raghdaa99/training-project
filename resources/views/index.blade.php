<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Design Bootstrap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css">-->
    <link rel="stylesheet" href="{{asset('cms/home/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('cms/home/css/aos.css')}}" type="text/css">
</head>

<body>

<!-- Start Upper bar -->
<div class="upper-bar">
    <div class="container">
        <div class="row">
            <div class="col-sm text-left">
                <i class="fa fa-phone"></i> <span>+970-8-2882840</span>,
                <i class="fa fa-envelope-o"></i> edu@alaqsa.edu.ps
            </div>
            <div class="col-sm text-right">

                <span>جامعة الاقصى</span>
                <i class="nav-icon fas fa-home"></i>
            </div>
        </div>
    </div>
</div>
<!-- End Upper bar -->


<!-- Start Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <!--        <a class="navbar-brand" href="#"><span>Elite</span><span>Crop</span></a>-->
        <!--        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"-->
        <!--                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">-->
        <!--            <span class="navbar-toggler-icon"></span>-->
        <!--        </button>-->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">الصفحة الرئيسية</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        الخدمات الالكترونية
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{url('cms/student/login')}}">تسجيل دخول الطالب</a>
                        <a class="dropdown-item" href="{{url('cms/supervisor/login')}}">تسجيل دخول المشرف</a>
                        <a class="dropdown-item" href="{{url('cms/trainer/login')}}">تسجيل دخول المدرب</a>
                        <a class="dropdown-item" href="{{url('cms/admin/login')}}">تسجيل دخول الادمن</a>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</nav>
<!-- End Navbar -->

<!-- Start Slider -->
<div class="slider">
    <div class="container">
        <!--        <div class="row">-->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <!--                    <h1>We’re an Independent <br>Design and <span>Development </span> <br> Agency.</h1>-->
                <div class="overlay"></div>
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('cms/home/img/image_panel.jpg')}}" alt="First slide"
                         height="450">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('cms/home/img/home.jpg')}}" alt="Second slide" height="450">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('cms/home/img/home2.png')}}" alt="Third slide" height="450">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!--        </div>-->
    </div>

</div>
<!-- End Slider -->


<!-- Start Overview -->
<div class="overview text-center">
    <div class="container">
        <div class="row" data-aos="zoom-out" data-aos-duration="2000"
             data-aos-delay="50">
            <h2 class="h1">التدريب الميداني</h2>

            <p>التدريب الميداني هو مجموعة من المهارات والخبرات التي يتم توفيرها للطالب ضمن إطار مؤسسي أو ضمن أحد مجالات
                الممارسة ، بهدف مساعدة الطالب على اكتساب مختلف المعارف والخبرات الميدانية والمهارات الفنية</p>

        </div>
    </div>
</div>


<!-- End Overview -->


<!-- Start choose us-->
<div class="choose-us">
    <div class="container">
        <div class="row">

            <div class="col-6">
                <h1 class="text-right">
                    أبرز أهداف التدريب الميداني للطلاب/الطالبات
                </h1>
                <ul class="text-right">
                    <li>اتاحة الفرصة للطالب لكسب الخبرة العملية والتدريب قبل التخرج</li>
                    <li>تعميق فهم الطالب للعلوم النظرية التي تلقوها في مجال تخصصاتهم</li>
                    <li>تدريب الطالب على تحمل المسؤولية والتقيد بالمواعيد</li>
                    <li>تدريب الطالب على الاحتكاك بالاخرين والاستماع الى ارائهم</li>
                    <li>معرفة مدى الاستفادة من الطالب المتدرب وتظيفه بعد تخرجه</li>
                </ul>
            </div>
            <div class="col-6 img">
                <div data-aos="zoom-in-up" data-aos-duration="1000">
                    <img src="{{asset('cms/home/img/imageLeft.jpg')}}" alt="..." width="400px" height="200px"/>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- End choose us-->

<hr>
<!-- Start Features -->
<div class="features text-center">
    <div class="container">
        <h2 class="text-center">المتطلبات الاكاديمية للتدريب</h2>
        <p class="section-description text-center ">لكي يصبح الطالب مرشحا لتسجيل التدريب الميداني عليه استيفاء الشروط
            التالية</p>
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <i class="fa fa-check fa-3x rounded-circle"></i>
                <p> يسمح للطالب بتسجيل ساعات التدريب الميداني بعد إتمام 100 ساعة معتمدة</p>
            </div>
            <div class="col-sm-6 col-lg-3">
                <i class="fa fa-check fa-3x rounded-circle"></i>
                <p>أن يوافق القسم على برنامج مقدم من الطالب يوضح كيفية التدريب</p>
            </div>
            <div class="col-sm-6 col-lg-3">
                <i class="fa fa-check fa-3x rounded-circle"></i>
                <p> يجوز للطالب التنسيق مع المشرف لبدء التدريب قبل التسجيل الرسمي للدورة</p>
            </div>
            <div class="col-sm-6 col-lg-3">
                <i class="fa fa-check fa-3x rounded-circle"></i>
                <p>أن يكون الطالب متفرغا للتدريب</p>
            </div>
        </div>
    </div>

</div>
<!-- End Features -->

<hr>
<div class="requirement">
    <div class="container">
        <div data-aos="zoom-in-up" data-aos-duration="1000">
            <h2 class="text-center">متطلبات اجتياز التدريب الميداني </h2>
            <div class="row  justify-content-center">
                <div class="section-description">
                    <p class="text-justify">
                        <span class="num-req">1</span>
                        <span>نموذج حضور الطالب : </span>
                        النموذج الذي يوضح حضور الطالب لدى جهة التدريب طوال الفترة المحددة له
                    </p>
                </div>
            </div>
            <div class="row  justify-content-center">

                <div class="section-description">
                    <p class="text-justify">
                        <span class="num-req">2</span>
                        <span>
درجة تقييم جهة التدريب : </span>
                        وهو التقييم المعبأ من قبل جهة التدريب ، حيث يعتمد على قياس المهارات المكتسبة خلال التدريب
                        والاعتماد
                        على الذات والالمام بطبيعة العمل المسند له و أنظمته
                    </p>
                </div>

            </div>
            <div class="row  justify-content-center">
                <div class="section-description">
                    <p class="text-justify">
                        <span class="num-req">3</span>
                        <span>درجة تقييم المشرف على التقرير النهائي للتدريب: </span>

                        يقوم المشرف على التدريب بتقييم التقرير النهائي الذي سيقوم الطالب بتسلميه بعد انتهاء فترة التدريب
                        وهو
                        يعتمد وهو يعتمد على معايير واضحة تقيس مدى انجاز الطالب أثتناء تدريبه من خلال توثيقه لانجازاته في
                        جهة
                        التدريب
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Start Footer -->
<div class="footer">
    <div class="container">
        <div class="row">


            <div class="col-md-4">
                <div class="contact">
                    <h2>بيانات الاتصال</h2>
                    <ul class="list-unstyled">
                        <li>غزة - فلسطين</li>
                        <li>هاتف : +970-8-2882840</li>
                        <li>فاكس : +970-8-2882840</li>
                        <li>البريد الإلكتروني : edu@alaqsa.edu.ps</li>

                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact">
                    <h2>أقسام الكلية</h2>
                    <ul class="list-unstyled">
                        <li>قسم علوم الحاسوب والمعلومات</li>
                        <li>قسم الشبكات والهواتف النقالة</li>
                        <li>قسم تكنولوجيا المعلومات التطبيقية</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <img class="brand-image img-circle elevation-3" src="{{asset('cms/home/img/logo.png')}}" alt="" height="200px" width="200px"/>
            </div>
        </div>
    </div>
</div>
<!-- End Footer-->

<!--Start CopyRight -->
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col text-left">
                COPYRIGHT 2022 &copy; ALL RIGHTS RESERVED
            </div>
            <div class="col text-right">
                <ul>
                    <li>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-youtube"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!--End CopyRight -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="{{asset('cms/home/js/main.js')}}"></script>
<script src="https://kit.fontawesome.com/445cb9f0b1.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="{{asset('cms/home/js/aos.js')}}" type="text/javascript"></script>
<script>
    AOS.init();
</script>
</body>

</html>
