<?php

require_once "models/User.php";
require_once "repository/PermissionRepository.php";

class Authenticator {

    public static function updatePermissions() {
        $permissionRepository = new PermissionRepository();
        $permissions = $permissionRepository->getGlobalPermissions($_SESSION["userId"]);
        $_SESSION["globalPermissions"] = $permissions;
    }

    public static function checkPermission($permissionName): bool {
        if (!self::isLoggedIn())
            return false;
        if (!isset($_SESSION["globalPermissions"]))
            return false;
        if (in_array($permissionName, $_SESSION["globalPermissions"]))
            return true;
        return false;
    }

    public static function isLoggedIn(): bool {
        if (session_status() != PHP_SESSION_ACTIVE)
            return false;
        if (!isset($_SESSION["userId"]))
            return false;
        return true;
    }

    public static function clearSession() {
        session_unset();
        session_destroy();
    }
}