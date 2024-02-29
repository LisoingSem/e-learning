<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    function btn_delete($route_name, $id){
         /* add check permission here
             ---------
        */
        $btn_delete = '';
        $id = myEncrypt($id);
        $url = route($route_name);
        $btn_delete = '<button type="button" class="btn btn-danger btn-sm" key="'.$id.'" url="'.$url.'" _token="'.csrf_token().'" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button>' ;
        return $btn_delete;
    }

    function btn_move_to_trush($route_name, $id){
        /* add check permission here
            ---------
       */
       $btn_move_to_trush = '';
       $id = myEncrypt($id);
       $url = route($route_name);
       $btn_move_to_trush = '<button type="button" class="btn btn-danger btn-sm" key="'.$id.'" url="'.$url.'" _token="'.csrf_token().'" onclick="moveTrushRow(this)"><i class="fa fa-trash"></i></button>' ;
       return $btn_move_to_trush;
   }

    function btn_hidden($route_name, $id){
        /* add check permission here
            ---------
       */
       $btn_hidden = '';
       $id = myEncrypt($id);
       $url = route($route_name);
       $btn_hidden = '<button type="button" class="btn btn-warning btn-sm" key="'.$id.'" url="'.$url.'" _token="'.csrf_token().'" onclick="hiddenRow(this)"><i class="fa fa-exclamation-triangle"></i></button>' ;
       return $btn_hidden;
   }

   function btn_show($route_name, $id){
    /* add check permission here
        ---------
    */
    $btn_show = '';
    $id = myEncrypt($id);
    $url = route($route_name);
    $btn_show = '<button type="button" class="btn btn-warning btn-sm" key="'.$id.'" url="'.$url.'" _token="'.csrf_token().'" onclick="showRow(this)"><i class="fa fa-recycle"></i></button>' ;
    return $btn_show;
    }

    function btn_restore($route_name, $id){
            /* add check permission here
                ---------
        */
        $btn_restore = '';
        $id = myEncrypt($id);
        $url = route($route_name);
        $btn_restore = '<button type="button" class="btn btn-warning btn-sm" key="'.$id.'" url="'.$url.'" _token="'.csrf_token().'" onclick="restoreRow(this)"><i class="fa fa-recycle"></i></button>' ;
        return $btn_restore;
    }

    function btn_edit($route_name, $id, $is_redirect = 0){
         /* add check permission here
             ---------
        */
        $id = myEncrypt($id);
        $btn_edit = '';
        if($is_redirect){
            $url = route($route_name, $id);
            $btn_edit = "<a href='$url' class='btn btn-success btn-sm'><i class='fa fa-edit'></i></a>";
        }else{
            $btn_edit = '<button type="button" class="btn btn-success btn-sm" key="'.$id.'" onclick="editRow(this)"><i class="fa fa-edit"></i></button>' ;
        }
        return $btn_edit;
    }

    function btn_details($route_name, $id, $is_redirect = 0){
       $id = myEncrypt($id);
       $btn_details = '';
       if($is_redirect){
           $url = route($route_name, $id);
           $btn_details = "<a href='$url' class='btn btn-info btn-sm'><i class='fa fa-info-circle'></i></a>";
       }else{
           $btn_details = '<button type="button" class="btn btn-info btn-sm" key="'.$id.'" onclick="detailsRow(this)"><i class="fa fa-info-circle"></i></button>' ;
       }
       return $btn_details;
   }

    public function dropdownAction($list){
        return '<div class="dropdown position-static p-0">
        <button role="button" type="button" class="btn btn-xs text-lg" data-toggle="dropdown" id="dropdownMenuButton" >
          ...
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
          '.$list.'
        </div>
      </div>';
     }

}
