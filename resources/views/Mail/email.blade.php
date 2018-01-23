<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
</head>
<body>
<div class="center-block" id="app" style="margin: 0 auto">
    <h6>Dear {{ $user->name }}</h6>
    <p>It is less than hour to do task {{ $task->title }}</p>
</div>

</body>
</html>