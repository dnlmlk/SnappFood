@foreach($foods as $food)
    <div class="col-sm-6 col-lg-4 all pizza">
        <div class="box">
            <div>
                <div class="img-box">
                    <img src="{{ asset($food->image_path) }}" alt="">
                </div>
                <div class="detail-box">
                    <h5 class="text-center">
                        {{ $food->name }}
                    </h5>
                    <p>
                                        <span class="category">
                                            {{ DB::table('food_categories')->where('id', $food->food_categories_id)->get()[0]->name }}<br>
                                        </span>
                        @isset($food->raw_material)
                            <span class="material">
                                                Materials : {{ $food->raw_material }}
                                            </span>
                        @endisset
                    </p>

                    @if($food->discount_id)
                        <div class="options">

                            <h6 class="{{ 'discount' }}">
                                {{ $food->price }}$
                            </h6>

                            <span class="discountBox">
                                                    {{ $food->discount->value . "% " . ' Sale' }}
                                            </span>
                        </div>

                        <h5>
                            {{ $food->toArray()['discounted_price'] . '$'}}
                        </h5>

                    @else

                        <div class="options">
                            <h6>
                                {{ $food->price }}$
                            </h6>
                        </div>
                    @endif
                    <div class="btn-box">
                        <a href="{{ route('ManageFood.show', $food->id) }}">Edit</a>
                    </div>
                    <div class="btn-box_2">
                        <form action="{{ route('ManageFood.destroy', $food->id) }}" method="post">
                            @csrf
                            @method('delete')

                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
