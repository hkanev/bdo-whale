<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            /*background: #f4f7fc;*/
        }

        .content {
            /*background: #fff;*/
            width: 40%;
            height: 80vh;
            margin: 5% 30%;
        }
        table {
            border-collapse: collapse;
            overflow: auto;
            height: 80vh;
            margin-bottom: 40px;
            border-bottom: 1px solid #999;;
        }
        th:first-child {
            border-radius: 6px 0 0 0;
        }
        th {
            width: 20%;
            text-align: left;
            border: 1px solid #999;
            padding: 0.5rem;
        }
        td:first-child {
            border-left: 1px solid #999;
        }
        td {
            width: 30%;
            border-right: 1px solid #999;
            padding: 0.35rem;
        }
        tr:nth-child(even) {
            background: #dedede;
        }
        tr:hover {
            background: grey;
        }
        .wide {
            width: 60%;
        }
    </style>
</head>
<body class="antialiased">

<div class="content">
    <table>
        <thead>
        <tr class="table-head">
            <th class="wide">Name</th>
            <th>Total</th>
            <th>Today</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{$item->item->name}}</td>
                <td>{{$item->total_items}}</td>
                <td>{{$item->today_items}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
