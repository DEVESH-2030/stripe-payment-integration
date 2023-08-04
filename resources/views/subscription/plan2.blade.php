<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        $textOutline: #c6c6c6;

        @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro');



        body {
            font-family: 'Source Sans Pro', sans-serif;
        }

        .credit-card-title {
            font-size: 22px;
        }

        .container-body {
            position: absolute;
            width: 100%;
            height: 100vh;
            display: none;
        }

        .form-container {
            margin-top: 6%;
        }

        .or {
            text-align: center;
            padding: 1%;
            font-size: 20px;
            color: #a4a4a4;
        }

        .payment-overview {
            position: relative;
            text-align: center;
            background: #f1f1f1;
            padding: 5%;
            padding-top: 120px;
            -webkit-border-top-left-radius: 5px;
            -webkit-border-bottom-left-radius: 5px;
            -moz-border-radius-topleft: 5px;
            -moz-border-radius-bottomleft: 5px;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        .payment-details {
            background: #fff;
            padding: 5%;
            padding-top: 2%;
            -webkit-border-top-right-radius: 5px;
            -webkit-border-bottom-right-radius: 5px;
            -moz-border-radius-topright: 5px;
            -moz-border-radius-bottomright: 5px;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }





        .preloader {
            font-size: 20px;
            text-align: center;
            position: absolute;
            height: 100vh;
            width: 100%;
            background: #fff;
            z-index: 111;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .spinner {
            width: 40px;
            height: 40px;

            position: relative;
            margin: 100px auto;
        }

        .double-bounce1,
        .double-bounce2 {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: #01ad69;
            opacity: 0.6;
            position: absolute;
            top: 0;
            left: 0;

            -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
            animation: sk-bounce 2.0s infinite ease-in-out;
        }

        .double-bounce2 {
            -webkit-animation-delay: -1.0s;
            animation-delay: -1.0s;
        }

        @-webkit-keyframes sk-bounce {

            0%,
            100% {
                -webkit-transform: scale(0.0)
            }

            50% {
                -webkit-transform: scale(1.0)
            }
        }

        @keyframes sk-bounce {

            0%,
            100% {
                transform: scale(0.0);
                -webkit-transform: scale(0.0);
            }

            50% {
                transform: scale(1.0);
                -webkit-transform: scale(1.0);
            }
        }

        /* Medium devices (desktops, 992px and up) */
        @media screen and (min-width: 768px) {
            .payment-overview {
                height: 400px;
            }

            .payment-details {
                height: 400px;
            }
        }


        .credit-card-icon {
            float: right;
            font-size: 23px;
        }

        @media screen and (max-width: 750px) {
            .form-container {
                margin-top: 1%;
            }

            .payment-overview {
                height: auto;
                padding: 5%;
                padding-top: 5%;
            }

            .payment-details {
                height: auto;
                padding: 5%;
            }
        }

        .product-payment {
            font-size: 26px;
            color: #5f5f5f;
        }

        .price-payment {
            font-size: 50px;
            color: #00af6c;
        }

        .long-number {
            width: 100%;
            border: 1px solid $textOutline;
            padding: 3%;
        }

        input {
            color: #9e9fa0;
            border: 0px solid #a6a7ab;
            width: 100%;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            /* display: none; <- Crashes Chrome on hover */
            -webkit-appearance: none;
            margin: 0;
            /* <-- Apparently some margin are still there even though it's hidden */
        }

        textarea:focus,
        input:focus,
        select:focus {
            outline: none;
        }

        .security-code {
            width: 25%;
            border: 1px solid #c6c6c6;
            padding: 3%;
            margin-top: 3%;
        }

        .security-code-p {
            width: 70%;
            padding: 7%;
            padding-top: 3%;
            font-size: 15px;
            float: right;
            color: #9e9fa0;
            margin: 0 0 0px;
            text-align: start;
        }

        .year-select {
            color: #9e9fa0;
            width: 38%;
            margin-left: 2%;
            border: 1px solid $textOutline;
            padding: 3%;
            text-align: center;
        }

        .month-select {
            color: #9e9fa0;
            width: 58%;
            border: 1px solid $textOutline;
            padding: 3%;
        }

        .proceed-button {
            background: #00af6c;
            width: 100%;
            padding: 4%;
            border: 0px solid green;
            color: #fff;
            font-size: 20px;
            letter-spacing: 1px;
            font-weight: 700;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }

        .paypal-button {
            background: #197faf;
            width: 100%;
            padding: 5%;
            border: 0px solid green;
            color: #fff;
            font-size: 20px;
            letter-spacing: 1px;
            font-weight: 700;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }

        .paypal-icon {
            font-size: 22px;
            color: #fff;
        }

        select {

            /* styling */
            background-color: white;
            border: thin solid blue;
            border-radius: 4px;
            display: inline-block;
            font: inherit;
            line-height: 1.5em;
            padding: 0.5em 3.5em 0.5em 1em;

            /* reset */

            margin: 0;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            -webkit-appearance: none;
            -moz-appearance: none;
        }


        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }



        select.minimal {
            background-image:
                linear-gradient(45deg, transparent 50%, gray 50%),
                linear-gradient(135deg, gray 50%, transparent 50%),
                linear-gradient(to right, #ccc, #ccc);
            background-position:
                calc(100% - 20px) calc(1em + 2px),
                calc(100% - 15px) calc(1em + 2px),
                calc(100% - 2.5em) 0.5em;
            background-size:
                5px 5px,
                5px 5px,
                1px 1.5em;
            background-repeat: no-repeat;
        }

        select.minimal:focus {
            background-image:
                linear-gradient(45deg, green 50%, transparent 50%),
                linear-gradient(135deg, transparent 50%, green 50%),
                linear-gradient(to right, #ccc, #ccc);
            background-position:
                calc(100% - 15px) 1em,
                calc(100% - 20px) 1em,
                calc(100% - 2.5em) 0.5em;
            background-size:
                5px 5px,
                5px 5px,
                1px 1.5em;
            background-repeat: no-repeat;
            border-color: green;
            outline: 0;
        }


        select:-moz-focusring {
            color: transparent;
            text-shadow: 0 0 0 #000;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body>

    <div class="preloader">
        <div class="spinner">
            <p>
            <div class="double-bounce1"></div>
            </p>
            <p>
            <div class="double-bounce2"></div>
            </p>
        </div>
        <p>Transferring you to payment</p>
    </div>


    <div class="container-body">


        <div class="container form-container">
            <div
                class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-7 col-xlg-12">
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-xlg-4 payment-overview">
                    <p class="price-payment">$49</p>
                    <p class="product-payment">Readymade</p>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8 col-lg-8 col-xlg-8 payment-details">
                    <p class="credit-card-title">Credit Card Details</p>
                    <p><input type="number" class="long-number" required placeholder="Account Number"></p>
                    <select class="month-select minimal">
                        <option>Expiry Month</option>
                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                        <option>04</option>
                        <option>05</option>
                        <option>06</option>
                        <option>07</option>
                        <option>08</option>
                        <option>09</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                    </select>
                    <select class="year-select minimal">
                        <option>Expiry Year</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                        <option>24</option>
                        <option>25</option>
                        <option>26</option>
                        <option>27</option>
                        <option>28</option>
                        <option>29</option>
                    </select>
                    <input type="number" class="security-code" placeholder="eg. 123">
                    <p class="security-code-p">3 or 4 digits found on the signature strip</p>

                    <div class="bottom-buttons">

                        <div class="proceed">
                            <button class="proceed-button">Proceed</button>
                        </div>

                        <div class="or">Or</div>

                        <div class="paypal">
                            <button class="paypal-button">Pay with <i class="fa fa-paypal paypal-icon"
                                    aria-hidden="true"></i>ayPal</button>
                        </div>

                    </div>

                </div>



            </div>
        </div>
    </div>
    </div>
    <script>
$('.container-body').css('background','url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/769286/kr84rpmcb0w-khara-woods-min.jpg)')
.css('background-position','center center').css('background-size','cover').css('background-attachment','fixed')
  .waitForImages(function() {
	$('.container-body').fadeIn("slow");
	$('.preloader').fadeOut("slow");
}, $.noop, true);1
    </script>
</body>

</html>
