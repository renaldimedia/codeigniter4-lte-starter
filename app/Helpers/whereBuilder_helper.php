<?php

function applyWhereConditions($builder, $conditions, $defaultLogic = 'AND')
{
    foreach ($conditions as $key => $value) {
        // Numerik → kondisi biasa
        if (is_int($key) && is_array($value) && isset($value['field'])) {
            $field = $value['field'];
            $op = strtoupper($value['op'] ?? '=');
            $val = $value['value'] ?? null;

            $method = strtolower($defaultLogic) === 'or' ? 'orWhere' : 'where';

            if (in_array($op, ['IS NULL', 'IS NOT NULL']) && is_null($val)) {
                if ($op === 'IS NULL') {
                    $builder->$method("$field IS NULL");
                } else {
                    $builder->$method("$field IS NOT NULL");
                }
            } elseif ($op === 'LIKE') {
                $builder->$method("$field LIKE", $val);
            } else {
                $builder->$method("$field $op", $val);
            }

        // Key 'or' atau 'and' → recursive group
        } elseif (in_array(strtolower($key), ['or', 'and']) && is_array($value)) {
            $groupMethod = strtolower($key) === 'or' ? 'orGroupStart' : 'groupStart';

            $builder->$groupMethod();
            applyWhereConditions($builder, $value, $key);
            $builder->groupEnd();
        }
    }

    return $builder;
}

