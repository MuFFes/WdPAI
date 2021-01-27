<?php

require_once "Repository.php";
require_once __DIR__."/../models/User.php";

class PermissionRepository extends Repository {

    public function getGlobalPermissions(int $userId) {
        $statement = $this->database->connect()->prepare('
            SELECT name
            FROM public."User_GlobalPermission"
            LEFT JOIN "GlobalPermission" GP on "User_GlobalPermission"."permissionId" = GP.id
            WHERE "userId" = :userId;
        ');
        $statement->bindParam(":userId", $userId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getUserProjects(int $userId) {
        $projects = array();
        $statement = $this->database->connect()->prepare('
            SELECT projectid FROM "View_UserProjects" WHERE "userid"=:userId;
        ');
        $statement->bindParam(":userId", $userId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getProjectPermissions(int $userId, int $projectId) {
        throw new Exception("Not implemented");
    }
}