<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="{{url('/')}}/css/app.css">
</head>
<body class="h-screen flex flex-col justify-between">
<header class="bg-blue-900 p-4 text-white text-xl flex justify-between">
    <h1><a href="/">LA BOUTIQUE</a></h1>
    <nav>
        <ul>
            <li>
                <a href="{{url('/')}}/cart"><i class="fas fa-shopping-cart"></i> <span class="text-2xl">{{ count(Session::get('cart',[])) }}</span></a>
            </li>
        </ul>
    </nav>
</header>

@yield("main")

<footer class="bg-gray-700 p-5 text-lg text-center text-white">
    Copyright &copy; 2021 Team CNAM Vierzon
</footer>
</body>
</html>
