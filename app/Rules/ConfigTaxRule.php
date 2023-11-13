<?php

namespace App\Rules;

use App\Model\Monetize\ConfigTax;
use Illuminate\Contracts\Validation\Rule;

class ConfigTaxRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $request;

    public function __construct($request)
    {
        //
        $this->request = $request;
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
        if ($this->request->id) {
            return !ConfigTax::where('limit_income', $value)->where('type', $this->request->type)->where('id', '!=', $this->request->id)->exists();
        } else {
            return !ConfigTax::where('limit_income', $value)->where('type', $this->request->type)->exists();
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The limit income allready exist.';
    }
}
