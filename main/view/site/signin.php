<form onsubmit="return false;" id="sign-in-form">
    <h2>Authorization</h2>
    <div class="form-group">
        <input type="text" name="signInForm[login]" placeholder="Write ur login">
    </div>

    <div class="form-group">
        <input type="password" name="signInForm[password]" placeholder="Write ur password">
    </div>

    <div class="alert alert-danger display-none" id="sign-in-errors">

    </div>

    <div class="form-group">
        <input type="checkbox" class="form-check-input" name="check" id="exampleCheck">
        <label class="form-check-label" for="exampleCheck">Remember</label>
    </div>

    <button type="button" class="btn btn-block btn-primary" id="sign-in-button">Sign in</button>

</form>