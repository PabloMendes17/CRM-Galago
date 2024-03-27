<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class VendedorAuthProvider extends EloquentUserProvider
{
    public function retrieveByCredentials(array $credenciais)
    {
        if (empty($credenciais) || (count($credenciais) === 1 &&
            array_key_exists('SENHA', $credenciais))) {
            return;
        }

        $query = $this->createModel()->newQuery();

        foreach ($credenciais as $key => $value) {
            if (!Str::contains($key, 'SENHAS')) {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }
}
