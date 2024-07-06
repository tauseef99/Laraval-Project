<!-- resources/views/signIn.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-form {
            background: #f7f7f7;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px #000;
        }
        .login-form h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="login-form col-md-6 col-lg-4">
            <h1>Sign In</h1>
            <form method="post" action="/user/signIn" class="form-horizontal" role="form">
                @csrf
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="form-group">
                    <label class="control-label" for="username">UserName<em>*</em></label>
                    <input type="text" name="username" id="username" required="true" class="form-control"/>
                </div> 
                <div class="form-group">
                    <label class="control-label" for="email">Email<em>*</em></label>
                    <input type="email" name="email" id="email" required="true" class="form-control"/> 
                </div> 
                <div class="form-group">
                    <label class="control-label" for="password">Password<em>*</em></label>
                    <input type="password" name="password" id="password" required="true" class="form-control"/> 
                    <input type="checkbox" onclick="myFunction()">Show Password
                </div>
                <div class="form-group text-center"> 
                    <input type="submit" name="signIn" id="signIn" value="Sign In" class="btn btn-primary mt-4"/>
                </div>     
            </form>
        </div>
    </div>
    <script>
             function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
        </script>
       
</body>
</html>
