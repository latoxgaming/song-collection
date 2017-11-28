<?php
require_once("database.php");
?>
<html>
<head>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap core JavaScript  -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>


    <!-- Data Tables -->
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

    <?php if (isset($_GET['theme']) AND $_GET['theme'] == "dark") { ?>
        <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.css">
<?php } else { ?>
        <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.css">
        <!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <?php } ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">


    <!-- sweet alerts -->
    <script src="https://dev1.it-services-rau.de/sweetalerts/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://dev1.it-services-rau.de/sweetalerts/dist/sweetalert.css">


    <!-- Custom Accordion Style-->
    <style>
        .panel-group .panel-heading + .panel-collapse > .panel-body {
            border: 1px solid #252525;
        }

        .panel-group,
        .panel-group .panel,
        .panel-group .panel-heading,
        .panel-group .panel-heading a,
        .panel-group .panel-title,
        .panel-group .panel-title a,
        .panel-group .panel-body,
        .panel-group .panel-group .panel-heading + .panel-collapse > .panel-body {
            border-radius: 2px;
            border: 0;
        }

        .panel-group .panel-heading {
            padding: 0;
        }

        .panel-group .panel-heading a {
            display: block;
            background: #338AB9;
            color: #ffffff;
            padding: 15px;
            text-decoration: none;
            position: relative;
        }

        .panel-group .panel-heading a.collapsed {
        <?php
if ($_GET['theme'] == "dark"){
echo "background: #656565;";
} else {
echo "background: #c0c0c0;";
}
?>
            color: inherit;
        }

        .panel-group .panel-heading a:after {
            content: '-';
            position: absolute;
            right: 20px;
            top: 5px;
            font-size: 30px;
        }

        .panel-group .panel-heading a.collapsed:after {
            content: '+';
        }

        .panel-group .panel-collapse {
            margin-top: 5px !important;
        }

        .panel-group .panel-body {
        <?php
     if ($_GET['theme'] == "dark"){
         echo "background: #444444;";
     } else {
         echo "background: #F5F5F5;";
     }
     ?>
            padding: 15px;
        }

        .panel-group .panel {
           background-color: transparent;
        }

        .panel-group .panel-body p:last-child,
        .panel-group .panel-body ul:last-child,
        .panel-group .panel-body ol:last-child {
            margin-bottom: 0;
        }

        .btn-default-ios {
            color: #007aff;
            background-color: #fff;
            border-color: #007aff;
        }

        .btn-default-ios:hover, .btn-default-ios:focus, .btn-default-ios:active, .btn-default-ios.active, .open > .btn-default-ios.dropdown-toggle {
            color: #fff;
            background-color: #007aff;
            border-color: #007aff;
        }

        .btn-success-ios {
            color: #56a20c;
            background-color: #fff;
            border-color: #56a20c;
        }

        .btn-success-ios:hover, .btn-success-ios:focus, .btn-success-ios:active, .btn-success-ios.active, .open > .btn-success-ios.dropdown-toggle {
            color: #fff;
            background-color: #5bad0d;
            border-color: #56a20c;
        }

        .btn-danger-ios {
            color: #ff1900;
            background-color: #fff;
            border-color: #ff1900;
        }

        .btn-danger-ios:hover, .btn-danger-ios:focus, .btn-danger-ios:active, .btn-danger-ios.active, .open > .btn-danger-ios.dropdown-toggle {
            color: #fff;
            background-color: #ff1900;
            border-color: #ff1900;
        }
    </style>


    <script>


        $(document).ready(function () {
            $('#songs').DataTable({
                "pageLength": 25,
                "paging": true,
                "ordering": true,
                "info": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
                }
            });
        });



        function deleteModal(url, title, text) {
            swal({

                "title": title,
                "text": text,
                "type": "warning",
                "showCancelButton": true,
                "closeOnConfirm": false,
                "closeOnCancel": false,
                "cancelButtonText": 'Nein',
                "confirmButtonText": 'Ja'


            }, function (isConfirm) {
                if (isConfirm) {
                    swal({
                        "title": "Song wurde gelöscht!",
                        "type": "success",
                        "showConfirmButton": false
                    });
                    setTimeout(function () {
                        // Redirect the user after 2 seconds
                        window.location.href = url;
                    }, 1300);

                } else {
                    swal({
                        "title": "Song wurde nicht gelöscht!",
                        "type": "error",
                        "timer": 2000
                    });

                }
            });
        }



        $(document).ready(function () {
            $('#add-form').on('submit', function (e) {  //Don't foget to change the id form
                $.ajax({
                    url: 'add.php', //===PHP file name====
                    data: $(this).serialize(),
                    type: 'POST',
                    success: function (data) {
                        console.log(data);
                        //Success Message == 'Title', 'Message body', Last one leave as it is

                        var song = document.getElementById("song").value;

                        swal({
                            html: true,
                            title: song + " wurde hinzugefügt!",
                            type: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });
                        setTimeout(function () {
                            // Redirect the user after 2 seconds
                            window.location.href = "";
                        }, 2200);
                    },
                    error: function (data) {
                        //Error Message == 'Title', 'Message body', Last one leave as it is
                        swal("Oops...", "Something went wrong :(", "error");
                    }
                });
                e.preventDefault(); //This is to Avoid Page Refresh and Fire the Event "Click"
            });
        });



    </script>

    <title>Songsammlung</title>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div class="collapse navbar-collapse" id="navbarColor03">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <?php if(isset($_GET['theme']) AND $_GET['theme'] == "dark"){
                        $action ="light";
                    }else {
                        $action = "dark";
                    }
                    ?>
                    <a href="?theme=<?php echo $action;?>"  class="btn btn-outline-info"> <?php echo $action;?> Theme</a>
                </li>
                &nbsp;&nbsp;
                <li class="nav-item">
                    <?php
                    if (isset($_GET['theme'])){
                        $ref = "?theme=".$_GET['theme']."&delete";
                        $txt = "delete";
                    } else {
                        $ref = "?delete";
                        $txt = "delete";
                    }

                    if (isset($_GET['theme']) AND isset($_GET['delete'])){
                        $ref = "?theme=".$_GET['theme'];
                        $txt = "normal";
                    } elseif (!isset($_GET['theme']) AND isset($_GET['delete'])){
                        $ref = "";
                        $txt = "normal";
                    }

                    ?>
                    <a href="<?php echo $ref; ?>" class="btn btn-outline-danger"><?php echo $txt; ?> mode</a>

                </li>
            </ul>

                <?php if (isset($_GET['delete'])){ ?>
                    <form class="form-inline my-2 my-lg-0" role="form" method="post">
                        <div class="form-group">
                            <?php if ($_POST['password'] != "10kmidjs") {
                                $text = "Login"; ?>
                                <input type="password" class="form-control mr-sm-2" name="password"
                                       placeholder="Passwort"> <?php } else {
                                $text = "Logout";
                            } ?>
                        </div>
                        <button type="submit" class="btn btn-secondary my-2 my-sm-0"><?php echo $text; ?></button>

                    </form>
                <?php }?>

        </div>
    </nav>

    <br/>

<div class="container">

    <div class="jumbotron">
        <h1>Songsammlung
            <small><span class="glyphicon glyphicon-music"></span></small>
        </h1>
        <p class="lead">Meine Sammlung an Songs zum Singen oder f&uuml;r Partys</p>
        <hr/>


        <div class="panel-group" id="accordion">


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            <?php if ($_GET['theme'] == "dark") echo "<font color='black'>" ?> Neuen Song hinzufügen </font>
                        </a>
                    </h4>
                </div><!--/.panel-heading -->
                <div id="collapseThree" class="panel-collapse collapse">
                    <div class="panel-body">

                        <form class="form" id="add-form" method="post">
                            <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label" for="song">  <?php if ($_GET['theme'] == "dark") echo "<font color='black'>" ?> Song: </font></label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="song"
                                           placeholder="Hier den Songnamen eintragen" name="song" required>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label" for="artist">  <?php if ($_GET['theme'] == "dark") echo "<font color='black'>" ?> Artist: </font></label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="artist"
                                           placeholder="Hier die Sänger/ Band eintragen" name="artist">
                                </div>
                            </div>
                            </div>

                            <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label" for="song_url">  <?php if ($_GET['theme'] == "dark") echo "<font color='black'>" ?> Song URL: </font></label>
                                <div class="form-group">
                                    <input type="url" class="form-control" id="song_url"
                                           placeholder="Hier den Link zum Video eintragen" name="song_url">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label" for="karaoke_song_url">  <?php if ($_GET['theme'] == "dark") echo "<font color='black'>" ?> Karaoke URL: </font></label>
                                <div class="form-group">
                                    <input type="url" class="form-control" id="karaoke_song_url"
                                           placeholder="Hier den Link zum Karaoke Video eintragen" name="karaoke_song_url">
                                </div>
                            </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2">
                                    <button type="submit" class="btn btn-primary btn-block">Speichern</button>
                                </div>
                            </div>
                        </form>

                    </div><!--/.panel-body -->
                </div><!--/.panel-collapse -->
            </div><!-- /.panel -->
        </div>

        <hr/>

        <table id="songs" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Song</th>
                <th>Artist</th>
                <th>Video</th>
                <th>Lyrics</th>
                <?php if (isset($_POST['password']) AND $_POST['password'] == "10kmidjs") { ?>
                    <th><span class="glyphicon glyphicon-cog"></th><?php } ?>
            </tr>
            </thead>
            <tbody>

            <?php

            $sql = "SELECT * FROM songsammlung ORDER BY song DESC";

            $query = $pdo->prepare($sql);
            $query->execute();


            foreach ($query as $daten) {

                // für den automatisch generierten Lyrics Link: //
                $artist_beta = strtolower(str_replace(' ', '', $daten['artist']));
                $song_beta = strtolower(str_replace([':', '\\', '/', '*', '(', ')', ' '], '',  $daten['song']));
                $link = 'https://www.azlyrics.com/lyrics/'.$artist_beta.'/'.$song_beta.'.html';
                //////////////////////////////////


                ?>

                <tr>
                    <td><?php echo $daten['song']; ?></td>
                    <td><?php echo $daten['artist']; ?></td>
                    <td><a href="<?php echo $daten['song_url']; ?>" class="btn btn-info btn-sm"
                           target="_blank"><span class="glyphicon glyphicon-play-circle"></span><i class="fa fa-youtube-play" aria-hidden="true"></i> Play</a>
                        &nbsp;&nbsp;
                        <?php
                        if (!empty($daten['karaoke_song_url'])){
                        ?>
                        <a href="<?php echo $daten['karaoke_song_url']; ?>" class="btn btn-info btn-sm"
                           target="_blank"><span class="glyphicon glyphicon-play-circle"></span><i class="fa fa-music" aria-hidden="true"></i> Karaoke</a>
                        <?php } ?>
                    </td>
                    <td><a href="<?php echo $link; ?>" class="btn btn-info btn-sm"
                           target="_blank"><span class="glyphicon glyphicon-new-window"></span> Songtext</a>
                    </td>


                    <?php if (isset($_POST['password']) AND $_POST['password'] == "10kmidjs") { ?>
                        <td> <a href="#" class="btn btn-outline-danger" data-toggle="modal"
                                onclick="deleteModal('del.php?id=<?php echo $daten['id']; ?>', 'Möchtest du  <?php echo $daten['song']; ?> wirklich löschen?', '')"><i class="fa fa-trash-o fa-lg"></i></a></td><?php } ?>
                </tr>
            <?php } ?>

            </tbody>
        </table>
        <hr/>
        <div align="left">
            <small>Wir übernehmen keine Haftung für die Inhalte der externen Quellen!</small>
        </div>
    </div>


</div><!-- /.container -->

<style>
    html {
        position: relative;
        min-height: 100%;
    }

    body {
        /* Margin bottom by footer height */
        margin-bottom: 60px;
    }

    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        /* Set the fixed height of the footer here */
        height: 30px;
        line-height: 30px; /* Vertically center the text there */
        background-color: #f5f5f5;
        text-align: center;
    }
</style>

<footer class="footer">
    <div class="container">
        <span class="text-muted"><a href="https://clemensrau.de/impressum">Impressum</a> - © 2017 by Clemens Rau - powered by <a
                    href="https://it-services-rau.de/" target="_blank">it-services-rau.de</a></span>
    </div>
</footer>

</body>
</html>