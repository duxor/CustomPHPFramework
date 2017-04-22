<?php require_once "views/layouts/master.php"; ?>

<form action="/login" method="post" class="form-horizontal col-sm-6">

    <h1 class="text-center">Login</h1>

    <div class="form-group">
        <label class="control-label col-sm-4">Email: </label>
        <div class="col-sm-8">
            <input name="email" type="email" placeholder="email" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Password: </label>
        <div class="col-sm-8">
            <input name="password" type="password" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4"></label>
        <div class="col-sm-8">
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </div>
    </div>
</form>