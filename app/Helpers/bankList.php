<?php

if (!function_exists('bankList')) {
   
   function bankList(){
      $result = [];
      foreach (config('bank-accounts') as $account => $detail) {
         $result[$account] = $detail['title'];
      }

      return $result;
   }
}