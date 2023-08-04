<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stripe Products</title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Basic&family=Poppins&display=swap");

        :root {
            --background: #3c343d;
            --background-border: #c9c1ca;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Poppins;
            height: 100vh;
            padding: 32px;
            display: grid;
            place-items: center;
            background-color: var(--background);
        }

        .gallery {
            display: flex;
            background-color: var(--background);
            gap: 16px;
            scale: 1.6;
        }

        .card {
            position: relative;
            left: 0px;
            width: 140px;
            height: 160px;
            background-color: white;
            border-radius: 8px;
            transition: 1000ms all;
            transform-origin: center left;
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.5);
            outline: 1px solid var(--background);
            overflow: hidden;
        }

        .card img {
            height: 160px;
            object-fit: cover;
            border-radius: 4px;
        }

        .card:hover {
            cursor: pointer;
            transform: scale(1.15);
        }

        .card:hover figcaption {
            font-size: 0.6rem;
            position: absolute;
            height: 80px;
            width: 160px;
            display: flex;
            align-items: end;
            background: linear-gradient(to top,
                    rgba(0, 0, 0, 0.9) 0%,
                    rgba(0, 0, 0, 0) 100%);
            color: white;
            left: 0px;
            bottom: 0px;
            padding-left: 12px;
            padding-bottom: 10px;
        }

        .card:hover~.card {
            font-weight: bold;
            cursor: pointer;
            transform: translateX(22px);
        }
    </style>
</head>

<body>
    <div class="gallery">
        {{-- @dd($getProducts) --}}
        @foreach ($getProducts as $product)
        <article class="card">
            <figure>
                <p>price</p>
                @if ($product->name == 'Daily')
                <img src="https://raw.githubusercontent.com/atherosai/ui/main/gallery-04/images/forest.jpg" alt="{{$product->name}}">

                @elseif ($product->name == 'Monthly')
                <img src="https://raw.githubusercontent.com/atherosai/ui/main/gallery-04/images/lavender-field.jpg" alt="{{$product->name}}">

                @endif
                <img src="https://raw.githubusercontent.com/atherosai/ui/main/gallery-04/images/wooden-bridge.jpg" alt="{{$product->name}}">
                <figcaption>
                    <h3>{{ $product->name ?? ''}}</h3>
                </figcaption>
            </figure>
        </article>
        @endforeach
        <!-- Pictures from Freepik -->
    </div>
</body>

</html>
