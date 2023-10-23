@extends('frontend.layout.app')
@section('title')
    Create
@endsection
@section('cont')
    <div class="custom-cont userpet-cont">
        <div>
            <h5>What kind of pets have you had?</h5>

            <div class="input-cont">
                <section class="input-label"><span>Kind of Petsss</span> <span><i class="fa-solid fa-circle-info" style="color: #8a8a8a;"></i></span></section>
                <input type="text" placeholder="Enter min 3 characters">
            </div>
        </div>
    </div>
@endsection