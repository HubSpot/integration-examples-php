<?php

namespace Repositories;

use Helpers\DBClientHelper;
use Helpers\OAuth2Helper;

class TokensRepository
{
    public static function getToken()
    {
        $query = DBClientHelper::getClient()
                ->query('select * from tokens where id = 1');

        return $query->fetch();
    }

    public static function insert(array $token)
    {
        $db = DBClientHelper::getClient();
        $query = $db->prepare('insert into tokens (refresh_token, access_token, expires_in, expires_at) values (?, ?, ?, ?)');
        $query->execute([
            $token['refresh_token'],
            $token['access_token'],
            $token['expires_in'],
            OAuth2Helper::getExpiresAt($token['expires_in']),
        ]);
    }
    
    public static function update(array $token)
    {
        $db = DBClientHelper::getClient();
        $query = $db->prepare('update tokens set refresh_token = ?, access_token = ?, expires_in = ?, expires_at = ? where id = 1');
        $query->execute([
            $token['refresh_token'],
            $token['access_token'],
            $token['expires_in'],
            OAuth2Helper::getExpiresAt($token['expires_in']),
        ]);
    }
    
    public static function save($token)
    {
        if (static::getToken()) {
            static::update($token);
        } else {
            static::insert($token);
        }
    }
}
