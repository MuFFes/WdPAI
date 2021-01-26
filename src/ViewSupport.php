<?php


class ViewSupport {

    private static string $activeTab;

    public static function setActiveTab($name) {
        self::$activeTab = $name;
    }

    public static function getActiveTab() : string {
        if (!isset(self::$activeTab))
            return "";
        return self::$activeTab;
    }
}