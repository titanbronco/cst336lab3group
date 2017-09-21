<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <?php 
        // Generate a deck of cards 
        // [0, 1, 2, ..., 51]
        // map each number to a card 
        // generate a "hand" of cards
        
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
        
        
        function generateDeck() {
            $cards = array();
            for ($i = 0; $i < 52; $i++) {
                array_push($cards, $i);
            }
            shuffle($cards);
            
            return $cards;
        }
        
        
        function printDeck($deck) {
            for ($i = 0; $i < count($deck); $i++) {
                $cardNum = $deck[$i]; // number between 0 and 51
                $card = mapNumberToCard($cardNum);
                echo "imgURL: ".$card["imgURL"]."<br>";
            }
        }
        
        // Return a specific number of cards
        function generateHand($deck) {
            $hand = array();
            
            for ($i = 0; $i < 3; $i++) {
                $cardNum = array_pop($deck);
                $card = mapNumberToCard($cardNum);
                array_push($hand, $card);
            }
            
            return $hand;
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
        
        $b_deck = generateDeck();
        $k_deck = generateDeck();
        $s_deck = generateDeck();
        $a_deck = generateDeck();
        
        //players and their information
        $byun = array(
            "name" => "Byun",
            "imgUrl" => "./img/byun.jpg",
            "cards" => generateHand($b_deck)
            );
        $krzy = array(
            "name" => "Krzy",
            "imgUrl" => "./img/krzy.jpg",
            "cards" => generateHand($k_deck)
            );
        $sathya = array(
            "name" => "Sathya",
            "imgUrl" => "./img/sathya.jpg",
            "cards" => generateHand($s_deck)
            );
        $avner = array(
            "name" => "Avner",
            "imgUrl" => "./img/avner.jpg",
            "cards" => generateHand($a_deck)
            );
        
        displayPerson($byun);
        displayPerson($krzy);
        displayPerson($sathya);
        displayPerson($avner);
        ?>
    </body>
</html>