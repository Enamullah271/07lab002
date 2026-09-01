<?php

// Full Name: Enamullah Moatasim
// Student ID: YOUR_STUDENT_ID

// Task 2

class StudentCounter
{
    public static $count = 0;

    public static function addStudent()
    {
        self::$count++;
    }
}

StudentCounter::addStudent();
StudentCounter::addStudent();
StudentCounter::addStudent();

echo "Total students: " . StudentCounter::$count;

?>
