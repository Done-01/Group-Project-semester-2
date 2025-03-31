<?php
    // functions for use elsewhere

    // generate random 5 digit string (first 3 alpanumeric last 2 numeric)

    function GenerateRandomString() {
        // First 3 characters are uppercase letters
        $letters = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3);
        
        // Last 2 characters are digits (can include "00")
        $digits = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT); // Pad with leading 0 if needed
        
        // Combine them to form the final string
        $randomString = $letters . $digits;
        
        return $randomString;
    }
    

    function VigenereEncrypt($plaintext, $key) {
      $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';  // Define the alphabet (letters + digits)
      $plaintext = strtoupper($plaintext);  // Convert plaintext to uppercase (for letters)
      $key = strtoupper($key);  // Convert key to uppercase (for letters)
  
      $ciphertext = '';  // To hold the encrypted string
      $keyIndex = 0;     // To keep track of the current character in the key
  
      for ($i = 0; $i < strlen($plaintext); $i++) {
          $char = $plaintext[$i];
          
          // Encrypt only alphanumeric characters (letters and digits)
          if (strpos($alphabet, $char) !== false) {
              // Get the position of the plaintext letter/digit in the alphabet
              $pIndex = strpos($alphabet, $char);
  
              // Get the position of the key letter/digit in the alphabet
              $kIndex = strpos($alphabet, $key[$keyIndex]);
  
              // Encrypt the character using the Vigenère cipher formula
              $cIndex = ($pIndex + $kIndex) % strlen($alphabet);
  
              // Append the encrypted character to the ciphertext
              $ciphertext .= $alphabet[$cIndex];
  
              // Move to the next character in the key
              $keyIndex = ($keyIndex + 1) % strlen($key);
          } else {
              // If it's not an alphanumeric character (e.g., spaces, punctuation), leave it unchanged
              $ciphertext .= $char;
          }
      }
  
      return $ciphertext;
  }

  function VigenereDecrypt($ciphertext, $key) {
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';  // Define the alphabet (letters + digits)
    $ciphertext = strtoupper($ciphertext);  // Convert ciphertext to uppercase (for letters)
    $key = strtoupper($key);  // Convert key to uppercase (for letters)

    $plaintext = '';  // To hold the decrypted string
    $keyIndex = 0;    // To keep track of the current character in the key

    for ($i = 0; $i < strlen($ciphertext); $i++) {
        $char = $ciphertext[$i];
        
        // Decrypt only alphanumeric characters (letters and digits)
        if (strpos($alphabet, $char) !== false) {
            // Get the position of the ciphertext letter/digit in the alphabet
            $cIndex = strpos($alphabet, $char);

            // Get the position of the key letter/digit in the alphabet
            $kIndex = strpos($alphabet, $key[$keyIndex]);

            // Decrypt the character using the Vigenère cipher formula
            $pIndex = ($cIndex - $kIndex + strlen($alphabet)) % strlen($alphabet);

            // Append the decrypted character to the plaintext
            $plaintext .= $alphabet[$pIndex];

            // Move to the next character in the key
            $keyIndex = ($keyIndex + 1) % strlen($key);
        } else {
            // If it's not an alphanumeric character (e.g., spaces, punctuation), leave it unchanged
            $plaintext .= $char;
        }
    }

    return $plaintext;
}


