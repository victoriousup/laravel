@extends('layouts.blank')

@push('stylesheets')
    <link href="{{ asset("css/detail.css") }}" rel="stylesheet" />
@endpush

@section('main_container')
        <!-- page content -->
        <div class="right_col" role="main">

          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Detail Page</h3>
              </div>
              <div class="title_right">
                <div class="pull-right">
                  <a class="btn btn-primary" onclick="window.history.go(-1);">Back</a>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="col-md-4 col-sm-4 col-xs-12" style="border:0px solid #e5e5e5;">
                      <h3 class="prod_title">{{ $category->property_name }}</h3>
                      <!--<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>-->
                      <div class="">
                        <h2>Property ID: {{$category->property_id}} </h2>
                      </div>
                      <div class="">
                        <h2>Plan ID: {{$category->plan_id}}</h2>
                      </div>
                      <div class="">
                        <h2>Property SKU: {{$category->property_sku}}</h2>
                      </div>
                      <div class="">
                        <h2>Property Category: {{$category->property_category}}</h2>
                      </div>
                      <div class="">
                        <h2>Property SubCategory: {{$category->property_subcat}}</h2>
                      </div>
                      <div class="">
                        <h2>Address: {{$category->address_city}}</h2>
                      </div>
                      <div class="">
                        <h2>Location: {{$category->property_lat}}, {{$category->property_long}}</h2>
                      </div>
                      <div class="">
                        <h2>Price per Night: {{$category->price_per_night}}</h2>
                      </div>
                      <div class="">
                        <h2>Sleeps: {{$category->property_sleep_cnt}}</h2>
                      </div>
                      <div class="">
                        <h2>BedRooms: {{$category->property_bedroom_cnt}}</h2>
                      </div>
                      <div class="">
                        <h2>BathRooms: {{$category->property_bathroom_cnt}}</h2>
                      </div>
                      <div class="">
                        <h2>Room Type: {{$category->property_room_type}}</h2>
                      </div>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="xpanel">
                            <div class="x_title">
                                <h3>Amenities</h3>
                            </div>
                            <div class="x_content details-list">
                              @foreach (json_decode($category->amenities_item) as $title => $contents)
                              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                  <h2>{{$title}}</h2>
                                  <ul style="padding-left:0px;">
                                      @foreach ($contents as $content )
                                      <li>{{$content}}</li>
                                      @endforeach
                                  </ul>
                              </div>                          
                              @endforeach
                            </div>
                        </div>
                    </div>                          
                  </div>
                </div>
              </div>
                  
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="xpanel">
                      <div class="x_title">
                          <h3>Unavaiable Dates</h3>
                      </div>
                      <div class="x_content details-list">
                        
                        <table class="table table-striped jambo_table bulk_action">
                          <thead>
                            <tr class="headings">
                              <th class="column-title text-center">From </th>
                              <th class="column-title text-center">To</th>
                              <th class="column-title text-center">Count</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $sum = 0; ?>
                            @foreach ($unavailable_dates as $ud)
                            <tr>
                              <td class="text-center">{{$ud->from}}</td>
                              <td class="text-center">{{$ud->to}}</td>
                              <td class="text-center">{{ round(abs(strtotime($ud->from)-strtotime($ud->to))/86400) + 1 }}</td>
                              <?php $sum += round(abs(strtotime($ud->from)-strtotime($ud->to))/86400) + 1; ?>
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                            <td class="text-center"></td>
                            <td class="text-right">Total:</td>
                            <td class="text-center"> {{$sum}}</td>
                          </tfoot>
                        </table>                      
                      </div>
                  </div>
                  <div class="xpanel col-md-6 col-sm-6 col-xs-12">
                      <div class="x_title">
                          <h3>Check In Dates</h3>
                      </div>
                      <div class="x_content details-list">
                        
                        <table class="table table-striped jambo_table bulk_action">
                          <thead>
                            <tr class="headings">
                              <th class="column-title text-center">No </th>
                              <th class="column-title text-center">Check In Only </th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php $k = 0; ?>
                            @foreach ($checkin as $cis)
                            @foreach ($cis as $ci=>$val)
                            <tr>
                              <td class="text-center">{{++$k}}</td>
                              <td class="text-center">{{$ci}}</td>
                            </tr>
                            @endforeach
                            @endforeach
                          </tbody>
                        </table>                      
                      </div>
                  </div>
                  <div class="xpanel col-md-6 col-sm-6 col-xs-12">
                      <div class="x_title">
                          <h3>Check Out Dates</h3>
                      </div>
                      <div class="x_content details-list">
                        
                        <table class="table table-striped jambo_table bulk_action">
                          <thead>
                            <tr class="headings">
                              <th class="column-title text-center">No </th>
                              <th class="column-title text-center">Check Out Only </th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php $k = 0; ?>                          
                            @foreach ($checkout as $cos)
                            @foreach ($cos as $co=>$val)
                            <tr>
                              <td class="text-center">{{++$k}}</td>
                              <td class="text-center">{{$co}}</td>
                            </tr>
                            @endforeach
                            @endforeach
                          </tbody>
                        </table>                      
                      </div>
                  </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="xpanel">
                      <div class="x_title">
                          <h3>Rent Dates</h3>
                      </div>
                      <div class="x_content details-list">
                        
                        <table class="table table-striped jambo_table bulk_action">
                          <thead>
                            <tr class="headings">
                              <th class="column-title text-center">ID</th>
                              <th class="column-title text-center">Rental Date </th>
                              <th class="column-title text-center">Rental Day Price </th>
                              <th class="column-title text-center">Rental Week Price </th>
                              <th class="column-title text-center">Rental Month Price </th>
                              <th class="column-title text-center">Rental Min Stay </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $today = date('Y-m-d'); $k = 0; ?>
                            @foreach ($ret_rental as $dt=>$value)
                            @if ($dt >= $today )
                            <tr>
                              <td class="text-center">{{++$k}}</td>
                              <td class="text-center">{{$dt}}</td>
                              <td class="text-center">{{$value["day_price"]}}</td>
                              <td class="text-center">{{$value["week_price"]}}</td>
                              <td class="text-center">{{$value["month_price"]}}</td>
                              <td class="text-center">{{$value["day_minstay"]}}</td>
                            </tr>
                            @endif
                            @endforeach
                          </tbody>
                        </table>                      
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