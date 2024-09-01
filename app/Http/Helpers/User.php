<?php

use App\Models\User;

if (! function_exists('checkRole')) {
    function checkRole(string $role): bool
    {
        return auth()->check() && auth()->user()->isAn($role);
    }
}

if (! function_exists('getRoleBadge')) {
    function getRoleBadge(string $role): string
    {
        $badge = '';
        
        if ($role == 'superadmin') {
            $badge = '<span class="badge bg-primary m-1">superadmin</span>';
        } elseif ($role == 'hradmin') {
            $badge = '<span class="badge bg-success m-1">hradmin</span>';
        } elseif ($role == 'supervisor') {
            $badge = '<span class="badge bg-info m-1">supervisor</span>';
        } elseif ($role == 'employee') {
            $badge = '<span class="badge bg-warning m-1">employee</span>';
        }

        return $badge;
    }
}

if (! function_exists('getRole')) {
    function getRole(): string
    {
        return auth()->user()->getRoles()[0];
    }
}

if (! function_exists('getCurrentUserRole')) {
    function getCurrentUserRole(): string
    {
        return ucwords(preg_replace('/[^\p{L}\p{N}\s]/u', ' ', getRole()));
    }
}

if (! function_exists('getUserRole')) {
    function getUserRole(int $id): string
    {
        $user = User::where('id', $id)->first();

        return ucwords(preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $user->getRoles()[0]));
    }
}

if (! function_exists('getAllUserRole')) {
    function getAllUserRole(int $id): array
    {
        $array = [];
        $user = User::where('id', $id)->first();
        $roles = $user->getRoles();

        foreach ($roles as $role) {
            $role = ucwords(preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $role));

            if ($role == 'Admin') {
                $role = 'Administrator';
            }

            if ($role == 'Ground Handling') {
                $role = 'Ground-Handling';
            }

            $array[] = $role;
        }

        return $array;
    }
}

if (! function_exists('getAllUserRole2')) {
    function getAllUserRole2(int $id): array
    {
        $array = [];
        $user = User::where('id', $id)->first();
        $roles = $user->getRoles();

        foreach ($roles as $role) {
            $role = ucwords(preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $role));

            if ($role == 'Ground Handling') {
                $role = 'Ground-Handling';
            }

            $array[] = $role;
        }

        return $array;
    }
}

if (! function_exists('getAllUserRoleLowercase')) {
    function getAllUserRoleLowercase(int $id): array
    {
        $array = [];
        $user = User::where('id', $id)->first();
        $roles = $user->getRoles();

        foreach ($roles as $role) {
            $role = strtolower(preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $role));

            if ($role == 'ground handling') {
                $role = 'ground-handling';
            }

            $array[] = $role;
        }

        return $array;
    }
}

if (! function_exists('getAllUserRoleBadge')) {
    function getAllUserRoleBadge(int $id): string
    {
        $badge = '';
        $user = User::where('id', $id)->first();
        $roles = $user->getRoles();

        foreach ($roles as $role) {
            $role = ucwords(preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $role));

            if ($role == 'Admin') {
                $role = 'Administrator';
            }

            $badge .= getUserDepartment($role);
        }

        return $badge;
    }
}

if (! function_exists('getUserDepartment')) {
    function getUserDepartment(string $department): string
    {
        $badge = '';

        if ($department == 'Administrator') {
            $badge = '<span class="badge bg-admin m-1">Administrator</span>';
        } elseif ($department == 'Finance') {
            $badge = '<span class="badge bg-finance m-1">Finance</span>';
        } elseif ($department == 'Terminal') {
            $badge = '<span class="badge bg-terminal m-1">Terminal</span>';
        } elseif ($department == 'Aerodrome') {
            $badge = '<span class="badge bg-aerodrome m-1">Aerodrome</span>';
        } elseif ($department == 'Cargo') {
            $badge = '<span class="badge bg-cargo m-1">Cargo</span>';
        } elseif ($department == 'Ground Handling') {
            $badge = '<span class="badge bg-ground text-dark m-1">Ground Handling</span>';
        }

        return $badge;
    }
}

if (! function_exists('getUserType')) {
    function getUserType(string $id): string
    {
        $user = User::where('id', $id)->first();
        $badge = '';

        if ($user->department == 'Administrator') {
            $badge = '<span class="badge bg-admin">Admin</span>';
        } elseif ($user->department == 'Finance') {
            $badge = '<span class="badge bg-finance">Finance</span>';
        } elseif ($user->department == 'Terminal') {
            $badge = '<span class="badge bg-terminal">Terminal</span>';
        } elseif ($user->department == 'Aerodrome') {
            $badge = '<span class="badge bg-aerodrome">Aerodrome</span>';
        } elseif ($user->department == 'Cargo') {
            $badge = '<span class="badge bg-cargo">Cargo</span>';
        } elseif ($user->department == 'Ground Handling') {
            $badge = '<span class="badge bg-ground">Ground Handling</span>';
        }

        return $badge;
    }
}

if (! function_exists('getCurrentActiveRole')) {
    function getCurrentActiveRole(): string
    {
        $role = auth()->user()->active_role;
        $badge = '';

        if ($role == 'admin') {
            $badge = '<span class="badge bg-admin">Admin</span>';
        } elseif ($role == 'finance') {
            $badge = '<span class="badge bg-finance">Finance</span>';
        } elseif ($role == 'terminal') {
            $badge = '<span class="badge bg-terminal">Terminal</span>';
        } elseif ($role == 'aerodrome') {
            $badge = '<span class="badge bg-aerodrome">Aerodrome</span>';
        } elseif ($role == 'cargo') {
            $badge = '<span class="badge bg-cargo">Cargo</span>';
        } elseif ($role == 'ground-handling') {
            $badge = '<span class="badge bg-ground">Ground Handling</span>';
        }

        return $badge;
    }
}

if (! function_exists('getUserDefaultImage')) {
    function getUserDefaultImage(?string $department = null): string
    {
        if ($department == 'Administrator') {
            $img = 'images/avatar/admin.svg';
        } elseif ($department == 'Terminal') {
            $img = 'images/avatar/terminal.svg';
        } elseif ($department == 'Finance') {
            $img = 'images/avatar/finance.svg';
        } elseif ($department == 'Aerodrome') {
            $img = 'images/avatar/aerodrome.svg';
        } elseif ($department == 'Cargo') {
            $img = 'images/avatar/cargo.svg';
        } elseif ($department == 'Ground Handling') {
            $img = 'images/avatar/ground.svg';
        } else {
            $img = 'images/default.png';
        }

        return $img;
    }
}
