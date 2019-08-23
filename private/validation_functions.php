<?php

  function is_blank($value) {
    return !isset($value) || trim($value) === '';
  }

  function has_presence($value) {
    return !is_blank($value);
  }

  function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
  }

  function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
  }

  function has_length_exactly($value, $exact) {
    $length = strlen($value);
    return $length == $exact;
  }

  function has_length($value, $options) {
    if(isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
      return false;
    } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
      return false;
    } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  function has_inclusion_of($value, $set) {
  	return in_array($value, $set);
  }

  function has_exclusion_of($value, $set) {
    return !in_array($value, $set);
  }

  function has_string($value, $required_string) {
    return strpos($value, $required_string) !== false;
  }

  function has_valid_email_format($value) {
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
  }

  function has_unique_username($username, $current_id="0") {
    // Need to re-write for OOP
    $admin = Admin::find_by_username($username);
    if($admin === false || $admin->id == $current_id)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

?>