<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>

        @foreach($users as $user)
        <h2>{{$user->name}}</h2>
        <h3>{{$user->school->name}}</h3>
        <p>
            {{$user->role->name}}
        </p>
        <p>
            {{$user->student->email}}
        </p>
        <p>
            {{$user->student->school->name}}
        </p>
        <p>
            @foreach ($user -> student -> school -> campuses as $campus)
        <p>{{$campus->name}}</p>
        @endforeach
        <p>
            @foreach($user->allergens as $allergen)
            {{$allergen->name}}
            @endforeach
        </p>
        <p>
            @foreach ($user -> meals as $meals)
        <p>{{$meals->name}}</p>
        @foreach ($meals->allergens as $allergen)
        <p>{{$allergen->name}}</p>
        @endforeach
        @endforeach
        </p>
        <p>{{$user->orders}}</p>
        @foreach ($user ->orders as $order)
        <p>{{$order->status}}</p>
        <p>{{$order->mealbox}}</p>
        <p>{{$order->meal}}</p>
        @endforeach
        @endforeach

    </h1>
</body>

</html>