<?php

/**
 * SQL query templates for controller Profile
 * o controllers/profile.php
 */
return array (
    1 => 'SELECT `Name` from `names` ORDER BY `NamesID` DESC LIMIT 1',
    2 => 'INSERT INTO `names` (`Name`) VALUES (:Name)',
);
