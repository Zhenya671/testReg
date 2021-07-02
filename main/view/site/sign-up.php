<form onsubmit="return false;" id="sign-up-form">
    <h2>Registration</h2>

    <div class="form-group">
        <input type="text" class="from-control" name="signUpForm[login]" placeholder="Write ur login">
    </div>

    <div class="form-group">
        <input type="password" class="from-control" name="signUpForm[password]" placeholder="Write ur password">
    </div>

    <div class="form-group">
        <input type="password" class="from-control" name="signUpForm[confirm_password]" placeholder="Repeat ur password">
    </div>

    <div class="form-group">
        <input type="email" class="from-control" name="signUpForm[email]" placeholder="Write ur email">
    </div>

    <div class="form-group">
        <input type="text" class="from-control" name="signUpForm[name]" placeholder="Write ur name">
    </div>

    <div class="alert alert-danger display-none" id="sign-up-errors">

    </div>

    <div class="alert alert-success display-none" id="sign-up-success">

    </div>

    <button type="button" class="btn btn-block btn-primary" id="sign-up-button">Sign up</button>
</form>