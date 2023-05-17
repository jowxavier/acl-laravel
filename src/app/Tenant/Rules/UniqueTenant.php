<?php

namespace App\Tenant\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueTenant implements Rule
{
    protected $table;
    protected $value;
    protected $collumn;
    protected $label;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $table, $value = null, $collumn = '', $label = '')
    {
        $this->table = $table;
        $this->value = $value;
        $this->collumn = $collumn;
        $this->label = $label;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $tenantId = auth()->user()->tenant_id;
        $register = DB::table($this->table)
                    ->where([
                        $attribute => $value,
                        'tenant_id' => $tenantId
                    ])
                    ->first();

        if ($register && $register->{$this->collumn} == $this->value) {
            return true;
        }

        return is_null($register);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O valor para '.$this->label.' já está em uso.';
    }
}
