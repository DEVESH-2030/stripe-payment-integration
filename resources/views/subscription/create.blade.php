<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stripe Payment Integration</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .alert.parsley {
            margin-top: 5px;
            margin-bottom: 0px;
            padding: 10px 15px 10px 15px;
        }

        .check .alert {
            margin-top: 20px;
        }

        .credit-card-box .panel-title {
            display: inline;
            font-weight: bold;
        }

        .credit-card-box .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 80%;
        }

        .credit-card-box .display-tr {
            display: table-row;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>

<body id="app-layout">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="text-primary text-center">
                <strong>Pay Invoice</strong>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table">
                    <div class="row display-tr">
                        <strong>Your Plan: <span> {{ $product->name }} </span></strong>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <form action="{{ url('order-post') }}" method="POST" data-parsley-validate id="payment-form">
                            @csrf

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">X</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @elseif ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">X</button>
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif

                            {{-- email --}}
                            <div class="form-group" id="product-group">
                                <label for="email"> Email:</label>
                                <input type="text" class="form-control" name="email" value="{{ auth()->user()->email ?? '' }}" disabled>
                            </div>

                            {{-- price --}}
                            <div class="form-group" id="product-group">
                                <label for="price"> Price:</label>
                                <input type="text" class="form-control" name="price" required data-stripe="price"
                                    data-parsley-type="price" value="{{ $product->price->unit_amount }}" id="price"
                                    required data-parsley-class-handler="#product-group" disabled>
                            </div>

                            {{-- card number --}}
                            <div class="form-group" id="cc-group">
                                <label for="card_number">Card number:</label>
                                <input type="text" id="card_number" name="card_number" class="form-control" required
                                    data-stripe="number" data-parsley-type="number" maxlength="16"
                                    data-parsley-trigger="change focusout" data-parsley-class-handler="#cc-group" />
                            </div>

                            {{-- cvc number --}}
                            <div class="form-group" id="ccv-group">
                                <label for="cvc_number">CVC (3 or 4 digit number):</label>
                                <input type="text" id="cvc_number" name="cvc_number" class="form-control" required
                                    data-stripe="cvc" data-parsley-type="number" data-parsley-trigger="change focusout"
                                    maxlength="4" data-parsley-class-handler="#ccv-group" />
                            </div>

                            {{-- expire month --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" id="exp-m-group">
                                        <label for="expiration_month">Ex. Month</label>
                                        <select name="expiration_month" id="expiration_month" class="form-control"
                                            required data-stripe="exp-month">
                                            <?php
                                            $currentMonth = date('m');
                                            for ($i = 1; $i <= 12; $i++) {
                                                echo "<option value=\"$i\"> $i </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                {{-- expire year --}}
                                <div class="col-md-6">
                                    <div class="form-group" id="exp-y-group">
                                        <label for="expiration_year">Ex. Year</label>
                                        <select name="expiration_year" id="expiration_year" class="form-control"
                                            required data-stripe="exp-year">
                                            <!-- Generate options for the next 10 years -->
                                            <?php
                                            $currentYear = date('Y');
                                            for ($i = $currentYear; $i <= $currentYear + 10; $i++) {
                                                echo "<option value=\"$i\">$i</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- payment buttoon --}}
                            <div class="form-group">
                                <button class="btn btn-lg btn-block btn-primary btn-order" id="submitBtn"
                                    style="margin-bottom: 10px;"> Pay <!--$ -->
                                    ₹{{ $product->price->unit_amount ?? 0 }}</button>
                            </div>

                            {{-- error message --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="payment-errors" style="color: red;margin-top:10px;"></span>
                                </div>
                            </div>
                            {{-- {!! Form::close() !!} --}}
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        window.ParsleyConfig = {
            errorsWrapper: '<div></div>',
            errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
            errorClass: 'has-error',
            successClass: 'has-success'
        };
    </script>

    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        Stripe.setPublishableKey("<?php echo env('STRIPE_KEY'); ?>");
        jQuery(function($) {
            $('#payment-form').submit(function(event) {
                var $form = $(this);
                $form.parsley().subscribe('parsley:form:validate', function(formInstance) {
                    formInstance.submitEvent.preventDefault();
                    alert();
                    return false;
                });
                $form.find('#submitBtn').prop('disabled', true);
                Stripe.card.createToken($form, stripeResponseHandler);
                return false;
            });
        });

        function stripeResponseHandler(status, response) {
            var $form = $('#payment-form');
            if (response.error) {
                $form.find('.payment-errors').text(response.error.message);
                $form.find('.payment-errors').addClass('alert alert-danger');
                $form.find('#submitBtn').prop('disabled', false);
                $('#submitBtn').button('reset');
            } else {
                var token = response.id;
                $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                $form.get(0).submit();
            }
        };
    </script>
</body>

</html>
