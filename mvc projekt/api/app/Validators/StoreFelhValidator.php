<?php

namespace App\Validators;


class StoreFelhValidator
{
    public static function rules()
    {
        return [
            'vezeteknev'=>'required|string|min:1|max:50',
            'keresztnev'=>'required|string|min:1|max:50',
            'szuletesi_datum'=>'required|date',
            'email'=>'required|email:rfc,dns|max:62|unique:felhasznalok,email',
            'jelszo'=>'required|string|min:8|max:255',
            'jelszo_megerosites' => 'required|same:jelszo',
            'nem'=>'required|boolean',
            'profilkep'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hirelevelezes'=>'required|boolean',
            'gdpr_elfogadva'=>'required|boolean|accepted',
        ];
    }

    public static function messages()
    {
        return [
            'vezeteknev.required'=>'A vezetéknév beküldése kötelező.',
            'vezeteknev.string'=>'A vezetéknévnek \'string\' típusúnak kell lennie.',
            'vezeteknev.min'=>'A vezetéknévnek legalább 1 karakter hosszúnak kell lennie.',
            'vezeteknev.max'=>'A vezetéknév legfeljebb 50 karakter hosszú lehet.',
            'keresztnev.required'=>'A keresztnév beküldése kötelező.',
            'keresztnev.string'=>'A keresztnévnek \'string\' típusúnak kell lennie.',
            'keresztnev.min'=>'A keresztnévnek legalább 1 karakter hosszúnak kell lennie.',
            'keresztnev.max'=>'A keresztnév legfeljebb 50 karakter hosszú lehet.',
            'szuletesi_datum.required'=>'A születési dátum beküldése kötelező.',
            'szuletesi_datum.date'=>'A születési dátumnak \'date\' típusúnak kell lennie.',
            'email.required'=>'Az E-mail-cím beküldése kötelező.',
            'email.email'=>'Érvénytelen E-mail-cím.',
            'email.max'=>'Az E-mail-cím legfeljebb 62 karakter hosszú lehet.',
            'email.unique'=>'Ezzel az E-mail-címmel már regisztráltak.',
            'jelszo.required' => 'A jelszó beküldése kötelező.',
            'jelszo.string'=>'A jelszónak \'string\' típusúnak kell lennie.',
            'jelszo.min'=>'A jelszónak legalább 8 karakter hosszúnak kell lennie.',
            'jelszo.max'=>'A jelszó legfeljebb 255 karakter hosszú lehet.',
            'jelszo_megerosites.required'=>'A jelszó megerősítésnek beküldése kötelező.',
            'jelszo_megerosites.same'=>'A jelszó és a jelszó megerősítésnek egyeznie kell.',
            'nem.required'=>'A felhasználó nemének beküldése kötelező.',
            'nem.boolean'=>'A felhasználó nemének \'bool\' típusúnak kell lennie.',
            'profilkep.string'=>'A képnek \'image\' típusúnak kell lennie.',
            'profilkep.mimes'=>'Nem megfelelő formátum. Kérem törekedjen a következő formátumok használatára: jpeg,png,jpg,gif,svg.',
            'profilkep.max'=>'A kép legfeljebb 2048 kilobájt (2 MB) lehet.',
            'hirelevelezes.required'=>'A hírlevelezési mező beküldése kötelező.',
            'hirelevelezes.boolean'=>'A hírlevelezési mező értékének \'bool\' típusúnak kell lennie.',
            'gdpr_elfogadva.required'=>'A GDPR mező beküldése kötelező.',
            'gdpr_elfogadva.boolean'=>'A GDPR-nek \'bool\' típusúnak kell lennie.',
            'gdpr_elfogadva.accepted'=>'A GDPR elfogadása kötelező.',
        ];
    }
}
