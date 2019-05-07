<?php
include 'conf.php';

$url ='https://api.coincap.io/v2/assets';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPGET,1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


$list = curl_exec($ch);
$list = json_decode($list);

    foreach($list->data as $coin){
        $id =  $coin->id;
        $name = $coin->name;
        $symbol = $coin->symbol;
        $rank = $coin->rank;
        $supply = $coin->supply;
        $maxSupply = $coin->maxSupply;
        $marketCapUsd = $coin->marketCapUsd;
        $volume24 = $coin->volumeUsd24Hr;
        $priceUSD = $coin->priceUsd;
        $changepercent24 = $coin->changePercent24Hr;
        $vwap24 = $coin->vwap24Hr;
        
        
        $checkQuery = "select * from `listing` where `id`='$id'";

        $listed = $connection->query($checkQuery);

        if($listed == false){
            echo "Error".$connection->error;
        }
        else if($listed-> num_rows >0){
            $updateList = "UPDATE `listing` SET `id`='$id',`name`='$name',`symbol`='$symbol',
        `rank`='$rank',`supply`='$supply',`maxSupply`='$maxSupply',
        `marketCapUsd`='$marketCapUsd',`volume24`='$volume24',`price`='$priceUSD',
        `changepercent24`='$changepercent24',`vwap24`='$vwap24' WHERE `id`='$id'";

            if($connection->query($updateList) == false){
                echo "Error".$connection->error;
            }   
        }
        else{
            $insertCoin = "insert into listing(
                id, name, symbol, rank, supply, maxSupply, 
                marketCapUsd, volume24,price, changepercent24, 
                vwap24) values ('$id','$name','$symbol',
                '$rank','$supply','$maxSupply','$marketCapUsd',
                '$volume24','$priceUSD','$changepercent24','$vwap24')";

            if($connection->query($insertCoin) == false){
                echo "Error".$connection->error;
            }
        }
        
        
    }


// for($i=0; $i<sizeof($list->data);$i++){
//     $id =  $list->data[$i]->id;
//     $name = $list->data[$i]->name;
//     $symbol = $list->data[$i]->symbol;
//     $rank = $list->data[$i]->rank;

//     $query = "insert into listing(id, name, symbol, rank) values ('$id','$name','$symbol','$rank')";

//     if($connection->query($query) == false){
//         echo "Error".$connection->error;
//     }

// }