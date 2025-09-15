<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>NMCH Report</title>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            margin: 20px 25px;
        }

        .pdf-header h2 {
            margin-bottom: 2px;
        }

        .pdf-header h3 {
            margin-top: 5px;
            margin-bottom: 5px;
            text-decoration: underline
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        tr.group-header td {
            background-color: #d9edf7;
            font-weight: bold;
        }

        .nowrap {
            white-space: nowrap;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>

    @yield('content')

</body>

</html>
