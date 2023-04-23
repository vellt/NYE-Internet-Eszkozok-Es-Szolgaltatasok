<?php
namespace App\Validators;

class UpdatePwdValidator
{
    public static function rules()
    {
        return [
            'aktualis_jelszo' => 'required|string|min:8|max:255',
            'uj_jelszo' => 'required|string|min:8|max:255|different:aktualis_jelszo',
            'uj_jelszo_megerosites' => 'required|same:uj_jelszo',
        ];
    }

    public static function messages()
    {
        return [
            'aktualis_jelszo.required' => 'Az aktuális jelszó beküldése kötelező.',
            'aktualis_jelszo.string'=>'Az aktuális jelszónak \'string\' típusúnak kell lennie.',
            'aktualis_jelszo.min'=>'Az aktuális jelszónak legalább 8 karakter hosszúnak kell lennie.',
            'aktualis_jelszo.max'=>'Az aktuális jelszó legfeljebb 255 karakter hosszú lehet.',

            'uj_jelszo.required' => 'Az új jelszó beküldése kötelező.',
            'uj_jelszo.string'=>'Az új jelszónak \'string\' típusúnak kell lennie.',
            'uj_jelszo.min'=>'Az új jelszónak legalább 8 karakter hosszúnak kell lennie.',
            'uj_jelszo.max'=>'Az új jelszó legfeljebb 255 karakter hosszú lehet.',
            'uj_jelszo.different'=>'Az akuális jelszónak megadott értéktől eltérő jelszót lehet csak rögzíteni.',

            'uj_jelszo_megerosites.required' => 'Az új jelszó megerősítésének beküldése kötelező.',
            'uj_jelszo_megerosites.same'=>'Az új jelszó és az új jelszó megerősítésnek egyeznie kell.',
        ];
    }
}
