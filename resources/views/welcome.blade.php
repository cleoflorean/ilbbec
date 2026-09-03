@extends('layouts.app')

@section('title', 'ILBBEC - International Logistics & Business Baccalaureate English Center | ULBI')
@section('meta_description', 'ILBBEC is the premier Student Activity Unit at Universitas Logistik & Bisnis Internasional (ULBI) dedicated to English proficiency, global logistics & business acumen, debate leadership, and international networking.')

@section('content')
    @include('partials.hero')
    @include('partials.about')
    @include('partials.activities')
    @include('partials.events')
    @include('partials.gallery')
    @include('partials.testimonials') 
    @include('partials.faq')
@endsection
