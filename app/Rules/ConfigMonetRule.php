<?php

namespace App\Rules;

use App\Model\Monetize\ConfigMonetize;
use Illuminate\Contracts\Validation\Rule;

class ConfigMonetRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $request;
    protected $fields;
    protected $total;

    public function __construct($request, $fields)
    {
        //
        $this->request = $request;
        $this->fields = $fields;
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
        $total = 0;
        foreach ($this->fields as $key) {
            $total += $this->request->$key;
        }
        $this->total = $total;
        if ($this->request->id) {
            $dataExist = ConfigMonetize::select('id')->where('month_year', $this->request->id)->get();
            return ($total == 100) && !ConfigMonetize::whereNotIn('id', $dataExist)->where('month_year', $value)->exists();
        } else {
            return !ConfigMonetize::where('month_year', $value)->exists() && ($total == 100);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->total != 100) {
            return 'the total percentage must equal 100';
        } else {
            return 'The :attribute allready exist.';
        }
    }
}
