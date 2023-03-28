<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Mail</title>
</head>
<body>
        <h2 style="text-center">New Priority Taks</h2>
        <p>Title : {{ $todo->title }}</p>
        <p>Description : {{ $todo->desc }}</p>
        <p>Status : {{ $todo->status }}</p>
</body>
</html>