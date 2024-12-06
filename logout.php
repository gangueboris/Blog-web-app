<?php
require 'config/constants.php';

# Destroy the SESSION and redirect on the home page
session_destroy();
header("Location: " . ROOT_URL);