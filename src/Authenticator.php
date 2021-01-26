<?php

require_once "models/User.php";
require_once "repository/PermissionRepository.php";

class Authenticator {

    public static function updatePermissions() {
        $permissionRepository = new PermissionRepository();
        $permissions = $permissionRepository->getGlobalPermissions($_SESSION["userId"]);
        $_SESSION["globalPermissions"] = $permissions;
    }

    public static function checkPermission($permissionName) {
        if (in_array($permissionName, $_SESSION["globalPermissions"]))
            return true;
        return false;
    }

}