<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\FonctionGenerique;
use Illuminate\Support\Facades\DB;

class RoleUser extends Model
{
    //



    public function queryWhereRole_etp($val = [])
    {
        $query = "SELECT * FROM v_role_etp WHERE ";
        for ($i = 0; $i < count($val); $i++) {
            $query .= "id!=" . $val[$i]->role_id;
            if ($i + 1 < count($val)) {
                $query .= " AND ";
            }
        }
        return $query;
    }

    // public function queryUserStg($val=[]){
    //     $query="SELECT * FROM v_user_role WHERE ";
    //             for($i=0;$i<count($val);$i++)
    //             {
    //             $query.="user_id=".$val[$i]->user_id;
    //             if($i+1 < count($val)){
    //                 $query.=" AND ";
    //             }
    //             }
    //             return $query;

    // }
    // public function findUserStg($val=[]){
    //     $fonction = new FonctionGenerique();
    //     $query = $this->queryUserStg($val);
    //     $data =  DB::select($query);
    //     return $data;
    // }
    public function findNotRole($val = [])
    {
        $fonction = new FonctionGenerique();
        $query = $this->queryWhereRole_etp($val);
        $result =  DB::select($query);
        return $result;
    }

    public function getNotRoleUser($nomTab, $tabUser, $entreprise_id)
    {
        $fonct = new FonctionGenerique();
        $data = [];
        for ($j = 0; $j < count($tabUser); $j += 1) {
            $tab_role_actif = $fonct->findWhere($nomTab, ["entreprise_id", "user_id"], [$entreprise_id, $tabUser[$j]->user_id]);
            $data[$j]["role_inactif"] = $this->findNotRole($tab_role_actif);
            $data[$j]["user_id"] = $tabUser[$j]->user_id;
        }
        return $data;
    }




}
