<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JogiDokumentum;
use App\Validators\UpdateDokuValidator;
use App\Validators\StoreDokuValidator;

class JogiDokumentumControler extends Controller
{
    public function show($route){
        try{
            $dokumentum=JogiDokumentum::all()->where('utvonal', $route)->first();
            if($dokumentum){
                return response()->json([
                    'status'=>true,
                    'message'=>'A dokumentum sikeresen lekérve.',
                    'errors'=>null,
                    'data'=>$dokumentum,
                    ]);
            }else {
                return response()->json([
                    'status'=>false,
                    'message'=>'Ez a domumentum nem található.',
                    'errors'=>null,
                    'data'=>null,
                    ],404);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'Valami nagyon félre ment!',
                'errors'=>null,
                'data'=>null,
                ],500);
        }
    }

    public function index(){
       try{
            $dokumentumok=JogiDokumentum::all();
            if($dokumentumok){
                return response()->json([
                    'status'=>true,
                    'message'=>'A dokumentumok sikeresen lekérve.',
                    'errors'=>null,
                    'data'=>$dokumentumok,
                    ]);
            }else {
                return response()->json([
                    'status'=>false,
                    'message'=>'Ez a domumentum nem található.',
                    'errors'=>null,
                    'data'=>null,
                    ],404);
            }
       }catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'Valami nagyon félre ment!',
                'errors'=>null,
                'data'=>null,
                ],500);
        }
    }

    public function update(Request $request, $route){
        try{
            $dokumentum=JogiDokumentum::all()->where('utvonal', $route)->first();
            if($dokumentum){
                $request->validate(UpdateDokuValidator::rules($request),UpdateDokuValidator::messages());
                $data=[];
                foreach((new JogiDokumentum)->getFillable() as $fill){
                    if ($request->filled($fill)) $data[$fill] = $request[$fill];
                }
                $dokumentum->update($data);

                if($data!=[]){
                    return response()->json([
                    'status'=>true,
                    'message'=>'Az adatok sikeresen frissítve.',
                    'errors'=>null,
                    'data'=>$dokumentum,
                    ]);
                }else{
                    return response()->json([
                    'status'=>false,
                    'message'=>'Nincs frissítendő adat megadva.',
                    'errors'=>null,
                    'data'=>null,
                    ],400);
                }
            } else {
                return response()->json([
                    'status'=>false,
                    'message'=>'Ez a domumentum nem található.',
                    'errors'=>null,
                    'data'=>null,
                    ],404);
            }
        }
        catch(\Illuminate\Validation\ValidationException $th){
            return response()->json([
                'status'=>false,
                'message'=>'Az adatok nem megfelelőek. Kérem ellenőrízze azokat! ('.($th->validator->errors()->count()).' hiba)',
                'errors'=>$th->validator->errors(),
                'data'=>null,
                ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'Valami nagyon félre ment!',
                'errors'=>null,
                'data'=>null,
                ],500);
        }
    }

    public function store(Request $request){
        try{
            $request->validate(StoreDokuValidator::rules(),StoreDokuValidator::messages());
            $data=[];
            foreach((new JogiDokumentum)->getFillable() as $fill){
                if ($request->filled($fill)) $data[$fill] = $request[$fill];
            }
            $dokumentum= JogiDokumentum::create($data);

            return response()->json([
                'status'=>true,
                'message'=>'Az adatok sikeresen rögzítve.',
                'errors'=>null,
                'data'=>$dokumentum,
                ]);
        }
        catch(\Illuminate\Validation\ValidationException $th){
            return response()->json([
                'status'=>false,
                'message'=>'Az adatok nem megfelelőek. Kérem ellenőrízze azokat! ('.($th->validator->errors()->count()).' hiba)',
                'errors'=>$th->validator->errors(),
                'data'=>null,
                ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'Valami nagyon félre ment!',
                'errors'=>null,
                'data'=>null,
                ],500);
        }
    }

    public function delete($route){
        try{
            $dokumentum=JogiDokumentum::all()->where('utvonal', $route)->first();
            if($dokumentum){
                $dokumentum->delete();
                return response()->json([
                    'status'=>true,
                    'message'=>'Dokumentum törölve.',
                    'errors'=>null,
                    'data'=>null,
                    ]);
            }else {
                return response()->json([
                    'status'=>false,
                    'message'=>'Ez a domumentum nem található.',
                    'errors'=>null,
                    'data'=>null,
                    ],404);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'Valami nagyon félre ment!',
                'errors'=>null,
                'data'=>null,
                ],500);
        }
    }
}
