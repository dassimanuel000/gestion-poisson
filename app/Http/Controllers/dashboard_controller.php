<?php

namespace App\Http\Controllers;

use App\bus_eleve;
use App\classe;
use App\creche;
use App\eleve;
use App\enseignant;
use App\scolarite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class dashboard_controller extends Controller
{
    //
    public function index()
    {
        return view('index');
    }

    public function add_eleve()
    {
        return view('eleves.add_eleve');
    }

    public function form_add_eleve(Request $request)
    {
        $print_eleve = DB::select('select * from eleve ');
        $count = count($print_eleve);

        $add_eleve = new eleve();
        $add_eleve->matricule = $request->input('id_classe').strtoupper($request->input('name_eleve')).$count;
        $add_eleve->name_eleve = $request->input('name_eleve');
        $add_eleve->prenom_eleve = $request->input('prenom_eleve');
        $add_eleve->id_classe = $request->input('id_classe');
        $add_eleve->lieu_naissance = $request->input('lieu_naissance');
        $add_eleve->age = $request->input('age');
        $add_eleve->name_parent = $request->input('name_parent');
        $add_eleve->tel_parent = $request->input('tel_parent');
        $add_eleve->adresse = $request->input('adresse');
        $add_eleve->sexe = $request->input('sexe');
        $add_eleve->tel_urgence = $request->input('tel_urgence');
        $add_eleve->name_tuteur = $request->input('name_tuteur');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();// extension
            $filename = time().'.'.$extension;
            $file->move('uploads/enseignant/', $filename);
            $add_eleve->image = $filename;
        }else {
            //return $request;
            $add_eleve->image = '';
        }

        $add_eleve->inscription = $request->input('inscription');
        $add_eleve->tranche1 = $request->input('tranche1');
        $add_eleve->tranche2 = $request->input('tranche2');

        $add_eleve->save();

        $nbre_eleve = DB::select('select * from eleve where id_classe = '.$request->input('id_classe').'');
        $nbre_eleve = count($nbre_eleve);
        $nbre_eleve = $nbre_eleve + 0;
        $update_nbre_eleve = DB::update('update classe set nbre_eleve = '.$nbre_eleve.' where id = '.$request->input('id_classe').'');

        if ($add_eleve) {
            if ($request->input('print_eleve') == 1) {
                $last_id = $add_eleve->id;
                //$print_eleve = DB::select('select * from eleve where id = '.$last_id.'');
                return redirect('/print_eleve/'.$last_id)->with('last_id',$last_id);
            }
            return redirect('/add_eleve')->with('success', 'L"ELEVE A ETE AJOUTEE');
        } else {
            return redirect('/add_eleve')->with('error', 'UNE ERREUR EST SURVENU');
        }
    }

    public function print_eleve($last_id)
    {
        return view('eleves.print_eleve')->with('last_id', $last_id);
    }

    public function list_eleve()
    {
        return view('eleves.list_eleve');
    }

    public function search_eleve()
    {
        return view('eleves.search_eleve');
    }

    public function edit_eleve($id)
    {
        $edit_eleve = eleve::find($id);
        return view('eleves.edit_eleve')->with('edit_eleve',$edit_eleve);
    }

    public function form_edit_eleve(Request $request, $id)
    {
        $edit_eleve = eleve::find($id);
        $edit_eleve->matricule = $edit_eleve->matricule;
        $edit_eleve->name_eleve = $request->input('name_eleve');
        $edit_eleve->prenom_eleve = $request->input('prenom_eleve');
        $edit_eleve->id_classe = $request->input('id_classe');
        $edit_eleve->lieu_naissance = $request->input('lieu_naissance');
        $edit_eleve->age = $request->input('age');
        $edit_eleve->name_parent = $request->input('name_parent');
        $edit_eleve->tel_parent = $request->input('tel_parent');
        $edit_eleve->adresse = $request->input('adresse');
        $edit_eleve->sexe = $request->input('sexe');
        $edit_eleve->tel_urgence = $request->input('tel_urgence');
        $edit_eleve->name_tuteur = $request->input('name_tuteur');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();// extension
            $filename = time().'.'.$extension;
            $file->move('uploads/enseignant/', $filename);
            $edit_eleve->image = $filename;
        }else {
            //return $request;
            $edit_eleve->image = $edit_eleve->image;
        }

        $edit_eleve->inscription = $request->input('inscription');
        $edit_eleve->tranche1 = $request->input('tranche1');
        $edit_eleve->tranche2 = $request->input('tranche2');

        $edit_eleve->update();

        if ($edit_eleve) {
            return redirect('/list_eleve')->with('success', 'L"ELEVE A ETE MOdifie');
        } else {
            return redirect('/list_eleve')->with('error', 'UNE ERREUR EST SURVENU');
        }
    }


    //////////////////////////////////////

    public function search(Request $request)
    {
      
       if($request->ajax()){
    
         $output="";
         $i=0;
         
         $search = eleve::where('name_eleve','LIKE','%'.$request->search."%")
                                    ->Orwhere('matricule','LIKE','%'.$request->search."%")
                                    ->Orwhere('prenom_eleve','LIKE','%'.$request->search."%")
                                    ->get();
         
         if($search){
      
            foreach ($search as  $item) {
            
             $output.='<div class="col-md-4">
							<div class="card card-post card-round">
								<div class="card-body">
									<div class="d-flex">
										<div class="avatar">
											<img src="../uploads/enseignant/'.$item->image.' " alt="no-image" class="avatar-img rounded-circle">
										</div>
										<div class="info-post ml-2">
											<p class="username">'.$item->name_eleve.' ,'.$item->prenom_eleve.'</p>
											<p class="date text-muted">'.$item->age.' &agrave; '.$item->lieu_naissance.'</p>
										</div>
									</div>
									<div class="separator-solid"></div>
									<h5 class="card-s">
                                        <ol type="none">
                                            <li>Nom du Parent : '.$item->name_parent.'</li>
                                            <li>Telephone du Parent :'.$item->tel_parent.'</li>
                                        </ol>
                                    </h5>
                                    <div class="col-sm-6 col-md-12">
                                        <div class="card card-stats card-round">
                                            <div class="card-body ">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="icon-big text-center">
                                                            <i class="flaticon-coins text-success"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 col-stats">
                                                        <div class="numbers">
                                                            <p class="card-category">Total Verse</p>
                                                            <h4 class="card-title"> '.number_format($item->inscription).'<br>'.number_format($item->tranche1).'<br>'.number_format($item->tranche2).'</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="/add_scolarite/'.$item->id.'" class="btn btn-success btn-rounded btn-block btn-sm">AJOUTER UN VERSEMENT</a>
                                    <a href="/print_scolarite/'.$item->id.'" class="btn btn-primary btn-rounded btn-block btn-sm">IMPRIMER LES VERSEMENTS</a>
                                    <a href="/list_scolarite/'.$item->id.'" class="btn btn-primary btn-rounded btn-block btn-sm">LISTES DE TOUS LES VERSEMENTS</a>
								</div>
							</div>
						</div>
             ';

              $i++;
            }
            return $output;  
 
         }else {
            $output.='<div class="col-md-12">
							<div class="card full-height ">
								<div class="card-body">
                                    <div class="alert alert-danger" role="alert">
                                        <b>AUCUN ELEVE AVEC CES IDENTIFIANTS</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                ';
                
            return $output;  
         }
   
       }
 
    }

    ///////////////////////////////////////

    public function add_classe()
    {
        return view('classe.add_classe');
    }

    public function form_add_classe(Request $request)
    {
        $classe = new classe();
        $classe->name_classe = $request->input('name_classe');
        $classe->initial_classe = $request->input('initial_classe');
        $classe->pension = $request->input('pension');
        $classe->titulaire_classe = $request->input('titulaire_classe');
        $classe->save();
        if ($classe) {
            return redirect('/add_classe')->with('success', 'LA CLASSE A ETE AJOUTEE');
        } else {
            return redirect('/add_classe')->with('error', 'UNE ERREUR EST SURVENU');
        }
    }

    public function form_edit_classe(Request $request)
    {
        $classe = classe::find($request->input('id'));
        $classe->name_classe = $request->input('name_classe');
        $classe->initial_classe = $request->input('initial_classe');
        $classe->pension = $request->input('pension');
        $classe->titulaire_classe = $request->input('titulaire_classe');
        $classe->save();
        if ($classe) {
            return redirect('/all_classe')->with('success', 'LA CLASSE A ETE MODIFIEE');
        } else {
            return redirect('/all_classe')->with('error', 'UNE ERREUR EST SURVENU');
        }
    }

    public function list_classe(Request $request, $id)
    {
        $list_classe = classe::find($id);
        return view('classe.list_classe')->with('list_classe',$list_classe);
    }

    public function specific_classe(Request $request, $id)
    {
        $specific_classe = DB::select('select * from eleve where id_classe = '.$id.'');
        return view('classe.specific_classe')->with('specific_classe',$specific_classe);
    }

    public function all_classe()
    {
        $all_classe = DB::table('classe')
                            ->get();
        return view('classe.all_classe')->with('all_classe', $all_classe);
    }

    public function edit_classe($id)
    {
        $edit_classe = classe::find($id);
        return view('classe.edit_classe')->with('edit_classe',$edit_classe);
    }

    ///////////////////////

    public function add_enseignant()
    {
        return view('enseignant.enseignant');
    }

    public function form_add_enseignant(Request $request)
    {
        $add_enseignant = new enseignant();
        $add_enseignant->name_enseignant = $request->input('name_enseignant');
        $add_enseignant->id_classe = $request->input('id_classe');
        $add_enseignant->age = $request->input('age');
        $add_enseignant->matricule = $request->input('matricule');
        $add_enseignant->tel_enseignant = $request->input('tel_enseignant');
        $add_enseignant->adresse_enseignant = $request->input('adresse_enseignant');
        $add_enseignant->salaire = $request->input('salaire');
        $array = array();
        array_push($array, $request->input('description'));
        $add_enseignant->description = json_encode($array);
        $add_enseignant->sexe = $request->input('sexe');
        $add_enseignant->tel_urgence = $request->input('tel_urgence');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();// extension
            $filename = time().'.'.$extension;
            $file->move('uploads/enseignant/', $filename);
            $add_enseignant->image = $filename;
        }else {
            return $request;
            $add_enseignant->image = '';
        }

        $add_enseignant->save();

        if ($add_enseignant) {
            return redirect('/add_enseignant')->with('success', 'L"ENSEIGNANT A ETE AJOUTEE');
        } else {
            return redirect('/add_enseignant')->with('error', 'UNE ERREUR EST SURVENU');
        }
    }

    public function list_enseignant()
    {
        $list_enseignant = DB::table('enseignant')
                                    ->orderBy('name_enseignant', 'ASC')
                                    ->paginate(10);

        return view('enseignant.list_enseignant')->with('list_enseignant',$list_enseignant);
    }

    public function voir_enseignant($id)
    {
        $voir_enseignant = enseignant::find($id);
        return view('enseignant.voir_enseignant')->with('voir_enseignant',$voir_enseignant);
    }

    public function edit_enseignant($id)
    {
        $edit_enseignant = enseignant::find($id);
        return view('enseignant.edit_enseignant')->with('edit_enseignant',$edit_enseignant);
    }

    public function form_edit_enseignant(Request $request, $id)
    {
        $add_enseignant = enseignant::find($id);
        $add_enseignant->name_enseignant = $request->input('name_enseignant');
        $add_enseignant->id_classe = $request->input('id_classe');
        
        if ($request->input('age') == null) {
            $add_enseignant->age = $add_enseignant->age;
        }else {
            $add_enseignant->age = $request->input('age');
        }

        $add_enseignant->matricule = $request->input('matricule');
        $add_enseignant->tel_enseignant = $request->input('tel_enseignant');
        $add_enseignant->adresse_enseignant = $request->input('adresse_enseignant');
        $add_enseignant->salaire = $request->input('salaire');

        $array = array();
        array_push($array, $request->input('description'));
        $add_enseignant->description = $array;
        $add_enseignant->sexe = $request->input('sexe');
        $add_enseignant->tel_urgence = $request->input('tel_urgence');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();// extension
            $filename = time().'.'.$extension;
            $file->move('uploads/enseignant/', $filename);
            $add_enseignant->image = $filename;
        }else {
            return $request;
            $add_enseignant->image = '';
        }

        $add_enseignant->update();

        if ($add_enseignant) {
            return redirect('/voir_enseignant/'.$id.'')->with('success', 'L"ENSEIGNANT A ETE MODIFIE');
        } else {
            return redirect('/voir_enseignant/'.$id.'')->with('error', 'UNE ERREUR EST SURVENU');
        }
    }

    /**
     * 
     * SCOLARITE
     * 
     */


    public function add_scolarite($id)
    {
        $add_scolarite = eleve::find($id);
        return view('scolarite.add_scolarite')->with('add_scolarite',$add_scolarite);
    }

    public function print_scolarite($id)
    {
        $item = eleve::find($id);
        return view('scolarite.print_scolarite')->with('item',$item);
    }

    public function form_add_scolarite(Request $request)
    {
        $scolarite = new scolarite();
        $scolarite->id_eleve = $request->input('id_eleve');
        $scolarite->motif = $request->input('motif');
        $scolarite->montant = $request->input('montant');
        if ($request->input('montant') <= 500) {
            return redirect('/search_eleve')->with('error', 'UNE ERREUR EST SURVENU | LE PRIX VERSE EST TROP FAIBLE');
        }
        $scolarite->paiement = $request->input('paiement');
        //$scolarite->last_paiement = json_encode(json_encode(DB::select('select * from scolarite where id_eleve = '.$request->input('id_eleve').' ')));
        $scolarite->save();
        $last_id = $scolarite->id;
        $last_paiement = scolarite::find($last_id);
        $last_paiement->last_paiement = (json_encode(DB::select('select * from scolarite where id = '.$last_id.' ')));
        $last_paiement->save();

        if ($scolarite) {

            if ($request->input('motif') == 'tranche1') {

                $last_tranche1 = eleve::find($request->input('id_eleve'));
                $last_tranche1->tranche1 += $request->input('montant');
                $last_tranche1->save();
                //$tranche1 = DB::update('update eleve set tranche1 = '.$request->input('montant').' where id = '.$request->input('id_eleve').' ');

            } elseif ($request->input('motif') == 'tranche2') {

                $last_tranche2 = eleve::find($request->input('id_eleve'));
                $last_tranche2->tranche2 += $request->input('montant');
                $last_tranche2->save();

            } elseif ($request->input('motif') == 'inscription') {

                $last_inscription = eleve::find($request->input('id_eleve'));
                $last_inscription->inscription += $request->input('montant');
                $last_inscription->save();

            } elseif ($request->input('motif') == 'bus') {

                $bus_eleve = DB::update('update bus_eleve set paiement = '.$request->input('montant').' where id = '.$request->input('id_eleve').' ');

            } else {
                $last = false;
            }

            $item = eleve::find($request->input('id_eleve'));
            return redirect('/print_scolarite/'.$request->input('id_eleve'))->with('item',$item);

        } else {
            return redirect('/search_eleve')->with('error', 'UNE ERREUR EST SURVENU');
        }
    }

    public function list_scolarite()
    {
        return view('scolarite.list_scolarite');
    }

    public function list_scolarite_id($id)
    {
        $list_scolarite_id = eleve::find($id);
        return view('scolarite.list_scolarite_id')->with('list_scolarite_id',$list_scolarite_id);
    }

    public function red_list()
    {
        return view('scolarite.red_list');
    }



    /**
     * 
     * BUS
     * 
     */

     public function list_bus()
     {
        $list_bus = DB::table('bus_eleve')
                            ->orderBy('name', 'ASC')
                            ->paginate(100);
        return view('bus.list_bus')->with('list_bus',$list_bus);
     }

     public function add_bus()
     {
        return view('bus.add_bus');
     }

     public function search_bus(Request $request)
     {
       
        if($request->ajax()){
     
          $output="";
          $i=0;
          
          $search = eleve::where('name_eleve','LIKE','%'.$request->search."%")
                                     ->Orwhere('matricule','LIKE','%'.$request->search."%")
                                     ->Orwhere('prenom_eleve','LIKE','%'.$request->search."%")
                                     ->get();
          
          if($search){
       
             foreach ($search as  $item) {
             
              $output.='<div class="col-md-4">
                             <div class="card card-post card-round">
                                 <div class="card-body">
                                     <div class="d-flex">
                                         <div class="info-post ml-2">
                                             <p class="username">'.$item->name_eleve.' ,'.$item->prenom_eleve.'</p>
                                             <p class="date text-muted">'.$item->age.' &agrave; '.$item->lieu_naissance.'</p>
                                         </div>
                                     </div>
                                     <div class="separator-solid"></div>
                                     <h5 class="card-s">
                                         <ol type="none">
                                             <li>Nom du Parent : '.$item->name_parent.'</li>
                                             <li>Telephone du Parent :'.$item->tel_parent.'</li>
                                         </ol>
                                     </h5>
                                     <div class="col-sm-6 col-md-12">
                                         <div class="card card-stats card-round">
                                             <div class="card-body ">
                                                 <div class="row">
                                                     <div class="col-5">
                                                         <div class="icon-big text-center">
                                                             <i class="flaticon-coins text-success"></i>
                                                         </div>
                                                     </div>
                                                     <div class="col-7 col-stats">
                                                         <div class="numbers">
                                                             <p class="card-category">Total Verse</p>
                                                             <h4 class="card-title"> '.number_format($item->inscription).'<br>'.number_format($item->tranche1).'<br>'.number_format($item->tranche2).'</h4>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <a href="/add_bus/'.$item->id.'" class="btn btn-success btn-rounded btn-block btn-sm">AJOUTER CET ELEVE DANS LE TRANSPORT EN BUS</a>
                                     <a href="/add_scolarite/'.$item->id.'" class="btn btn-primary btn-rounded btn-block btn-sm">AJOUTER UN NOUVEAU VERSEMENT MENSUEL</a>
                                 </div>
                             </div>
                         </div>
              ';
 
               $i++;
             }
             return $output;  
  
          }else {
             $output.='<div class="col-md-12">
                             <div class="card full-height ">
                                 <div class="card-body">
                                     <div class="alert alert-danger" role="alert">
                                         <b>AUCUN ELEVE AVEC CES IDENTIFIANTS</b>
                                     </div>
                                 </div>
                             </div>
                         </div>
                 ';
                 
             return $output;  
          }
    
        }
     }

     public function add_bus_id($id)
     {
        $add_bus = eleve::find($id);
        return view('bus.add_bus_id')->with('add_bus',$add_bus);
     }

     public function form_add_bus(Request $request)
     {
        $bus_eleve = new bus_eleve();
        $bus_eleve->id_eleve = $request->input('id_eleve');
        $bus_eleve->name = $request->input('name');
        $bus_eleve->position = $request->input('position');
        $bus_eleve->paiement = $request->input('paiement');
        $bus_eleve->save();

        if ($bus_eleve) {
            return redirect('/add_bus')->with('success', 'LE VERSEMENT A ETE AJOUTEE');
        } else {
            return redirect('/add_bus')->with('error', 'UN PROBLEME EST VERVENU');
        }
        
     }

     public function print_bus()
     {
        $print_bus = DB::select('select * from bus_eleve ORDER BY name ASC');
        return view('bus.print_bus')->with('print_bus',$print_bus);
     }

     public function edit_bus($id)
     {
        $edit_bus = bus_eleve::find($id);
        return view('bus.edit_bus')->with('edit_bus',$edit_bus);
     }

     public function form_edit_bus(Request $request)
     {
        $bus_eleve = bus_eleve::find($request->input('id'));
        $bus_eleve->id_eleve = $request->input('id_eleve');
        $bus_eleve->name = $request->input('name');
        $bus_eleve->position = $request->input('position');
        $bus_eleve->paiement = $request->input('paiement');
        $bus_eleve->save();

        if ($bus_eleve) {
            return redirect('/list_bus')->with('success', 'LE VERSEMENT A ETE AJOUTEE');
        } else {
            return redirect('/list_bus')->with('error', 'UN PROBLEME EST VERVENU');
        }
     }

     /**
      * CRECHE
      */

    public function list_creche()
    {
        $list_creche = DB::select('select * from creche ORDER BY name ASC');
        return view('creche.list_creche')->with('list_creche',$list_creche);
    }

    public function add_creche()
    {
        return view('creche.add_creche')->with('add_creche');
    }

    public function form_add_creche(Request $request)
    {
        $add_eleve = new creche();
        $add_eleve->name = $request->input('name_eleve');
        $add_eleve->prenom = $request->input('prenom_eleve');
        $add_eleve->lieu_naissance = $request->input('lieu_naissance');
        $add_eleve->age = $request->input('age');
        $add_eleve->name_parent = $request->input('name_parent');
        $add_eleve->tel_parent = $request->input('tel_parent');
        $add_eleve->adresse = $request->input('adresse');
        $add_eleve->sexe = $request->input('sexe');
        $add_eleve->tel_urgence = $request->input('tel_urgence');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();// extension
            $filename = time().'.'.$extension;
            $file->move('uploads/enseignant/', $filename);
            $add_eleve->image = $filename;
        }else {
            //return $request;
            $add_eleve->image = '';
        }

        $add_eleve->paiement = $request->input('paiement');
        $add_eleve->save();
        $last_id = $add_eleve->id;

        if ($add_eleve) {
            if ($request->input('print_eleve') == 1) {
                return redirect('/print_creche/'.$last_id)->with('item',$add_eleve);
            }
            return redirect('/add_creche')->with('success', 'L"ELEVE A ETE AJOUTEE');
        } else {
            return redirect('/add_creche')->with('error', 'UNE ERREUR EST SURVENU');
        }
    }

    public function print_creche($id)
    {
        $print_creche = creche::find($id);
        return view('creche.print_creche')->with('print_creche',$print_creche);
    }

    public function edit_creche()
    {
        $list_creche = DB::select('select * from creche');
        return view('creche.edit_creche')->with('list_creche',$list_creche);
    }

    public function edit_creche_id($id)
    {
        $edit_creche = creche::find($id);
        return view('creche.edit_creche_id')->with('edit_creche',$edit_creche);
    }

    public function form_edit_creche(Request $request)
    {
        $add_eleve = creche::find($request->input('id'));
        $add_eleve->name = $request->input('name_eleve');
        $add_eleve->prenom = $request->input('prenom_eleve');
        $add_eleve->lieu_naissance = $request->input('lieu_naissance');
        $add_eleve->age = $request->input('age');
        $add_eleve->name_parent = $request->input('name_parent');
        $add_eleve->tel_parent = $request->input('tel_parent');
        $add_eleve->adresse = $request->input('adresse');
        $add_eleve->sexe = $request->input('sexe');
        $add_eleve->tel_urgence = $request->input('tel_urgence');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();// extension
            $filename = time().'.'.$extension;
            $file->move('uploads/enseignant/', $filename);
            $add_eleve->image = $filename;
        }else {
            //return $request;
            $add_eleve->image = '';
        }

        $add_eleve->paiement = $request->input('paiement');
        $add_eleve->save();
        $last_id = $add_eleve->id;

        if ($add_eleve) {
            if ($request->input('print_eleve') == 1) {
                return redirect('/print_creche/'.$last_id)->with('item',$add_eleve);
            }
            return redirect('/add_creche')->with('success', 'L"ELEVE A ETE AJOUTEE');
        } else {
            return redirect('/add_creche')->with('error', 'UNE ERREUR EST SURVENU');
        }
    }
}
