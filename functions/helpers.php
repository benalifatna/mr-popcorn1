<?php

/**
 *  function affichage débugage
 *
 * @param mixed $data
 * @return void
 */
    function dd(mixed $data) : void {
        var_dump($data);
        die();
    }

    function dump(mixed $data) : void {
        var_dump($data);
        
    }
    function redirectToPage(string $pageName) : void {
        header("Location: $pageName.php");
        die();
    }