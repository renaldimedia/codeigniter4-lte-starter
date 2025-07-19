<?php

namespace App\Services;

// use App\Models\UserModel;

class UserService
{
    function list($where = [], $limit = 10, $offset = 0)
    {
        $users = auth()->getProvider();
        $usersListRaw = [];
        $usersListQ = $users
            ->withIdentities()
            ->withGroups()
            ->withPermissions();

        helper('whereBuilder');
        applyWhereConditions($usersListQ, $where);

        // print_r($usersListQ->getCompiledSelect());exit;
        $usersListRaw = $usersListQ->findAll(10, $offset);
        // print_r($usersListRaw);exit;
        $usersList = [];
        foreach($usersListRaw as $usr){
            $usersList[] = [
                'email' => $usr->email,
                'username' => $usr->username,
                'full_name' => $usr->full_name,
                'phone' => $usr->phone
            ];
        }

        return $usersList;
    }

    function detail($id) {
        
    }
}
