<?php

return [
    "types" => [
        "default" => \App\Enums\ShippingType::TAPIN,
        "type" => [
            \App\Enums\ShippingType::TAPIN => [
                'shop_id'=> '8a047055-7abb-49ef-9511-b42cd3d4d2d9',
                'token'=> 'jwt eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiYjdhZWQ2NjctNzdhMy00ZjgyLWFhMDAtYmI3YmRkMzExZjNkIiwidXNlcm5hbWUiOiIwOTE5MTE3NDI0NSIsImVtYWlsIjoidG93bGlkMTQwMEB5YWhvby5jb20iLCJleHAiOjI1MzEyMjc2ODMsIm9yaWdfaWF0IjoxNjY3MjI3NjgzfQ.7-a27DIzxGK3QsipvOFw-G7V-JUhInqbH9mgqnlmUk8',
                // pay_type
                'is_pishtaz'=>1,
                // gram
                'package_weight'=>15,
                //online
                'pay_type'=>1,
                'is_rial'=>10
            ]
        ]
    ]
];
