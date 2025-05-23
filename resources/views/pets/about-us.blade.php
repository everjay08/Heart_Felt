@extends('layouts.master')
@section('title','About Us')

@section('head')
    <link rel="stylesheet" href="{{asset('/css/about_us.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/home.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
@endsection
@section('content')
<div class="about-us-container">
    <div class="container">
        <div class="row align-items-center ">
            <div class="col-md-6">
                <div class="about-us-img">
                    <img src="images/featured_2.jpg" alt="" class="w-50 img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-content">
                    <div class="about-sub-heading">

                    </div>
                    <h1>About Us</h1>
                    <p>This website is designed to support Canada residents to adopt or offer a pet in adoption. Its important that the person adopting knows that it needs to be with the animal the rest of its life. Also, the person that puts a dog in adoption is responsible for providing as accurate as possible information about the animal.</p>
                </div>
                <h5 class="mb-5">What you can do using HeartFelt: </h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="about-sub">
                            <h6><i class="fa fa-check "></i><span class="ms-2">Put in adoption a pet</span></h6>
                            <h6><i class="fa fa-check"></i><span class="ms-2">Contact the two parts</span></h6>
                            <h6><i class="fa fa-check"></i><span class="ms-2">See hundreds of animals</span></h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="about-sub">
                            <h6><i class="fa fa-check"></i><span class="ms-2">Promote difficult cases</span></h6>
                            <h6><i class="fa fa-check"></i><span class="ms-2">Meet the pet before adoption</span></h6>
                            <h6><i class="fa fa-check"></i><span class="ms-2">Adopt a pet</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
@section('js')
@endsection
