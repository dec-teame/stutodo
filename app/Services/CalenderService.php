<?php

namespace App\Services;

use Google_Client;

class CalendarService
{
    private Google_Client $client;

    public function __construct(Google_Client $client)
    {
        $this->client = $client;
    }
}

    /**
     * イベントのリストの取得
     *
     * @param GoogleUser $user
     *
     * @return array
     */
    public function getEventList(GoogleUser $user)
    {
        $this->setAccessToken($user);
        $service = new Google_Service_Calendar($this->client);
        $events = $service->events->listEvents('primary', [
            'timeMin' => Carbon::now()->subDays(7)->format(DATE_RFC3339),
            'timeMax' => Carbon::now()->addDays(7)->format(DATE_RFC3339)
        ]);
        $ret = [];

        while(true) {
            foreach ($events->getItems() as $event) {
                if ($event->start and $event->end) {
                    $ret[] = [
                        'id' => $event->id,
                        'summary' => $event->getSummary(),
                        'start' => $event->start->dateTime,
                        'end' => $event->end->dateTime
                    ];
                }
            }
            $pageToken = $events->getNextPageToken();
            if ($pageToken) {
                $optParams = array('pageToken' => $pageToken);
                $events = $service->events->listEvents('primary', $optParams);
            } else {
                break;
            }
        }
        return $ret;
    }

    /**
     * アクセストークンのセット
     *
     * @param GoogleUser $user
     *
     * @return void
     */
    private function setAccessToken(GoogleUser $user): void
    {
        if (Carbon::now()->timestamp >= $user->expires - 30) {
            $token = $this->client->fetchAccessTokenWithRefreshToken($user->refresh_token);
            $user->access_token = $token['access_token'];
            $user->expires = Carbon::now()->timestamp + $token['expires_in'];
            $user->save();
        }

        $this->client->setAccessToken($user->access_token);
    }
