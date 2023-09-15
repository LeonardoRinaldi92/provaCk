<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckNameController extends Controller
{
    public function checkNameAlcoolCategory(Request $request)
    {
        // Esegui la validazione utilizzando la classe AlcoolCategoryRequest
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:alcool_categories|max:255|min:3|regex:/^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-\s]+$/',
        ]);

        if ($validator->fails()) {
            // La validazione ha fallito, restituisci false
            return response()->json(['result' => false], 200);
        } else {
            // La validazione ha avuto successo, restituisci true
            return response()->json(['result' => true], 200);
        }
    }

    public function checkNameAlcools(Request $request)
    {
        // Esegui la validazione utilizzando la classe AlcoolCategoryRequest
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:alcools|max:255|min:3|regex:/^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-\s]+$/',
        ]);

        if ($validator->fails()) {
            // La validazione ha fallito, restituisci false
            return response()->json(['result' => false], 200);
        } else {
            // La validazione ha avuto successo, restituisci true
            return response()->json(['result' => true], 200);
        }
    }

    public function checkNameAromaticBitters(Request $request)
    {
        // Esegui la validazione utilizzando la classe AlcoolCategoryRequest
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:aromatic_bitters|max:255|min:3|regex:/^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-\s]+$/',
        ]);

        if ($validator->fails()) {
            // La validazione ha fallito, restituisci false
            return response()->json(['result' => false], 200);
        } else {
            // La validazione ha avuto successo, restituisci true
            return response()->json(['result' => true], 200);
        }
    }

    public function checkNameSodas(Request $request)
    {
        // Esegui la validazione utilizzando la classe AlcoolCategoryRequest
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:sodas|max:255|min:3|regex:/^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-\s]+$/',
        ]);

        if ($validator->fails()) {
            // La validazione ha fallito, restituisci false
            return response()->json(['result' => false], 200);
        } else {
            // La validazione ha avuto successo, restituisci true
            return response()->json(['result' => true], 200);
        }
    }

    public function checkNameJuices(Request $request)
    {
        // Esegui la validazione utilizzando la classe AlcoolCategoryRequest
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:juices|max:255|min:3|regex:/^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-\s]+$/',
        ]);

        if ($validator->fails()) {
            // La validazione ha fallito, restituisci false
            return response()->json(['result' => false], 200);
        } else {
            // La validazione ha avuto successo, restituisci true
            return response()->json(['result' => true], 200);
        }
    }

    public function CheckNameFruits(Request $request)
    {
        // Esegui la validazione utilizzando la classe AlcoolCategoryRequest
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:fruits|max:255|min:3|regex:/^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-\s]+$/',
        ]);

        if ($validator->fails()) {
            // La validazione ha fallito, restituisci false
            return response()->json(['result' => false], 200);
        } else {
            // La validazione ha avuto successo, restituisci true
            return response()->json(['result' => true], 200);
        }
    }

    public function CheckNameOthers(Request $request)
    {
        // Esegui la validazione utilizzando la classe AlcoolCategoryRequest
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:others|max:255|min:3|regex:/^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-\s]+$/',
        ]);

        if ($validator->fails()) {
            // La validazione ha fallito, restituisci false
            return response()->json(['result' => false], 200);
        } else {
            // La validazione ha avuto successo, restituisci true
            return response()->json(['result' => true], 200);
        }
    }

        public function CheckNameSyrups(Request $request)
    {
        // Esegui la validazione utilizzando la classe AlcoolCategoryRequest
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:syrups|max:255|min:3|regex:/^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-\s]+$/',
        ]);

        if ($validator->fails()) {
            // La validazione ha fallito, restituisci false
            return response()->json(['result' => false], 200);
        } else {
            // La validazione ha avuto successo, restituisci true
            return response()->json(['result' => true], 200);
        }
    }

    public function CheckNameSugars(Request $request)
    {
        // Esegui la validazione utilizzando la classe AlcoolCategoryRequest
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:sugars|max:255|min:3|regex:/^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-\s]+$/',
        ]);

        if ($validator->fails()) {
            // La validazione ha fallito, restituisci false
            return response()->json(['result' => false], 200);
        } else {
            // La validazione ha avuto successo, restituisci true
            return response()->json(['result' => true], 200);
        }
    }

    public function CheckNameGlass(Request $request)
    {
        // Esegui la validazione utilizzando la classe AlcoolCategoryRequest
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:glasses|max:255|min:3|regex:/^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-\s]+$/',
        ]);

        if ($validator->fails()) {
            // La validazione ha fallito, restituisci false
            return response()->json(['result' => false], 200);
        } else {
            // La validazione ha avuto successo, restituisci true
            return response()->json(['result' => true], 200);
        }
    }

    public function CheckNameEquipement(Request $request)
    {
        // Esegui la validazione utilizzando la classe AlcoolCategoryRequest
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:equipements|max:255|min:3|regex:/^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-\s]+$/',
        ]);

        if ($validator->fails()) {
            // La validazione ha fallito, restituisci false
            return response()->json(['result' => false], 200);
        } else {
            // La validazione ha avuto successo, restituisci true
            return response()->json(['result' => true], 200);
        }
    }
}
