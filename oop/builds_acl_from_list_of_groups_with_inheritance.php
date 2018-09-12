<?php
class Acl
{
    protected $values = [];
    public function addRole($role, $inherits = '')
    {
        $this->values[$role] = $inherits;
    }
    public function hasRole($role)
    {
        return isset($this->values[$role]);
    }
}

class Test
{
    public $acl;
    // key == group; value == parent from which this group inherits its rights
    public $groups = ['c' => 'b', 'b' => 'a', 'a' => '', 'd' => 'b', 'e' => 'd'];
    const ERROR_ROLE_NOT_IN_GROUPS = 'ERROR: this role is not an assigned group';

    public function __construct($acl)
    {
        $this->acl = $acl;
    }
    public function checkRoles()
    {
        $check = 0;
        $count = count($this->groups);
        foreach ($this->groups as $role => $inherits) {
            $check += (int) $this->acl->hasRole($role);
        }
        return $check == $count;
    }
    public function addRole($role)
    {
        if (!isset($this->groups[$role])) {
            throw new Exception(self::ERROR_ROLE_NOT_IN_GROUPS);
        }
        $ok = TRUE;
        $inherits = $this->groups[$role];
        if (!$inherits) {
            $this->acl->addRole($role);
        } elseif ($this->acl->hasRole($inherits)) {
            $this->acl->addRole($role, $inherits);
        } else {
            $ok = FALSE;
        }
        return $ok;
    }
    public function addRolesFromGroupsList()
    {
        $count = count($this->groups) + 1;
        while (!$this->checkRoles() && $count--) {
            foreach ($this->groups as $group => $inherits) {
                $this->addRole($group);
            }
        }
    }
}

try {
    $test = new Test(new Acl());
    $test->addRolesFromGroupsList();
} catch (Exception $e) {
    echo PHP_EOL, $e->getMessage(), PHP_EOL;
}
var_dump($test);
