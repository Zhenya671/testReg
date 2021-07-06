<div class="text-center row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">

        <div class="jumbotron">
            <h3>Hello, <?= htmlspecialchars($_SESSION['name']);?>.
                </h3>
        </div>
        <a type="button" href="site/logout/view/main" class="btn btn-danger">exit profile</a>

    </div>
    <div class="col-sm-2"></div>
</div>