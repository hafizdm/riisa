<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Validator;

class ValidasiLibur implements Rule
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
        // $tgl_libur = [];
        // $tgl_checked[] = $value;
        // $master_libur = DB::table('master_libur')->get(['tanggal']);
        // foreach ($master_libur as $key) {
        //     $tgl_libur[] = $key->tanggal;
        // }
        // //return $value;
        // if (!in_array($tgl_checked->format('Y-m-d'), $tgl_libur) || $tgl_checked->format('l') != 'Sunday') {
        //     // dd($value);
        //     return true;
        // } else {
        //     return false;
        // }
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
