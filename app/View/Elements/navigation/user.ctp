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

        <ul class="nav navbar-nav">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard', 'administration' => false)) ?>">Dashboard</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'groups', 'action' => 'index', 'administration' => false)) ?>">Groups</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo AuthComponent::user('display_name') ?> <span class="caret"></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'logout', 'administration' => false)) ?>">Go Out</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- /.container-fluid -->
</nav>

<?php if (AuthComponent::user('role_id') < 2): ?>
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo Router::url('/') ?>">Playground Administration</a>
        </div>

        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage Quizzes <span class="caret"></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo Router::url(array('controller' => 'quizzes', 'action' => 'add', 'administration' => true)) ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add New Quiz</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo Router::url(array('controller' => 'quizzes', 'action' => 'index', 'administration' => true)) ?>"><span class="glyphicon glyphicon-book"></span> Quiz List</a></li>
                </ul>
            </li>
            <li><a href="#">Manage Groups</a></li>
        </ul>
    </div><!-- /.container-fluid -->
</nav>
<?php endif; ?>