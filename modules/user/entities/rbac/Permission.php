<?php


namespace vloop\user\entities\rbac;


use vloop\user\entities\common\IteratorAbstract;
use vloop\user\entities\interfaces\AccessCredential;

class Permission implements AccessCredential
{
    private $name;
    private $rules;

    public function __construct(string $name) {
        $this->name = $name;
        $this->rules = new RulesRBAC();
    }

    public function name(): string
    {
        return $this->name;
    }

    public function rules(): array
    {
        return $this->rules->list();
    }
}