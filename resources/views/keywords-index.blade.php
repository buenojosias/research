<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check keywords</title>
</head>
<body>
    <table style="width: 100%" border="1">
        <thead>
            <tr>
                <th>PID</th>
                <th>Json Authors</th>
                <th>Single</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($keywords as $keyword)
                <tr>
                    <td>{{ $keyword->production_id }}</td>
                    <td>
                        @foreach ($keyword->data as $data)
                            {{ $data }}<br>
                        @endforeach
                    </td>
                    <td>
                        {{ $keyword->value }}
                    </td>
                </tr>
            @endforeach
    </table>
</body>
</html>
