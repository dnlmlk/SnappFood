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

                    <form class="wrap-form-booking" method="post" action="{{ route('Schedule.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Date -->
                                <span class="txt9">
									Saturday
								</span>

                                <div class="w-50 wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" value="{{ old('saturday1') ?? $schedule->saturday[0] ?? ""}}" type="text" name="saturday1">
                                    <i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>
                                </div>

                                <!-- Time -->
                                <span class="txt9">
									Sunday
								</span>

                                <div class="w-50 wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" value="{{ old('sunday1') ?? $schedule->sunday[0] ?? ""}}" type="text" name="sunday1">
                                    <i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>
                                </div>

                                <span class="txt9">
									Monday
								</span>

                                <div class="w-50 wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" value="{{ old('monday1') ?? $schedule->monday[0] ?? ""}}" type="text" name="monday1">
                                    <i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>
                                </div>

                                <span class="txt9">
									Tuesday
								</span>

                                <div class="w-50 wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" value="{{ old('tuesday1') ?? $schedule->tuesday[0] ?? ""}}" type="text" name="tuesday1">
                                    <i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>
                                </div>

                                <span class="txt9">
									Wednesday
								</span>

                                <div class="w-50 wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" value="{{ old('wednesday1') ?? $schedule->wednesday[0] ?? ""}}" type="text" name="wednesday1">
                                    <i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>
                                </div>

                                <span class="txt9">
									Thursday
								</span>

                                <div class="w-50 wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" value="{{ old('thursday1') ?? $schedule->thursday[0] ?? ""}}" type="text" name="thursday1">
                                    <i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>
                                </div>

                                <span class="txt9">
									Friday
								</span>

                                <div class="w-50 wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" value="{{ old('friday1') ?? $schedule->friday[0] ?? ""}}" type="text" name="friday1">
                                    <i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <span class="txt9">
									To
								</span>

                                <div class="w-50 wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" value="{{ old('saturday2') ?? $schedule->saturday[1] ?? ""}}" type="text" name="saturday2">
                                    <i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>
                                </div>

                                <span class="txt9">
									To
								</span>

                                <div class="w-50 wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" value="{{ old('sunday2') ?? $schedule->sunday[1] ?? ""}}" type="text" name="sunday2">
                                    <i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>
                                </div>

                                <span class="txt9">
									To
								</span>

                                <div class="w-50 wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" value="{{ old('monday2') ?? $schedule->monday[1] ?? ""}}" type="text" name="monday2">
                                    <i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>
                                </div>

                                <span class="txt9">
									To
								</span>

                                <div class="w-50 wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" value="{{ old('tuesday2') ?? $schedule->tuesday[1] ?? ""}}" type="text" name="tuesday2">
                                    <i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>
                                </div>

                                <span class="txt9">
									To
								</span>

                                <div class="w-50 wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" value="{{ old('wednesday2') ?? $schedule->wednesday[1] ?? ""}}" type="text" name="wednesday2">
                                    <i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>
                                </div>

                                <span class="txt9">
									To
								</span>

                                <div class="w-50 wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" value="{{ old('thursday2') ?? $schedule->thursday[1] ?? ""}}" type="text" name="thursday2">
                                    <i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>
                                </div>

                                <span class="txt9">
									To
								</span>

                                <div class="w-50 wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" value="{{ old('friday2') ?? $schedule->friday[1] ?? ""}}" type="text" name="friday2">
                                    <i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>
                                </div>

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