<?php

namespace Izt\Basics\Storage\Eloquent\Traits;

trait SecureDeleteTrait
{
    /**
     * @param array $relations
     * @return bool
     */
    public function secureDelete($relations = [])
    {
        $hasRelation = false;
        foreach ($relations as $relation) {
            if ($this->$relation()
                    ->count() > 0) {
                $hasRelation = true;
                break;
            }
        }

        return !$hasRelation;
    }
}
