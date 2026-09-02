<?php

$conn = mysqli_connect("localhost", "root", "", "to-do");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
