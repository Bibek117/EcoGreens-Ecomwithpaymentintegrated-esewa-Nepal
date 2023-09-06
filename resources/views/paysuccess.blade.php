<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>esewa-sucess</title>
    <style>
        .container{
            width:100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .container img{
            height:300px;
            width:500px;
            display: block;
        }
        .container h3{
            color:black;
            font-weight: bolder;
        }
        button{
            padding: 20px 40px;
            border:1px solid black;          
        }
        a{
            color:black;
            font-size: 1.2rem;
            text-decoration: none;
        }
    </style>
</head>
<body> 

    <div class="container">
          <img src="{{ asset('frontend/img/paysucess.png') }}" alt="payment_success">
          <h3>Your payment has been successfully completed and order has been placed</h3>
          <button><a href="/">Back to Home</a></button>
    </div>
 </body>
</html>