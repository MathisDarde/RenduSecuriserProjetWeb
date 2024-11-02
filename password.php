<?php

$plainPassword = $password;

$hashedPassword = password_hash(
  $plainPassword,
  PASSWORD_BCRYPT,
  []
);