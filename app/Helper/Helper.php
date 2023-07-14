<?php
namespace App\Helper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Logger\ConsoleLogger;

class Helper{

   
    public static function NumberIDGenerator($tableName,array $conditions=[], string $prefix,int $lenght):string
    {
        $model =DB::table($tableName);
        if(is_array($conditions)&& count($conditions)>0)
        {
            $model =$model ->where($conditions);
        }

    //    $data=\DB::table($tableName)->orderBy('id','desc')->first();
    //    $dataLatest=$data->id;
       $last3 = DB::table($tableName)->latest('id')->first();
        //dd($last3);
    //    if(is_null($last3->id))
    if(!$last3)
       {
        return $prefix. str_pad(
            (1),
             $lenght,
             '0',
             STR_PAD_LEFT
         );

       }
       else{
        $latestId = $last3->id;
        //dd($latestId);
        return $prefix. str_pad(
            ($latestId+1),
             $lenght,
             '0',
             STR_PAD_LEFT
         );

       }


    }
}
?>