<form onsubmit="return false;" id="sign-up-form" >
    <h2>Registration</h2>

    <div class="form-group">
        <input type="text" class="from-control" name="signUpForm[login]" id="exampleInputLogin1" placeholder="Write ur login">
        <small id="loginHelp" class="form-text text-muted"><br>login must consist of at least 6 values (letters and numbers)</small>
    </div>

    <div class="form-group">
        <input type="password" class="from-control" name="signUpForm[password]" id="exampleInputPassword1" placeholder="Write ur password">
        <small id="passwordHelp" class="form-text text-muted" ><br>login must consist of at least 6 values: letters(1upper,1lower) special character(min 1), numbers(min 1)</small>
    </div>

    <div class="form-group">
        <input type="password" class="from-control" name="signUpForm[confirm_password]" placeholder="Repeat ur password">
    </div>

    <div class="form-group">
        <input type="email" class="from-control" name="signUpForm[email]" id="email" placeholder="Write ur email">
    </div>

    <div class="form-group">
        <input type="text" class="from-control" name="signUpForm[name]" placeholder="Write ur name">
        <small id="nameHelp" class="form-text text-muted"><br>name must consist of 2 values (letters and numbers)</small>
    </div>

    <div class="alert alert-danger display-none" id="sign-up-errors">

    </div>

    <div class="alert alert-success display-none" id="sign-up-success">

    </div>

    <button type="button" class="btn btn-block btn-primary" id="sign-up-button">Sign up</button>
</form>