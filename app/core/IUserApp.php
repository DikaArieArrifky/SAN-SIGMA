<?php

interface IUserApp
{
    public function getUserId($x);
    public function getPasswordByUserId($userId);
    public function changePasswordByUserId($userId, $verifPassword, $newPassword, $oldPassword);
    
  
}