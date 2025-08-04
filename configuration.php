<?php
/**
 * Payment Gateway Configuration
 * 
 * Instructions:
 * 1. Copy .env.example to .env
 * 2. Fill in your actual API credentials in the .env file
 * 3. Set $is_sandbox = true for testing environment
 * 4. Update URLs for your production environment
 */
require('./config.php');
include('connection/phpdotenv.php');

// Load configuration from environment variables
$api_key = $_ENV['BILLPLZAPI'];
$collection_id = $_ENV['BILLPLZCOLLID'];
$x_signature = $_ENV['BILLPLZSIGNATURE'];
$is_sandbox = false; // Set to true for sandbox/testing

// Production URLs - Update these for your domain
$websiteurl = 'https://your-domain.com';
$successpath = 'https://your-domain.com/rg/success.php';
$fallbackurl = 'https://your-domain.com/rg/rejected.php';

// Payment configuration
$description = 'Road Tax Renewal Payment';
$reference_1_label = '';
$reference_2_label = '';

// Development/Local URLs (uncomment for local development)
// $websiteurl = 'http://localhost/instaroadtax/';
// $successpath = 'http://localhost/instaroadtax/rg/success.php';
// $fallbackurl = 'http://localhost/instaroadtax/rg/rejected.php';
