<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rowdies:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        *{
            padding: 0;
            margin: 0;
        }

        h1,h2,h3,h4,h5,h6{
            font-family: Rowdies;
        }

        .icon-container {
            width: 3%;
            color: white;
            background-color: #051224;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 25px 25px;
            gap:20px;
        }

        .icon-container i {
            cursor: pointer;
            font-size: 13px;
        }

        /*Tabla*/
        .table{
            border: 2px solid transparent;
        }

        th{
            color: #007bff;
            background-color: #051224;
        }

        .th-top10{
            color: #051224;
            background-color: white;
        }

        .tr-hover:hover{
            border-bottom: 2px solid #051224;
            box-shadow: 0 20px 20px -20px blue;
            transition: border-bottom-color 0.4s;
        }

        .group {
            display: flex;
            line-height: 28px;
            align-items: center;
            position: relative;
            max-width: 190px;
            margin: 20px;
            margin-right: 50px;
        }

        .inputSearch {
            width: 100%;
            height: 40px;
            line-height: 28px;
            padding: 0 1rem;
            padding-left: 2.5rem;
            border: 2px solid transparent;
            border-radius: 8px;
            outline: none;
            background-color: white;
            color: #0d0c22;
            transition: .3s ease;
        }

        .inputSearch::placeholder {
            color: #051224;
        }

        .inputSearch:focus, inputSearch:hover {
            outline: none;
            border-color: #007bff;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(77, 133, 255, 0.1);
        }

        .icon {
            position: absolute;
            left: 1rem;
            fill: #9e9ea7;
            width: 1rem;
            height: 1rem;
        }

        /*MENU*/
        .nav-link {
            text-decoration: none;
            position: relative;
            border-bottom: 2px solid transparent;
            transition: border-bottom 0.3s ease;
        }

        .nav-link.active {
            border-bottom-color: #007bff;
        }
    </style>
</head>
<body>

@include('header')

@yield('content')



<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
</body>
</html><?php
