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

                                <!-- Phone -->
                                <span class="txt9">
									Address
								</span>

                                <div class="wrap-inputphone size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" type="text" value="{{ $restaurant->address ?? ""}}" name="address">
                                </div>

                                <!-- Email -->
                                <span class="txt9">
									Account number
								</span>

                                <div class="wrap-inputemail size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" type="number" value="{{ $restaurant->account_number ?? ""}}" name="account_number">
                                </div>
                            </div>
                        </div>

                        <div class="wrap-btn-booking flex-c-m m-t-6">
                            <!-- Button3 -->
                            <button type="submit" class="btn3 flex-c-m size13 txt11 trans-0-4">
                                Book Table
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
