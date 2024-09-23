<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check authors</title>
</head>
<body>
    <table style="width: 100%" border="1">
        <thead>
            <tr>
                <th>PID</th>
                <th>Json Authors</th>
                <th>Relation Authors</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productions as $production)
                <tr>
                    <td>{{ $production->id }}</td>
                    <td>
                        @foreach ($production->authors as $author)
                            {{ $author['forename'] }} {{ $author['lastname'] }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($production->authorss as $author)
                            {{ $author->forename }} {{ $author->lastname }}<br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
    </table>
</body>
</html>
