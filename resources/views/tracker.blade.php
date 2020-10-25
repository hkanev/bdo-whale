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
            margin: 0 auto;
        }

        .main {
            background-image: url("images/bdo-background.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
        .header, .footer {
            background: #16132A;
            height: 60px;
        }

        .content {
            /*background: #fff;*/
            width: 40%;
            height: calc(100vh - 120px);
            overflow: hidden;
        }
        table {
            position: absolute;
            left: 57%;
            top: 120px;
            border-collapse: collapse;
            overflow: auto;
            height: calc(100vh - 240px);
            overflow-y: scroll;
            margin-bottom: 40px;
            border-bottom: 1px solid #999;
            display: -moz-box;
            display: -webkit-box;
            display: box;
            cursor: pointer;
            color: #16132A;
        }
        table::-webkit-scrollbar {
            width: 0;  /* Remove scrollbar space */
            background: transparent;
            display: none;
        }
        th:first-child {
            border-radius: 6px 0 0 0;
        }
        th:last-child{
            border-radius: 0 6px 0 0;
        }

        th {
            width: 20%;
            text-align: left;
            border-left: 1px solid #999;
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
        tr:nth-child(odd) {
            background: white;
        }
        tr:nth-child(22) td:first-child{
            /*border-radius: 6px !important;*/
        }
        .table-head{
            background: #dedede !important;
        }
        tr:hover {
            background: #adadad;
        }
        .wide {
            width: 60%;
        }
    </style>
</head>
<body class="antialiased">
<div class="header">

</div>
<div class="main">
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
</div>
<div class="footer"></div>

</body>
</html>
