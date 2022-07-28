@extends('layouts.main')

@section('content')
    <section class="section-booking bg1-pattern p-t-140 p-b-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-b-30">
                    <div class="t-center">
						<span class="tit2 t-center">
							Please complete this form
						</span>

                        <h3 class="tit3 t-center m-b-35 m-t-2">
                            Seller Profile
                        </h3>
                    </div>

                    <form class="wrap-form-booking" method="post" action="{{ route('Restaurant.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Date -->
                                <span class="txt9">
									Name
								</span>

                                <div class="wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" value="{{ $restaurant->name ?? ""}}" type="text" name="name">
                                    <i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>
                                </div>

                                <!-- Time -->
                                <span class="txt9">
									Category
								</span>

                                <div class="wrap-inputtime size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <!-- Select2 -->
                                    <select class="form-select" name="restaurant_categories_id">
                                        <option value="{{ null }}">Choose category</option>

                                        @foreach($categories as $id => $category)

                                            @if($restaurant->restaurant_categories_id == $id)
                                                <option selected value="{{ $id }}">{{ $category }}</option>
                                            @else
                                                <option value="{{ $id }}">{{ $category }}</option>
                                            @endif

                                        @endforeach

                                    </select>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <!-- Name -->
                                <span class="txt9">
									Phone number
								</span>

                                <div class="wrap-inputname size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" type="text" value="{{ $restaurant->phone_number ?? ""}}" name="phone_number">
                                </div>


                                <!-- Email -->
                                <span class="txt9">
									Account number
								</span>

                                <div class="wrap-inputemail size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" type="text" value="{{ $restaurant->account_number ?? ""}}" name="account_number">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <span class="txt9">
									Address
								</span>

                                <div class="wrap-inputemail size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" type="text" value="{{ $restaurant->address->address ?? ""}}" name="address">
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div id="map"></div>
                                <br>
                                <button class="btn3 flex-c-m size13 txt11 trans-0-4" type="button" id="confirmPosition">Confirm Position</button>
                                <br>
                                <script>
                                    // Get element references
                                    var confirmBtn = document.getElementById('confirmPosition');
                                    var onClickPositionView = document.getElementById('onClickPositionView');
                                    var onIdlePositionView = document.getElementById('onIdlePositionView');

                                    // Initialize locationPicker plugin
                                    var lp = new locationPicker('map', {
                                        setCurrentPosition: true, // You can omit this, defaults to true
                                    }, {
                                        zoom: 15 // You can set any google map options here, zoom defaults to 15
                                    });

                                    // Listen to button onclick event
                                    confirmBtn.onclick = function () {
                                        // Get current location and show it in HTML
                                        var location = lp.getMarkerPosition();
                                        document.getElementById('address').value = location.lat + ',' + location.lng;
                                    };

                                    // Listen to map idle event, listening to idle event more accurate than listening to ondrag event
                                    google.maps.event.addListener(lp.map, 'idle', function (event) {
                                        // Get current location and show it in HTML
                                        var location = lp.getMarkerPosition();
                                        onIdlePositionView.innerHTML = 'The chosen location is ' + location.lat + ',' + location.lng;
                                    });


                                </script>
                                <input type="hidden" id="address" name="addresses" value="">


                            </div>
                        </div>

                        @if($errors->all())
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->all()[0] }}
                            </div>

                        @endif

                        <div class="wrap-btn-booking flex-c-m m-t-6">
                            <!-- Button3 -->
                            <button type="submit" class="btn3 flex-c-m size13 txt11 trans-0-4">
                                Save
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-6 p-b-30 p-t-18">
                    <div class="wrap-pic-booking size2 bo-rad-10 hov-img-zoom m-l-r-auto">
                        <img src="{{ asset('rCategories/img/booking-01.jpg') }}" alt="IMG-OUR">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
