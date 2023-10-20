<?php

class SessionManager {
    /**
     * Creer une session
     *
     * @param string $username int $id
     * @return void
     */
    public static function createSession(string $username, int $id) {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id;
        $_SESSION['justLoggedIn'] = true;
        $_SESSION['expiration_time'] = time() + 86400; // 1 jour
        session_write_close();
    }

    /**
     * Verifie si l'utilisateur vient juste de se connecter, si oui passe justLoggedIn a false
     *
     * @return bool
     */
    public static function didUserJustLogIn() {
        if ($_SESSION['justLoggedIn']) {
            $_SESSION['justLoggedIn'] = false;
            return true;
        }
        return false;
    }

    /**
     * Verifie que la session est tjrs en cours
     *
     * @return bool
     */
    public static function isSessionActive() {
        if (isset($_SESSION['expiration_time']) && $_SESSION['expiration_time'] >= time()) {
            return true;
        }
        return false;
    }

    /**
     * Supprime la session
     *
     * @return void
     */
    public static function deleteSession() {
        session_start();
        session_destroy();
    }
}