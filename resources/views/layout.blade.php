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

        .header ul {
            width: 60%;
            display: flex;
            justify-content: center;
        }
        .header li {
            display: inline-block;
            cursor: pointer;
            text-align: center;
            margin: 5px;

        }
        .header li a {
            color: #f1e7e7;
            padding: 10px 30px;
            height: 30px;
            font-size: 1.2em;
            text-decoration: none;
        }
        .header a:hover, .header li.active a{
            border-bottom: 2px solid #bcdada;
        }

        .footer {
            color: white;
        }

        .main {
            background-image: url("images/bdo-background.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
        .header, .footer {
            display: flex;
            justify-content: center;
            background: #16132A;
            height: 60px;
        }

        .footer p {
            color: #f1e7e7;
            font-size: 1.3em;
        }

        .content {
            /*background: #fff;*/
            width: 40%;
            height: calc(100vh - 120px);
            overflow: hidden;
        }
        table {
            position: absolute;
            left: 60%;
            top: 135px;
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
            width: 45%;
        }
    </style>
</head>
<body class="antialiased">
<div class="header">
    <ul>
        <li @if(strtolower($period) === 'today')class="active" @endif><a href="/">Today</a></li>
        <li @if(strtolower($period) === 'yesterday')class="active" @endif><a href="/yesterday">Yesterday</a></li>
        <li @if(strtolower($period) === 'last 3 days')class="active" @endif><a href="/lastThreeDays">Last 3 Days</a></li>
        <li @if(strtolower($period) === 'last week')class="active"@endif><a href="/lastWeek">Last Week</a></li>
        <li @if(strtolower($period) === 'last month')class="active"@endif><a href="/lastMonth">Last Month</a></li>
    </ul>
</div>
<div class="main">
    <div class="content">
        @yield('content')
    </div>
</div>
<div class="footer" id="footer">
    <p>Latest update: {{ $fetchInfo->finished_at }} (GMT)</p>
</div>
</body>
</html>
