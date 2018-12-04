@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            @if(Session::has('flash_message_error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{!! session('flash_message_error') !!}</strong>
                </div>
            @endif           
            @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{!! session('flash_message_success') !!}</strong>
                </div>
            @endif 
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <h2>Update Account</h2>
                    <form id="accountForm" name="accountForm" method="post" action="{{ url('/account') }}">{{ csrf_field() }}
                        <input type="text" id="name" name="name" placeholder="Name" value="{{ $userDetails->name }}" />
                        <input type="text" id="address" name="address" placeholder="Address" value="{{ $userDetails->address }}" />
                        <input type="text" id="city" name="city" placeholder="City" value="{{ $userDetails->city }}" />
                        <input type="text" id="state" name="state" placeholder="State" value="{{ $userDetails->state }}" />
                        <select id="country" name="country">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->country_name }}" @if ($country->country_name == $userDetails->country)
                                    selected
                                @endif>{{ $country->country_name }}</option>
                            @endforeach
                        </select>
                        <input type="text" id="pincode" name="pincode" placeholder="Pincode" value="{{ $userDetails->pincode }}" style="margin-top:10px;" />
                        <input type="text" id="mobile" name="mobile" placeholder="Mobile" value="{{ $userDetails->mobile }}" />
                        <button type="submit" class="btn btn-default">Update</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <h2>Update Password</h2>
                    <form id="passwordForm" name="passwordForm" action="{{ url('/update-user-pwd') }}" method="post"> {{ csrf_field() }}
                        <input type="password" name="current_pwd" id="current_pwd" placeholder="Current Password">
                        <span id="chkPwd"></span>
                        <input type="password" name="new_pwd" id="new_pwd" placeholder="New Password">
                        <input type="password" name="confirm_pwd" id="confirm_pwd" placeholder="Confirm Password">
                        <button type="submit" class="btn btn-default">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!--/form-->

@endsection