<?php
final class SingletonProcessor {
    private static $instances = array();  // экземпляра объекта
    private function __construct() { /* ... @return Singleton */ }  // Защищаем от создания через new
    private function __clone() { /* ... @return Singleton */ }  // Защищаем от создания через клонирование
    private function __wakeup() { /* ... @return Singleton */ }  // Защищаем от создания через unserialize
    public static function getInstance($sClassName) { // Возвращает единственный экземпляр класса. @return Singleton
        if (!class_exists($sClassName, false))
            throw new Exception($sClassName . " not exists!");
        if (array_key_exists($sClassName, self::$instances)) {
            if (is_object(self::$instances[$sClassName])) {
                if (is_a(self::$instances[$sClassName], $sClassName)) {
                    return self::$instances[$sClassName];
                }
            }
        }
        if ( !isset(self::$instances[$sClassName]) || empty(self::$instances[$sClassName]) ) {
            self::$instances[$sClassName] = new $sClassName();
            return self::$instances[$sClassName];
        }
    }
}
?>