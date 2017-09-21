<!DOCTYPE html>
<html>
    <head>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php 
        // Generate a deck of cards 
        // [0, 1, 2, ..., 51]
        // map each number to a card 
        // generate a "hand" of cards
        
        function generateDeck() {
            $cards = array();
            for ($i = 0; $i < 52; $i++) {
                array_push($cards, $i);
            }
            shuffle($cards);
            
            return $cards;
        }
        
        // Return a specific number of cards
        // Passes the deck by reference so that the cards are actually popped off in the global
        function generateHand(&$deck) {
            $hand = array();
            $bust = false;
            
            $cardNum = array_pop($deck);
            $card = mapNumberToCard($cardNum);
            array_push($hand, $card);
            
            while (!$bust) {
                $sum = 0;
                foreach ($hand as $hands) {
                    $sum += valueOfCard($hands);
                }
                $cardNum = array_pop($deck);
                $card = mapNumberToCard($cardNum);
                $newcard = valueOfCard($cardNum);
                if ($sum + $newcard > 43) {
                    $bust = true;
                }
                else {
                    array_push($hand, $card);
                }
            }
            
            return $hand;
        }
        
        function mapNumberToCard($num) {
            $cardValue = ($num % 13) + 1;
            $cardSuit = floor($num / 13);
            $suitStr = "";
            
            switch($cardSuit) {
                case 0:
                    $suitStr = "clubs";
                    break;
                case 1:
                    $suitStr = "diamonds";
                    break;
                case 2:
                    $suitStr = "hearts";
                    break;
                case 3:
                    $suitStr = "spades";
                    break;
            }

            $card = array(
                'num' => $cardValue,
                'suit' => $cardSuit,
                'imgURL' => "./cards/".$suitStr."/".$cardValue.".png"
                );
            
            return $card;
        }
        
        function valueOfCard($num) {
            $cardValue = ($num % 13) + 1;
            
            return $cardValue;
        }
        
        function displayPerson($person) {
            // show profile pic
            echo "<img src='".$person["imgUrl"]."'>"; 
            
            // iterate through $person's "cards"
            for($i = 0; $i < count($person["cards"]); $i++) {
                $card = $person["cards"][$i];
                
                // translate this to HTML 
                echo "<img src='".$card["imgURL"]."'>";
            }
            
            echo calculateHandValue($person["cards"]);
        }
        
        function calculateHandValue($cards) {
            $sum = 0;
            
            foreach ($cards as $card) {
                $sum += $card["num"];
            }
            
            return $sum;
        }
        
        $deck = generateDeck();
        
        //players and their information
        $byun = array(
            "name" => "Byun",
            "imgUrl" => "./img/byun.jpg",
            "cards" => generateHand($deck)
            );
        $krzy = array(
            "name" => "Krzy",
            "imgUrl" => "./img/krzy.jpg",
            "cards" => generateHand($deck)
            );
        $sathya = array(
            "name" => "Sathya",
            "imgUrl" => "./img/sathya.jpg",
            "cards" => generateHand($deck)
            );
        $avner = array(
            "name" => "Avner",
            "imgUrl" => "./img/avner.jpg",
            "cards" => generateHand($deck)
            );
        
        displayPerson($byun);
        displayPerson($krzy);
        displayPerson($sathya);
        displayPerson($avner);
        ?>
    </body>
</html>