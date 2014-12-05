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
