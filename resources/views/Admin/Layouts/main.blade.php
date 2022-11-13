<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @can('AuthMaster')
        Ini Halaman untuk Auth Master
    @endcan

    @can('AuthCRO')
        Ini Halaman untuk Auth CRO
    @endcan

    @can('AuthSalesManager')
        Ini Halaman untuk Auth Sales Manager
    @endcan

    @can('AuthSales')
        Ini Halaman untuk Auth Sales
    @endcan

    <form action="{{ URL::to('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>

</html>
