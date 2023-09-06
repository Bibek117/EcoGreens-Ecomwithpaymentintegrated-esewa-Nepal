@extends('layouts.checkout')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    {{-- <section class="checkout spad">
      <div class="container" id="checkout">
      </div>
    </section> --}}
    <!-- Checkout Section End -->
    <section id="check-out">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-12">
                    <h3>Billing Details</h3>
                    <form id="checkout-form" method="post" action="#">
                       @csrf
                        <div class="form-row pt-4">
                            <div class="form-group col-md-6">
                                <label for="input-first">First Name <span class="required-mark">*</span></label>
                                <input type="text" name="first_name" class="form-control" value="{{old('first_name',$user->firstname)}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-last">Last Name <span class="required-mark">*</span></label>
                                <input type="text" name="last_name" class="form-control" value="{{old('last_name',$user->lastname)}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                <label class="d-block" for="input-country">Country <span
                                        class="required-mark">*</span></label>
                                <select name="country">
                                    <option selected value="Nepal">Nepal</option>
                                </select>
                            </div>

                            <div class="form-group  col-md-6">
                                <label class="d-block" for="input-district">District <span
                                        class="required-mark">*</span></label>
                                <select name="district">
                                    <option selected value="kathmandu">Kathmandu</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-town">Town / City <span class="required-mark">*</span></label>
                            <input name="city" type="text" class="form-control" value="{{old('city',$user->city)}}">
                        </div>

                        <div class="form-group">
                            <label for="input-street">Street Address <span class="required-mark">*</span></label>
                            <input name="street_address" type="text" class="form-control" value="{{old('street_address',$user->address)}}">
                        </div>

                        <div class="form-row pt-4">
                            <div class="form-group col-md-6">
                                <label for="input-phone">Phone <span class="required-mark">*</span></label>
                                <input name="phone" type="text" class="form-control" value="{{old('phone',$user->phone)}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-email">Email <span class="required-mark">*</span></label>
                                <input name="email" type="email" class="form-control" value="{{old('email',$user->email)}}">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 col-12 bg1">
                    <h3 class="pt-5">Your Order</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            @php
                                $total = 0; // Initialize total
                            @endphp
                            @foreach ($carts as $index => $cart)
                                @php
                                    $total += $cart['price'] * $cart['quantity']; // Add item price to total
                                @endphp
                                <div class="row pt-2">
                                    <div class="col-md-5 col-12">
                                        <h6>Product</h6>
                                        <p> {{ $cart['name'] }} </p>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <h6>Total</h6>
                                        <p>({{ $cart['quantity'] }} x {{ $cart['price'] }})
                                            = Rs{{ $cart['price'] * $cart['quantity'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </li>
                        <li class="list-group-item">
                            <div class="row pt-2">
                                <div class="col-md-9 col-12">
                                    <h6>SubTotal</h6>
                                </div>
                                <div class="col-md-3 col-12">
                                    <p>Rs {{ $total }} </p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row pt-2">
                                <div class="col-md-9 col-12">
                                    <h6>Total</h6>
                                </div>
                                <div class="col-md-3 col-12">
                                    <p>Rs {{ $total + 100 }}</p>
                                </div>
                                <p style="font-size: 0.7rem">Additonal Rs 100 for shipping all over Nepal</p>
                            </div>
                        </li>
                    </ul>
                    <div class="form-group form-check pt-4">
                        <input type="checkbox" class="form-check-input" id="terms">
                        <label class="form-check-label" for="terms">
                            I’ve read and accept the terms & conditions
                        </label>
                    </div>
                    <button type="submit" id="esewa" class="btn btn-danger checkout_btn"
                        style="background-color: #41a124; border-color: #41a124;">Pay With eSewa</button>
                </div>
            </div>
        </div>
    @endsection
    @push('footer')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.0/axios.min.js"
            integrity="sha512-aoTNnqZcT8B4AmeCFmiSnDlc4Nj/KPaZyB5G7JnOnUEkdNpCZs1LCankiYi01sLTyWy+m2P+W4XM+BuQ3Q4/Dg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(function() {
                $('#esewa').click(function(e) {
                    e.preventDefault();
                    let form = document.getElementById('checkout-form');
                    let data = {
                        firstname: form['first_name'].value,
                        lastname: form['last_name'].value,
                        country: form['country'].value,
                        district: form['district'].value,
                        city: form['city'].value,
                        street_address: form['street_address'].value,
                        phone: form['phone'].value,
                        email: form['email'].value,
                    };
                   // console.log(data)

                    axios.post("{{ route('api.esewa.checkout') }}", data).then(res => {

                        if (res.data.id === 'undefined') {
                            return false;
                        }
                        var path = "https://uat.esewa.com.np/epay/main";
                        var params = {
                            amt: res.data.total_price,
                            psc: 0,
                            pdc:0,
                            txAmt: 0,
                            tAmt: res.data.total_price ,
                            pid: res.data.ref_id,
                            scd: "EPAYTEST", //test merchent 
                            su: "http://localhost:8000/payment-success",
                            fu: "http://localhost:8000/payment-fail"
                        }
                        var form = document.createElement("form");
                        form.setAttribute("method", "POST");
                        form.setAttribute("action", path);

                        for (var key in params) {
                            var hiddenField = document.createElement("input");
                            hiddenField.setAttribute("type", "hidden");
                            hiddenField.setAttribute("name", key);
                            hiddenField.setAttribute("value", params[key]);
                            form.appendChild(hiddenField);
                        }

                        document.body.appendChild(form);
                        form.submit();
                    });
                });
            });
        </script>
    @endpush
