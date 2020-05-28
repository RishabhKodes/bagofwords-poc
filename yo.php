<?php
  // FUNCTION THAT CHECKS THE PRESENCE OF BLACKLISTED WORDS
  function fnChkBlacklist($text) {
    $objCache = new clsCacheUtil();
    $keyName = 'BLACKLISTED.WORDS';
    $chkData = $objCache->objGet($keyName);
    if($chkData == '') {
      // WE HAVE A PROBLEM HERE
      return 0;
    }
    else {
      $aData = json_decode($chkData, true);
      $strWords = "";
      foreach($aData['words'] as $index => $word) {
        $search = array("**", "$$", "^^", "((" , "))", "++", "\\", "||", "[[", "]]", "??");
        $replace = array("\*\*", "\$\$", "\^\^", "\(\(" , "\)\)", "\+\+", "\\\\", "\|\|", "\[\[", "\]\]", "\?\?");
        $word = str_replace($search, $replace, $word);
        $strWords .= '\b'.$word . '\b|';
      }
      $pattern = '/(' . trim($strWords, '|') . ')/i';
      //print_r($pattern); die();
      preg_match($pattern, $text, $matches);
      if(count($matches) > 0) {
        // BLACKLISTED WORDS FOUND
        return 1;
      }
      $keyName = 'BLACKLISTED.DICTIONARY';
      $chkData = $objCache->objGet($keyName);
      if($chkData == '') {
        // KEYS ARE NOT PRESENT IN REDIS
        return 0;
      }
      else {
        $aData = json_decode($chkData, true);
        $strWords = "";
        foreach($aData as $index => $word) {
          $strWords .= '\b'.$word . '\b|';
        }
        $pattern = '/(' . trim($strWords, '|') . ')/i';
        preg_match($pattern, $text, $matches);
        if(count($matches) > 0) {
          printf(BLACKLISTED WORDS FOUND);
          return 1;
        }
        else {
          prinf(WE ARE GOOD TO GO);
          return 0;
        }
      }
    }
  }