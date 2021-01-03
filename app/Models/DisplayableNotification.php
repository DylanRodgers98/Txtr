<?php

namespace App\Models;

class DisplayableNotification
{
    public $profileImagePath;

    public $heading;

    public $subheading;

    public $timestamp;

    public $notificationUrl;

    public function __construct($profileImagePath, $heading, $subheading, $timestamp, $notificationUrl)
    {
        $this->profileImagePath = $profileImagePath;
        $this->heading = $heading;
        $this->subheading = $subheading;
        $this->timestamp = $timestamp;
        $this->notificationUrl = $notificationUrl;
    }
}
