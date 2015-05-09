<?php

function validirajIme($ime) {
    if(strlen(preg_replace('/\s+/', '', $ime)) == 0) return false;
    return true;
}

function validirajMail($mail) {
    if(strlen(preg_replace('/\s+/', '', $mail)) == 0 || preg_match('/^[a-z0-9_]+@[a-z.]+\.[a-z][a-z]+$/', $mail) == false) return false;
    return true;
}

function validirajPonovniMail($mail, $ponovniMail) {
    if(strlen(preg_replace('/\s+/', '', $mail)) == 0 || preg_match('/^[a-z0-9_]+@[a-z.]+\.[a-z][a-z]+$/', $mail) == false || $mail != $ponovniMail) return false;
    return true;
}

function validirajPoruku($tekst) {
    if(strlen(preg_replace('/\s+/', '', $tekst)) == 0) return false;
    return true;
}

?>