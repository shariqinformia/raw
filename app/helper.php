<?php

use App\Libraries\ScormCloud_Php_Sample;
use RusticiSoftware\Cloud\V2\Configuration;
use RusticiSoftware\Cloud\V2 as ScormCloud;

if (!function_exists('getRegions')) {
    function getRegions()
    {
        $regions = [
            'East of England', 'East Midlands', 'London', 'North East',
            'North West', 'South East', 'South West', 'West Midlands',
            'Yorkshire and the Humber', 'Northern Ireland', 'Scotland', 'Wales'
        ];

        return $regions;
    }
}

if (!function_exists('getCities')) {
    function getCities($region=null)
    {
        $cities = [
            'East of England' => ['Cambridge', 'Norwich', 'Ipswich'],
            'East Midlands' => ['Nottingham', 'Leicester', 'Derby'],
            'London' => ['City of London', 'Westminster', 'Camden'],
            'North East' => ['Newcastle', 'Sunderland', 'Durham'],
            'North West' => ['Manchester', 'Liverpool', 'Blackpool'],
            'South East' => ['Brighton', 'Oxford', 'Southampton'],
            'South West' => ['Bristol', 'Bath', 'Exeter'],
            'West Midlands' => ['Birmingham', 'Coventry', 'Wolverhampton'],
            'Yorkshire and the Humber' => ['Leeds', 'Sheffield', 'York'],
            'Northern Ireland' => ['Belfast', 'Derry', 'Lisburn'],
            'Scotland' => ['Edinburgh', 'Glasgow', 'Aberdeen'],
            'Wales' => ['Cardiff', 'Swansea', 'Newport']
        ];

        return $cities[$region] ?? [];
    }
}


if (!function_exists('sendPlainEmail')) {
    function sendPlainEmail($to, $subject, $message, $headers = '')
    {
        if (mail($to, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }
}


if (!function_exists('getScormCourseInfo')) {
    function getScormCourseInfo($registration_id) {
        $config = new ScormCloud\Configuration();
        $config->setUsername(env('APP_ID'));
        $config->setPassword(env('SECRET_KEY'));
        ScormCloud\Configuration::setDefaultConfiguration($config);

        $sc = new ScormCloud_Php_Sample();
        return $sc->getResultForRegistration($registration_id);
    }
}

if (!function_exists('getAcronym')) {
    function getAcronym($name) {
        $words = explode(' ', $name); // Split the name into words
        $acronym = '';
        foreach ($words as $word) {
            $acronym .= strtoupper($word[0]); // Take the first letter of each word
        }
        return $acronym;
    }
}
