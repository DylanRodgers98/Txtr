<?php

namespace App\Models;

class DisplayableNotification
{
    public $notificationImageUrl;

    public $heading;

    public $subheading;

    public $timestamp;

    public $notificationUrl;

    public $unread;

    public function __construct($notificationImageUrl, $heading, $subheading, $timestamp, $notificationUrl, $unread)
    {
        $this->notificationImageUrl = $notificationImageUrl;
        $this->heading = $heading;
        $this->subheading = $subheading;
        $this->timestamp = $timestamp;
        $this->notificationUrl = $notificationUrl;
        $this->unread = $unread;
    }
}
