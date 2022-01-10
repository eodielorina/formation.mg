<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\module;
use App\formation;
use App\programme;
use App\Niveau;
use App\cfp;
use PDF;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

/*================ importation class Export et import ======================*/
use App\Exports\FormationExport;
use App\Imports\FormationImport;

use Excel;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function index($id = null)
    {
        $id_user = Auth::user()->id;
        $cfp_id =cfp::where('user_id', $id_user)->value('id');
        if (Gate::allows('isCFP')) {
            $infos = DB::select('select * from moduleformation where cfp_id = ?', [$cfp_id]);
            $categorie = formation::where('cfp_id', $cfp_id)->get();
        }
        if (Gate::allows('isSuperAdmin')) {
            $infos = DB::select('select * from moduleformation');
            $categorie = formation::all();
        }
        return view('admin.module.module', compact('infos', 'categorie'));
    }

    /*   ====================  Generate PDF gestion de Catalogue     */

    public function generatePDF()
    {
        $module = new module();
        $formation = new formation();

        $categories = $formation->orderBy('nom_formation')->get();
        $modulo = $module->orderBy('Reference')->with('formation')->get();
        $programmes = $module->getInfo_programme();

        PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a4",
            "dpi" => 130
        ]);

        $data = ['title' => 'Laravel 7 Generate PDF From View Example Tutorial'];
        $pdf = PDF::loadView('admin.pdf.pdf_catalogue', compact('modulo', 'categories', 'programmes'));

        return $pdf->download('gestion de catalogue.pdf');
    }

    /*======================  Generate Export Excel gestion de Catalogue =================*/

    public function importExportView()
    {
        return view('admin.excel.excelCatalogue');
    }

    public function export()
    {
        return Excel::download(new FormationExport, 'gestion de catalogue.xlsx');
    }

    public function import()
    {

        Excel::import(new FormationImport, request()->file('file'));
    }

    public function create()
    {
        if (Gate::allows('isCFP')) {
            $id_user = Auth::user()->id;
            $cfp_id = cfp::where('user_id', $id_user)->value('id');
            $liste = formation::orderBy('nom_formation')->get();
            $niveau = Niveau::all();
        } else {
            $liste = formation::orderBy('nom_formation')->get();
            $niveau = Niveau::all();
        }

        return view('admin.module.nouveauModule', compact('liste', 'niveau'));
    }

    public function store(Request $request)
    {
        //condition de validation de formulaire
        $request->validate(
            [
                'reference' => ["required"],
                'nom_module' => ["required"],
                'prix' =>  ["required"],
                'prerequis' => ["required"],
                'jour' => ["required"],
                'objectifs' => ["required"],
                'description' => ["required"],
                'materiel' => ["required"]
            ],
            [
                'reference.required' => 'Veuillez remplir le champ',
                'nom_module.required' => 'Veuillez remplir le champ',
                'prix.required' => 'Veuillez remplir le champ',
                'prerequis.required' => 'Veuillez remplir le champ',
                'jour.required' => 'Veuillez remplir le champ',
                'objectifs.requires' => 'Veuillez remplir le champ',
                'materiel.required' => 'Veuillez remplir le champ',
                'description.required' => 'Veuillez remplir le champ',

            ]
        );
        //enregistrer les projets dans la bdd
        $module = new module();
        $module->reference = $request->reference;
        $module->nom_module = $request->nom_module;
        $module->formation_id = $request->categorie;
        $module->prix = $request->prix;
        $module->duree = $request->duree;
        $module->duree_jour = $request->jour;
        $module->prerequis = $request->prerequis;
        $module->objectif = $request->objectifs;
        $module->description = $request->description;
        $module->modalite_formation = $request->modalite;
        $module->materiel_necessaire = $request->materiel;
        $module->niveau_id = $request->niveau;
        $module->cible = $request->cible;
        $module->save();
        return redirect()->route('liste_module');
    }


    public function show($id)
    {
        $categorie = formation::orderBy('nom_formation')->get();
        $module = module::where('formation_id', $id)->orderBy('Reference')->with('Formation')->get();
        return view('admin.module.module', compact('module', 'categorie'));
    }

    public function edit(Request $request)
    {
        $id = $request->Id;
        $mod = module::where('id', $id)->get();
        return response()->json($mod);
    }

    public function affichage(Request $request)
    {
        $id = $request->Id;
        $mod = programme::where('module_id', $id)->with('Module')->get();
        $id_formation = module::where('id', $id)->value('formation_id');
        $nom_formation = formation::where('id', $id_formation)->value('nom_formation');
        return response()->json([$mod, $nom_formation]);
    }

    public function update(Request $request)
    {
        $id = $request->id_value;

        //modifier les données
        $reference = $request->reference;
        $nom_module = $request->nom_module;
        $prix = $request->prix;
        $duree = $request->duree;
        $duree_jour = $request->duree_jour;
        $modalite = $request->modalite_formation;
        $prerequis = $request->prerequis;
        $objectif = $request->objectif;
        $materiel = $request->materiel;
        $description = $request->description;

        module::where('id', $id)
            ->update([
                'reference' => $reference,
                'nom_module' => $nom_module,
                'prix' => $prix,
                'duree' => $duree,
                'duree_jour' => $duree_jour,
                'prerequis' => $prerequis,
                'objectif' => $objectif,
                'modalite_formation' => $modalite,
                'description' => $description,
                'materiel_necessaire' => $materiel
            ]);

        return redirect()->route('liste_module');
    }

    public function destroy(Request $request)
    {
        $id = $request->Id;
        $module = module::find($id);
        $module->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',

            ]
        );
    }

    public function getModulesReference(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $modules = module::orderby('reference', 'asc')->select('id', 'reference')->limit(5)->get();
        } else {
            $modules = module::orderby('reference', 'asc')->select('id', 'reference')->where('reference', 'like', $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($modules as $module) {
            $response[] = array("value" => $module->id, "label" => $module->reference);
        }
        return response()->json($response);
    }

    public function rechercheReference(Request $request)
    {
        $reference = $request->reference;
        if ($reference == '') {
            $module = module::orderBy('Reference')->with('formation')->get();
        } else {
            $module = module::where('reference', $reference)->get();
        }
        $categorie = formation::orderBy('nom_formation')->get();
        return view('admin.module.module', compact('module', 'categorie'));
    }
    public function recherchecategorie(Request $request)
    {

        $ctg = $request->categorie;

        if ($ctg == '') {
            $formation = formation::all();
        } else {
            $categorie = formation::where('nom_formation', $ctg)->get();
        }
        $formation_id = formation::where('nom_formation', $ctg)->value('id');
        $module =module::where('formation_id', $formation_id)->get();
        return view('admin.module.module', compact('categorie', 'module'));
    }
    public function getCategorie(Request $request)
    {
        $recheche = $request->recheche;
        if ($recheche == '') {
            $formation = formation::orderby('nom_formation', 'asc')->select('id', 'nom_formation')->limit(5)->get();
        } else {
            $formation = formation::orderby('nom_formation', 'asc')->select('id', 'nom_formation')->where('nom_formation', 'like', $recheche . '%')->limit(5)->get();
        }
        $response = array();
        foreach ($formation as $form) {
            $response[] = array("value" => $form->id, "label" => $form->nom_formation);
        }
        return response()->json($response);
    }
}