<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* PHP PBKDF2 implementation
 *
 * PBKDF2 is a key derivation function defined in RFC2898. It's used to
 * generate longer and more secure passwords from short, human-entered
 * passwords. The number of rounds can be increased to keep ahead of
 * improvements in CPU/GPU performance.
 * 
 * You should use a different salt for each password (it's safe to store it
 * alongside your generated password; much safer than using the same salt for
 * multiple passwords, anyway).
 * 
 * This function is slow; that's intentional! You should use at least 5000
 * rounds in 2011.
 * 
 * For more information see:
 *  - http://en.wikipedia.org/wiki/PBKDF2
 *  - http://www.ietf.org/rfc/rfc2898.txt
 * 
 * This implementation is very slightly modified from the one found here:
 * http://www.php.net/manual/en/function.hash-hmac.php#101540
 * 
 * The variable names have been made readable, some have sensible defaults,
 * and the output is Base64 encoded. Argument ordering changed to match 
 * the builtin version in PHP 5.5.
 */

class CI_hash_pbkdf2{

function hash_pbkdf2($a = 'sha256', $password, $salt, $rounds = 5000, $key_length = 32, $raw_output = false) 
{ 
  // Derived key 
  $dk = '';

  // Create key 
  for ($block=1; $block<=$key_length; $block++) 
  { 
    // Initial hash for this block 
    $ib = $h = hash_hmac($a, $salt . pack('N', $block), $password, true); 

    // Perform block iterations 
    for ($i=1; $i<$rounds; $i++) 
    { 
      // XOR each iteration
      $ib ^= ($h = hash_hmac($a, $h, $password, true)); 
    } 

    // Append iterated block 
    $dk .= $ib;
  } 

  // Return derived key of correct length 
  $key = substr($dk, 0, $key_length);
  return $raw_output ? $key : base64_encode($key);
}
}

