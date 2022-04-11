<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <h1>User Feedback</h1>
    <p>Name: {{ $contacts['name'] }}</p>
    <p>Email: {{ $contacts['email'] }}</p>
    <p>Phone Number: {{ $contacts['phone_number'] }}</p>
    <p>Service Id: {{ $contacts['service_id'] }}</p>
    <p>Message: {{ $contacts['review'] }}</p>

</body>

</html>