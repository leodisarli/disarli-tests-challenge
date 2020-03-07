<?php

namespace App\Helpers;

class DateTimeHelper
{
    /**
     * get current date
     * @return \DateTime
     */
    public function getDate()
    {
        $dateTime = new \DateTime();
        return $dateTime;
    }

    /**
     * transform string date to DateTime obj
     * @param string
     * @return \DateTime
     */
    public function toDate(
        string $date
    ) {
        $dateTime = new \DateTime($date);
        return $dateTime;
    }

    /**
     * transform string date to DateTime obj from format
     * @param string $date,
     * @param string $format
     * @return \DateTime
     */
    public function createDateFromFormat(
        string $date,
        string $format
    ) {
        $dateTime = new \DateTime;
        $dateTime = $dateTime->createFromFormat($format, $date);
        return $dateTime;
    }

    /**
     * transform string BR date to date database format
     * @param string $date,
     * @return string
     */
    public function dateDbFormat(string $date)
    {
        $dateTime = new \DateTime;
        $dateTime = $dateTime->createFromFormat('d/m/Y', $date);
        $dateString = $dateTime->format('Y-m-d');
        return $dateString;
    }

    /**
     * transform string date to date BR format
     * @param string $date,
     * @param string $format
     * @return string
     */
    public function dateBrFormat(string $date)
    {
        $dateTime = new \DateTime;
        $dateTime = $dateTime->createFromFormat('Y-m-d H:i:s', $date);
        $dateString = $dateTime->format('d/m/Y');
        return $dateString;
    }

    /**
     * transform string datetime to time format
     * @param string $date,
     * @param string $format
     * @return string
     */
    public function getTime(string $date)
    {
        $dateTime = new \DateTime;
        $dateTime = $dateTime->createFromFormat('Y-m-d H:i:s', $date);
        $timeString = $dateTime->format('H:i');
        return $timeString;
    }

    /**
     * transform obj DateTime to string
     * @param \DateTime
     * @return string
     */
    public function toString(
        \DateTime $dateTime
    ) {
        $date = $dateTime->format('Y-m-d H:i:s');
        return $date;
    }

    /**
     * check if an date its on validity
     * @param string
     * @return \DateTime
     */
    public function onValidity(
        string $date
    ) {
        $now = new \DateTime();
        $dateToCheck = new \DateTime($date);

        if ($dateToCheck > $now) {
            return true;
        }
        return false;
    }

    /**
     * get current date plus minutes
     * @param int $amount
     * @return DateTime
     */
    public function dateAddMinutes(
        int $amount
    ) {
        $dateTime = new \DateTime();
        $dateTime->add(
            new \DateInterval('PT'.$amount.'M')
        );
        return $dateTime;
    }

    /**
     * get current date plus hours
     * @param int $amount
     * @return DateTime
     */
    public function dateAddHours(
        int $amount
    ) {
        $dateTime = new \DateTime();
        $dateTime->add(
            new \DateInterval('PT'.$amount.'H')
        );
        return $dateTime;
    }

    /**
     * get current date sub minutes
     * @param int $amount
     * @return DateTime
     */
    public function dateSubMinutes(
        int $amount
    ) {
        $dateTime = new \DateTime();
        $dateTime->sub(
            new \DateInterval('PT'.$amount.'M')
        );
        return $dateTime;
    }

    /**
     * get current date sub hours
     * @param int $amount
     * @return DateTime
     */
    public function dateSubHours(
        int $amount
    ) {
        $dateTime = new \DateTime();
        $dateTime->sub(
            new \DateInterval('PT'.$amount.'H')
        );
        return $dateTime;
    }
}
