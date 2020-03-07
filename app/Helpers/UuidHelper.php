<?php

namespace App\Helpers;

use Ramsey\Uuid\Codec\TimestampFirstCombCodec;
use Ramsey\Uuid\Generator\CombGenerator;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\UuidFactory;

class UuidHelper
{
    /**
     * Generate uuid hash
     * @return string
     */
    public static function uuid4() : string
    {
        $factory = new UuidFactory();
        $generator = new CombGenerator(
            $factory->getRandomGenerator(),
            $factory->getNumberConverter()
        );
        $codec = new TimestampFirstCombCodec(
            $factory->getUuidBuilder()
        );
        $factory->setRandomGenerator($generator);
        $factory->setCodec($codec);
        RamseyUuid::setFactory($factory);

        $uuid = RamseyUuid::uuid4()->toString();

        return $uuid;
    }

    /**
     * Verify if uuid4 hash is valid
     * @param string $uuid
     * @return bool
     */
    public static function isValid($uuid) : bool
    {
        $isValid = RamseyUuid::isValid($uuid);
        return $isValid;
    }
}
