@extends('front.base')

@section('contact-active', 'active')
@section('content')


    <!--Breadcrumb Section Start-->
    <section class="breadcrumb-bg">
        <div class="theme-container container ">
            <div class="site-breadcumb white-clr">

                <ol class="breadcrumb breadcrumb-menubar">
                    <li> <a href="#"> Home </a> Contact  </li>
                </ol>
            </div>
        </div>
    </section>
    <!--Breadcrumb Section End-->


    <!-- Shop Starts-->
    <section class="contact-wrap sec-space-bottom">
        <div class="container rel-div pt-50">

            <div class="row">
                <div class="pt-50 col-md-8">
                    <h3 class="fsz-25 text-center"><span class="light-font">Contact </span> <strong>Havana </strong>  </h3>
                    <h6 class="sub-title-1 text-center">ORGANIC STORE</h6>

                    <div class="contact-form pt-50">
                        <form class="contact-form row">
                            <div class="form-group col-sm-4">
                                <input class="form-control" placeholder="Name" required="" type="text">
                            </div>
                            <div class="form-group col-sm-4">
                                <input class="form-control" placeholder="Email" required="" type="email">
                            </div>
                            <div class="form-group col-sm-4">
                                <input class="form-control" placeholder="Phone" type="text">
                            </div>
                            <div class="form-group col-sm-12">
                                <textarea class="form-control"  placeholder="Message" cols="12" rows="4"></textarea>
                            </div>
                            <div class="form-group col-sm-12 text-center pt-15">
                                <button class="theme-btn" type="submit"> <strong> SEND EMAIL </strong> </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="contact-details">
                        <h3 class="fsz-25"><span class="light-font">Havana  </span> <strong>Address </strong>  </h3>
                        <h6 class="sub-title-1 pb-15">ORGANIC STORE</h6>

                        <h5 class="clr-txt fsz-12 pt-15">Havana Global Solutions Nig. Ltd.</h5>
                        <p>Suite 24, Odu'a Shopping Centre, Idi-Ape, Iwo-Road, Ibadan</p>
                        <ul>
                            <li> <strong>Call line 1:  </strong> <i>+234 (906) 117 3187</i> </li>
                            <li> <strong>Call line 2:  </strong> <i>+1 (773) 543 2705</i> </li>
                            <li> <strong>Call line 3:  </strong> <i>+234 (803) 391 4305</i> </li>
                            <li> <strong>Call line 4:  </strong> <i>+234 (903) 167 5175</i> </li>
                            <li> <strong>Call line 5:  </strong> <i>+234 (906) 116 9615</i> </li>
                            <li> <strong>Email 1: </strong> <i> <a href='mailto:customercare@havanaglobals.com'>customercare@havanaglobals.com</a> </i> </li>
                            <li> <strong>Email 2: </strong> <i> <a href='mailto:oyinloye.ayo@havanaglobals.com'>oyinloye.ayo@havanaglobals.com</a> </i> </li>
                            <li> <strong>Email 3: </strong> <i> <a href='mailto:sunkanmi.oyedola@havanaglobals.com'>sunkanmi.oyedola@havanaglobals.com</a> </i> </li>
                        </ul>

                    </div>
                </div>
            </div>


        </div>
    </section>
    <!-- / Shop Ends -->


@endsection