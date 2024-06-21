<?php
namespace App\Services;

class DiwaliService {
    protected $errorArray=[];
    protected $returnData=[];
    
    public function getDiwaliOffer($userData)
    {
        $inputArr=$userData['input'];
        $rule=$userData['rule'];
        sort($inputArr);
        if($rule==1) {
            $returnData=$this->getBuyOneGetEqualOne($inputArr);
        } elseif($rule==2) {
            $returnData=$this->getBuyOneGetLessOne($inputArr);
        } elseif($rule==3) {
            $returnData=$this->getBuyTwoGetLessTwo($inputArr);
        }
        return $returnData;
        
    }

    private function getBuyOneGetEqualOne($arr)
    {
        $arrLenth=count($arr);
        $i=1;
        while($arrLenth>0) {
            $purchasedItem[]=$arr[$arrLenth-1];
            $arrLenth--;
            if($arrLenth>0) {
                $discountedItems[]=$arr[$arrLenth-1];
            }
            $arrLenth--;     
        }
        return ["Discounted Items:"=>$discountedItems,"Payable Items:"=>$purchasedItem];
       
    }


    private function getBuyOneGetLessOne($arr)
    {
        $arrLenth=count($arr);
        $i=1;
        while($arrLenth>0) { 
            $prevItem=$arr[$arrLenth-$i];
            $purchasedItem[]=$prevItem;
            array_splice($arr,$arrLenth-$i,1);
            $arrLenth--;
            $j=0;
            if($arrLenth>0) {
            while($prevItem==$arr[$arrLenth-($i+$j)] && ($arrLenth-($i+$j))>0){
                $j++;
            }
            if($prevItem>$arr[$arrLenth-($i+$j)]) {
                $discountedItems[]=$arr[$arrLenth-($i+$j)];
                array_splice($arr,$arrLenth-($i+$j),1);
                $arrLenth--;
            }
            
            }
        }
        return ["Discounted Items:"=>$discountedItems,"Payable Items:"=>$purchasedItem];
    }

    private function getBuyTwoGetLessTwo($arr)
    {
        $arrLenth=count($arr);
        $i=1;
        $ispused=0;
        while($arrLenth>0){ 
            $prevItem=$arr[$arrLenth-$i];
            $purchasedItem[]=$prevItem;
            array_splice($arr,$arrLenth-$i,1);
            $arrLenth--;
            $j=0;
            if($arrLenth>0){
            while($prevItem==$arr[$arrLenth-($i+$j)] && ($arrLenth-($i+$j))>0){
                $j++;
            }
            if($prevItem>$arr[$arrLenth-($i+$j)]){
                if($arrLenth<=1){
                    if(count($purchasedItem)%2==0){
                        $discountedItems[]=$arr[$arrLenth-($i+$j)];
                        array_splice($arr,$arrLenth-($i+$j),1);
                        $arrLenth--;
                    }else{
                        $prevItem=$arr[$arrLenth-$i];
                        $purchasedItem[]=$arr[$arrLenth-($i+$j)];
                        array_splice($arr,$arrLenth-($i+$j),1);
                        $arrLenth--;
                    } 
                }else{
                    $discountedItems[]=$arr[$arrLenth-($i+$j)];
                    array_splice($arr,$arrLenth-($i+$j),1);
                    $arrLenth--;
                }
            }
        }
    }
        return ["Discounted Items:"=>$discountedItems,"Payable Items:"=>$purchasedItem];
    }
}