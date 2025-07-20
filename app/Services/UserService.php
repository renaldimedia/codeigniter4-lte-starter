<?php

namespace App\Services;

use Config\Database;

// use App\Models\UserModel;

class UserService
{
    function list($search = "", $order = [], $limit = 10, $offset = 0)
    {
        $db = Database::connect();
        $users = $db->table('users as u');
        $usersListRaw = [];
        $usersListQ = $users->select('u.id as usr_id, u.username, u.full_name, u.phone, u.address, aid.secret as email, GROUP_CONCAT(agu.group SEPARATOR ", ") as role')->join('auth_identities as aid', 'aid.user_id = u.id', 'left')
            ->join('auth_groups_users as agu', 'agu.user_id = u.id', 'left');

        
        $total = $usersListQ->groupBy('usr_id')->countAllResults(false);
        

        if(!empty($search)){
            $usersListQ->groupStart();
                $usersListQ->like('u.username', $search);
                $usersListQ->orLike('u.full_name', $search);
                $usersListQ->orLike('u.phone', $search);
                $usersListQ->orLike('u.address', $search);
                $usersListQ->orLike('aid.secret', $search);
            $usersListQ->groupEnd();
        }

        $usersListQ->where('deleted_at IS NULL');

        if (count($order) > 0) {
            foreach ($order as $ord) {
                $usersListQ->orderBy($ord['field'], $ord['dir'] ?? 'asc');
            }
        }

        $totalF = $usersListQ->countAllResults(false);

        // print_r(['q' => $usersListQ->getCompiledSelect(), 'were' => $where]);exit;
        $usersListRaw = $usersListQ->get($limit, $offset)->getResultObject();
        // print_r($usersListRaw);exit;
        $usersList = [];
        foreach ($usersListRaw as $usr) {
            $usersList[] = [
                'email' => $usr->email,
                'username' => $usr->username,
                'full_name' => $usr->full_name,
                'phone' => $usr->phone,
                'roles' => $usr->role,
                'id' => $usr->usr_id
            ];
        }

        return ['total' => $total, 'data' => $usersList, 'totalF' => $totalF];
    }

    function detail($id) {
        $db = Database::connect();
        $users = $db->table('users as u');

        $usersListQ = $users->select('u.id as usr_id, u.username, u.full_name, u.phone, u.address, aid.secret as email, GROUP_CONCAT(agu.group SEPARATOR ", ") as role')->join('auth_identities as aid', 'aid.user_id = u.id', 'left')
            ->join('auth_groups_users as agu', 'agu.user_id = u.id', 'left');

        $usersListQ->where('u.id', $id);

        return $usersListQ->get()->getRowArray();
    }
}
