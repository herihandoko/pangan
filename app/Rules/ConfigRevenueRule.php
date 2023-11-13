<?php

namespace App\Rules;

use App\Model\Monetize\ConfigRevenue;
use Illuminate\Contracts\Validation\Rule;

class ConfigRevenueRule implements Rule
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
        //
        if ($this->request->id) {
            return !ConfigRevenue::where('month_year', $value)->where('id', '!=', $this->request->id)->exists();
        } else {
            return !ConfigRevenue::where('month_year', $value)->exists();
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The period config already exist error message.';
    }
}
