@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')
    <!-- page content -->
    <div class="right_col" role="main">
        <!--This page represented count of properties by category, subcategory -->
        @foreach ($categories as $category)
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats text-center">
                <div class="count">{{$category->properties_cnt}}</div>
                <h4>{{$category->subcategory}}</h4>
                <h3>{{$category->category}}</h3>
            </div>
        </div>
        @endforeach
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <footer>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
@endsection