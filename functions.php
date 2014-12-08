<?php

/**
 * PHP helper functions.
 */

function require_get($key, $default = null) {
  if (isset($_GET[$key])) {
    return $_GET[$key];
  } else if ($default !== null) {
    return $default;
  } else {
    throw new Exception("Required get parameter '$key' not available");
  }
}

function require_post($key, $default = null) {
  if (isset($_POST[$key])) {
    return $_POST[$key];
  } else if ($default !== null) {
    return $default;
  } else {
    throw new Exception("Required post parameter '$key' not available");
  }
}

function require_session($key, $default = null) {
  if (isset($_SESSION[$key])) {
    return $_SESSION[$key];
  } else if ($default !== null) {
    return $default;
  } else {
    throw new Exception("Required session parameter '$key' not available");
  }
}

function redirect($url) {
  if (strpos($url, "\n") !== false) {
    throw new Exception("Invalid multiline URL '$url'");
  }
  header('Location: ' . $url);
  die();
}

/**
 * Uses PHP's filter_var() to validate e-mail addresses, and also ensures the e-mail address
 * is shorter than 255 characters (limit in our database for e-mail addresses).
 *
 * NOTE this requires MySQL 5+ which uses VARCHAR(32) to define 32 characters, not 32 bytes,
 * therefore we can use mb_strlen().
 *
 * To support UTF-8 email addresses, we aren't too picky about edge cases; if it looks like
 * an e-mail address, accept it.
*/
function is_valid_email($e) {
  return mb_strlen($e) <= 255 && preg_match("/^[^@ ]+@([^@ ]+\\.)+[^@ ]+$/u", $e);
}

function is_valid_url($e) {
  $e = mb_strtolower($e);
  return mb_strlen($e) <= 255 &&
    (mb_substr($e, 0, mb_strlen("http://")) == "http://" || mb_substr($e, 0, mb_strlen("https://")) == "https://");
}
