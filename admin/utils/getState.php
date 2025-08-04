<?php

function getState($postcode) {
    switch ($postcode) {
        case ($postcode <= 2800):
            return "Perlis";
            break;
        case ($postcode <= 9810):
            return "Kedah";
            break;
        case ($postcode <= 14400):
            return "Pulau Pinang";
            break;
        case ($postcode <= 18500):
            return "Kelantan";
            break;
        case ($postcode <= 24300):
            return "Terengganu";
            break;
        case ($postcode <= 28800 || $postcode == 49000 || $postcode == 69000):
            return "Pahang";
            break;
        case ($postcode <= 36810):
            return "Perak";
            break;
        case ($postcode <= 39200):
            return "Pahang";
            break;
        case ($postcode <= 48300):
            return "Selangor";
            break;
        case ($postcode <= 60000):
            return "Kuala Lumpur";
            break;
        case ($postcode <= 62988):
            return "Putrajaya";
            break;
        case ($postcode < 73509):
            return "Negeri Sembilan";
            break;
        case ($postcode < 78309):
            return "Melaka";
            break;
        case ($postcode <= 86900):
            return "Johor";
            break;
        case ($postcode <= 87033):
            return "Labuan";
            break;
        case ($postcode <= 91309):
            return "Sabah";
            break;
        case ($postcode < 98859):
            return "Sarawak";
            break;
        default:
            return "Error: out or range";
    }
}