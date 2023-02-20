<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ValidLibur implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        // dd($value);
        if(!empty($value)) {
            $tgl_libur = [];
            $master_libur = DB::table('master_libur')->get(['tanggal']);
            foreach ($master_libur as $key) {
                $tgl_libur[] = $key->tanggal;
            }

            if (!in_array($value->format('Y-m-d'), $tgl_libur) && $value->format('l') != 'Sunday') {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Hari Libur Nasional dan hari Minggu tidak dapat dimasukkan';
    }
}
