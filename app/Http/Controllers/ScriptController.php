<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\User_group;
use App\Status;

class ScriptController extends Controller
{
    public function SearchKeyword()
    {
        $response = '<option value="">Select Search Keyword</option>';
        $src_type = $_GET['src_type'];
        $src_keyword = $_GET['src_keyword'];

        if ($src_type == 'status') {

            $status = Status::all();
            foreach($status as $statuses)
            {
                if($src_keyword == $statuses->id){$select = 'selected';}else{$select = ' ';}
                $response .= '<option value="'.$statuses->id.'" '.$select.'>'.$statuses->status.'</option>'; 
            }

        } elseif ($src_type == 'assing_to') {

            $user = User::where('user_role', '3')->get();
            foreach($user as $users)
            {
                if($src_keyword == $users->id){$select = 'selected';}else{$select = ' ';}
                $response .= '<option value="'.$users->id.'" '.$select.'>'.$users->name.'</option>'; 
            }
            
        } elseif ($src_type == 'department') {

            $dept = User_group::all();
            foreach($dept as $depts)
            {
                if($src_keyword == $depts->id){$select = 'selected';}else{$select = ' ';}
                $response .= '<option value="'.$depts->id.'" '.$select.'>'.$depts->name.'</option>'; 
            }

        }
        return $response;
    }
}
