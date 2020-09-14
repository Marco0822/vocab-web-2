happy testing the 3rd freaking time :(
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="styles/login-style.css">
  <script src="https://kit.fontawesome.com/02c5616d87.js" crossorigin="anonymous"></script>
</head>
<body>



  <div class="big-container" id="big-container">
    <div class="header">
      <h1>Sinkin</h1>
      <button id="pop-div" onclick="showLogin()">Log In/ Register</button>
    </div>
  </div>

  
  <div class="main-div" id="main-div">
    <div class="form-div sign-in-container">
      <form action="#">
        <h1>Login</h1>
        <div class="social-container">
          <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social"><i class="fab fa-google"></i></a>
        </div>
        <h4>Or use your own account</h4>
        <input id="login-username-input" type="text" placeholder="Name/Email:">
        <input id="login-password-input" type="password" placeholder="Password">
        <h5>Forgot your password?</h5>
        <button id="form-login-btn">Login</button>
      </form>
    </div>

    <div class="form-div sign-up-container">
      <form action="#">
        <h1>Register</h1>
        <div class="social-container">
          <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social"><i class="fab fa-google"></i></a>
        </div>
        <h4>Or set up your own account</h4>
        <input id="username-input" type="text" placeholder="Name">
        <input id="email-input" type="text" placeholder="Email">
        <input id="password-input" type="password" placeholder="Password">
        <h5>Forgot your password?</h5>
        <button id="form-register-btn">Register</button>
      </form>
      
    </div>
  
    <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-left overlay-section">
            <h2>Already a member? Sign in here</h2>
            <h5>Welcome back! We wish you a good experience with us</h5>
            <button id="sign-in-btn" onclick="openLeft()">Sign In</button>
          </div>
          <div class="overlay-right overlay-section">
            <h2>Not a member? Register here</h2>
            <h5>Nice to meet you!</h5>
            <button id="register-btn" onclick="closeLeft()">Register</button>
          </div>
        </div>
    </div>
  </div>
  
  


</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" 
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" 
        crossorigin="anonymous">
</script>

<script>

$( document ).ready(function() {

  $("#form-register-btn").on('click', function(){
    var Username = $("#username-input").val();
    var Email = $("#email-input").val();
    var Password = $("#password-input").val();

    if (Username == "" || Email == "" || Password == "") {
      alert("Empty fields");
      
    } else {
      console.log("Email".Email);
        $.ajax({
          url: 'ajax/loginRegister.php',
          method: 'POST',
          dataType: 'text',
          data: {
            isRegister: "true",
            Username: Username,
            Email: Email,
            Password: Password
          }
                
        }).done(function(returnedData){
            alert(returnedData);
        })
    }
  });



  $("#form-login-btn").on('click', function(){
    var UsernameOrEmail = $("#login-username-input").val();
    var Password = $("#login-password-input").val();

    if (UsernameOrEmail == "" || Password == "") {
      alert("Empty fields");
      
    } else {
      console.log("Email".Email);
        $.ajax({
          url: 'ajax/loginRegister.php',
          method: 'POST',
          dataType: 'text',
          data: {
            isRegister: "false",
            UsernameOrEmail: UsernameOrEmail,
            Password: Password
          }
                
        }).done(function(returnedData){
          if (returnedData == "FGot to home.php") {
            window.location.href = "home.php";
            //alert(returnedData);
          } else {
            alert(returnedData);
          }
          
           
        })
    }
  });


  $('body').click(function(e){

    if (e.target.id == 'pop-div' || e.target.id == 'main-div' || $(e.target).parents('#main-div').length > 0) {
        // Clicked stuff inside main-div
        console.log("Clicked stuff inside main-div or pop-div");
    } else {
        //Clicked stuff outside
        console.log("Clicked stuff outside");
        var mainDiv = document.getElementById("main-div");
        var bigContainer = document.getElementById("big-container");
        
        mainDiv.classList.remove("show-login");
        bigContainer.classList.remove("show-login");
    }
  });

  

});


</script>

<script>



function showLogin() {
  var mainDiv = document.getElementById("main-div");
  var bigContainer = document.getElementById("big-container");
  mainDiv.classList.add("show-login");
  bigContainer.classList.add("show-login");
}

function openLeft() {
  var mainDiv = document.getElementById("main-div");
  mainDiv.classList.add("left-panel-active");
}

function closeLeft() {
  var mainDiv = document.getElementById("main-div");
  mainDiv.classList.remove("left-panel-active");
}

</script>
</html>
  


