<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        <a class="navbar-brand" href="<?php echo Router::url('/') ?>">Playground</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="#" style="color: white;"><span class="glyphicon glyphicon-time"></span> <span id="servertime">Loading server time...</span></a></li>
        </ul>
    </div><!-- /.container-fluid -->
</nav>