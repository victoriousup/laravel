@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Products List</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="row search_contain">
                    <form class="form search_form" method="POST" action="/products">
                      {{ csrf_field() }}
                      {{ method_field('POST') }}
                      <div class="col-md-1 pull-right">
                        <button class="form-control pull-right btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
                      </div>
                      <div class="col-md-2 pull-right form-group">
                          <select class="form-control select2" name="price">
                            <option value="asc" {{ (old('price')=='asc')?'selected':''}}>Price Ascending</option>
                            <option value="desc" {{ (old('price')=='asc')?'':'selected'}}>Price Descending</option>
                          </select>
                      </div>
                      <div class="col-md-2 pull-right form-group">
                          <select class="form-control select2" name="category">
                            <option value="">- Select -</option>
                            @foreach ($countries as $country)
                              <option value="{{$country->property_category}}" {{ (old('category')==$country->property_category)?'selected':''}}>{{$country->property_category}}</option>
                            @endforeach
                          </select>
                      </div>
                    </form>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        {{ $categories->links() }}
                      </div>        
                      <div class="clearfix"></div>
                      @foreach ($categories as $category)
                      <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i>{{$category->property_category}} - {{$category->property_subcat}}</i></h4>
                            <div class="col-xs-12">
                              <h2>{{$category->property_name}}</h2>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-building" style="min-width:15px"></i>        Property ID: <strong class="purple" >{{$category->property_id}} </strong></li>
                                <li><i class="fa fa-dollar"  style="min-width:15px;"></i>        Price Per Night: <strong class="purple" >{{$category->price_per_night}}</strong></li>
                                <li><i class="fa fa-home"  style="min-width:15px;"></i>          Address: <strong class="purple" >{{$category->address_city}}</strong></li>
                                <li><i class="fa fa-plus-circle"  style="min-width:15px;"></i>   SKU: <strong class="purple" >{{$category->property_sku}}</strong></li>
                                <li><i class="fa fa-map-marker"  style="min-width:15px;"></i>    Location: <strong class="purple" >{{$category->property_lat}},{{$category->property_long}} </strong></li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <p class="ratings">
                                <a>{{$category->property_rating==''?'0%':$category->property_rating}}</a>
                                <?php
                                $score = (int)(str_replace('%','',$category->property_rating));
                                for ($i=1; $i<=5; $i++){
                                    if ($score >= $i*20)
                                        echo '<a href="#"><span class="fa fa-star"></span></a>';
                                    else if (($i*20 - $score)<20)
                                        echo '<a href="#"><span class="fa fa-star-half-o"></span></a>';
                                    else
                                        echo '<a href="#"><span class="fa fa-star-o"></span></a>';
                                }
                                ?>
                              </p>
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <a type="button" class="btn btn-primary btn-xs pull-right" href="{{ route('detail', $category->plan_id) }}">
                                <i class="fa fa-heart"></i>&nbsp; View Details
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                      <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        {{ $categories->links() }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

    <!-- footer content -->
    <footer>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
@endsection