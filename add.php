<?php
require ("database.php");

    $new_song = 0;
    $new_song_url = 0;
    $new_artist = 0;
    $new_lyrics_url = 0;

    $new_song = htmlentities($_POST['song']);
    $new_song_url = htmlentities($_POST['song_url']);
    $new_karaoke_song_url = htmlentities($_POST['karaoke_song_url']);
    $new_artist = htmlentities($_POST['artist']);
    $new_lyrics_url = htmlentities($_POST['lyrics_url']);

        $statement = $pdo->prepare("INSERT INTO songsammlung (song, song_url, karaoke_song_url, artist, lyrics_url) VALUES ('$new_song', '$new_song_url', '$new_karaoke_song_url', '$new_artist', '$new_lyrics_url')");
        $res = $statement->execute();

// Mail beim hinzufuegen
$emails ="leo.lechner@gmx.de, musik@clemensrau.de";
mail("$emails", "Neuer Song wurde hinzugefuegt!", "Hi, \n\n es wurde ein neuer Song zur Songsammlung hinzugefuegt.\n\n Name: $new_song \n Artist: $new_artist \n\n\n Songsammlung: https://dev2.it-services-rau.de/songsammlung", "From: Songsammlung <musik@clemensrau.de>");


// BackwardPage
        $page = "/songsammlung";
        $sec = "0";
        header("Refresh: $sec; url=$page");

?>
