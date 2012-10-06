<?php;
error_reporting(E_ALL);
// http://mochakimono.chipx86.com/agen2.html;
class Magic
{

    protected $aCheckArray;
    protected $aCheckText;
    protected $aItemWords;
    protected $aItemCodes;

    public function __construct()
    {

        $aItemWords = array();
        $aItemCodes = array();
        $aCheckArray = array();
        $aCheckText = array();
        $aDescSeed = array();
        $aVocab = array();


        $iCounter=0;

        //Example data.
        //Data has binary flags (1,2,4,8,16, etc.)
        // In this example we have
        // 1 - You, blah blah blah;
        // 2 - Colors;
        // 4 - Plural body parts;
        // 8 - Weather;
        // 16 - .
        // 32 - Single body parts;
        // 64 - Single body effects;
        // 128 - AND you blah blah blah;
        // 256 - Plural body effects;

        $aItemWords[$iCounter]="You turn into a housecat";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a dog";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a snake";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a small bird";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a falcon";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a horse";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a centaur";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a unicorn";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a tiger";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a wolf";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a mouse";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a lizard";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a fish";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a griffin";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a mermaid";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a bear";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a catperson";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a dogperson";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a wolf anthro";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a lizardfolk";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into a bird anthro";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become a centaur";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become a mouse anthro";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become a fire elemental";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become a water/ice elemental";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become an electric elemental";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become an air elemental";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become an earth (not plant) elemental";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You lose all elemental powers (and weaknesses), if any";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You die instantly";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become undead";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You are stricken with amnesia";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become physically stronger";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become physically weaker";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You turn into the opposite gender";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become more fleetfooted";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become slowerfooted";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You are filled with arcane energies";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You feel your energy drained away";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become more intelligent";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="Your intelligence drops";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You go numb all over";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You are wracked with pain from head to toe";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You burst into flames";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You are struck by lightning";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You feel frigid to the bone";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You're suddenly drenched with water";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You punch the first person you see";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become hungry";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You are compelled to obey the first order given to you";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You sense the thoughts and emotions of everyone nearby";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You forget every language you know";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You remember everything you have forgotten";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You have a flashback into the nearest person's past";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You glimpse into the future";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You relive your worst memory";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You experience your worst fear";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You are filled with overwhelming peace and joy";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You go blind";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You go deaf";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="Your vision improves";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="Your hearing improves";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You feel frightened";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="A pile of gold appears in front of you";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="Gems and jewelry materialize near you";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="All nearby wood sprouts tree branches";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="Cotton plants grow from all nearby cotton";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="The walls bleed around you";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="A ghostly figure walks slowly by";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="A king's feast appears in front of you";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="All items and clothing in the room disappear";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="Spiders and centipedes crawl all over your body";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You grow a pair of white feathery wings";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You grow a pair of tiny useless faerie wings";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You grow a draconic, arrow-headed tail";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You grow a fluffy tail the color of your hair";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You grow a pair of dragon black wings";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become inexplicably aroused";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You have an incredible orgasm";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="Everyone can read your mind";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="Your experience the worst memory of the nearest person";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You get a free wish";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You laugh maniacally";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become drunk";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You get the giggles";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become a plant elemental";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become a child";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="Everyone in the room becomes a child";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become a teenager";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="Everyone in the room becomes a teenager";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You become a ghost";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="You kiss the person closest to you on the lips";
        $aItemCodes[$iCounter++]=1;

        $aItemWords[$iCounter]="brick red";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="bright orange";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="straw yellow";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="forest green";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="dark crimson";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="pale blue";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="navy blue";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="golden";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="silver";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="white";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="black";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="gray";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="dark purple";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="pink";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="brown";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="pale green";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="beige";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="invisible";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="lemon yellow";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="blue";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="red";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="lavender";
        $aItemCodes[$iCounter++]=2;

        $aItemWords[$iCounter]="Your eyes";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="Your wings, if any, both";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="Your breasts, if any,";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="All of your limbs";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="ALL OF YOUR EYES";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="Your teeth";
        $aItemCodes[$iCounter++]=4;

        $aItemWords[$iCounter]="It begins to rain";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="A strong wind picks up";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="Snow begins to fall";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="The sky is clear and cloudless";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="The sky is gray and overcast";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="There is a light drizzle of rain";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="There is a faint breeze";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="A torrid blizzard suddenly strikes";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="A thunderstorm begins out of nowhere";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="A torrential rain falls";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="A veritable monsoon-like downpour begins";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="The sun shifts to noon-high and glares brightly";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="There is a sudden eclipse";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="The moon is full in the sky";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="An apocalyptic flaming hailstorn rends the land";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="The temperature drops by 40 degrees F";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="The temperature spikes by 40 degrees F";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="It is hot and dry outside";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="It is warm and misty outside";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="It is chilly and frosty outside";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="A thick fog rolls in";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="There is an earthquake";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="Plants wither around you";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="Plants grow rapidly near you";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="It begins hailing";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="A tornado strikes";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="Local gravity reverses";
        $aItemCodes[$iCounter++]=8;

        $aItemWords[$iCounter]=".";
        $aItemCodes[$iCounter++]=16;
        $aItemWords[$iCounter]=" twice.";
        $aItemCodes[$iCounter++]=16;
        $aItemWords[$iCounter]=" for the rest of the day.";
        $aItemCodes[$iCounter++]=16;
        $aItemWords[$iCounter]=", but only for a few minutes.";
        $aItemCodes[$iCounter++]=16;
        $aItemWords[$iCounter]=" permanently.";
        $aItemCodes[$iCounter++]=16;
        $aItemWords[$iCounter]=" for an hour.";
        $aItemCodes[$iCounter++]=16;
        $aItemWords[$iCounter]=" for a week.";
        $aItemCodes[$iCounter++]=16;
        $aItemWords[$iCounter]=" repeatedly.";
        $aItemCodes[$iCounter++]=16;

        $aItemWords[$iCounter]="Your left arm";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your right arm";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your left hand";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your left foot";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your right hand";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your right foot";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your left leg";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your right leg";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your tail, if any,";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your nose";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your hair";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your tongue";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your mouth";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your left ear";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your right ear";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your penis, if any,";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your ass";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your entire body";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your head";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Your navel";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Everybody in the room but you";
        $aItemCodes[$iCounter++]=32;

        $aItemWords[$iCounter]="enlarges";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="shrinks";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="begins glowing";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="bursts into flames";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="feels icy cold";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="throbs in pain";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="becomes stronger";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="becomes weaker";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="falls off";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="grows an identical one right next to it";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="begins attacking you";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="explodes";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="screams";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="has an orgasm";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="bleeds";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="is cured of any maladies";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="grows flowers on it";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="grows fur";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="shrivels";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="gains the powers of Mr. Fantastic";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="becomes fireproof";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="becomes electric-proof";
        $aItemCodes[$iCounter++]=64;

        $aItemWords[$iCounter]="you turn into a housecat";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a dog";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a snake";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a small bird";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a falcon";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a horse";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a unicorn";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a tiger";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a wolf";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a mouse";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a lizard";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a fish";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a griffin";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a mermaid";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a bear";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you are stricken with amnesia";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become physically stronger";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become physically weaker";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into the opposite gender";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become more fleetfooted";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become slowfooted";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you are filled with arcane energies";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you feel your energy drained away";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become more intelligent";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="your intelligence drops";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you go numb all over";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you are wracked with pain from head to toe";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you burst into flames";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you are struck by lightning";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you feel frigid to the bone";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you're suddenly drenched with water";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you punch the first person you see";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become hungry";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you are compelled to obey the first order given to you";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you sense the thoughts and emotions of everyone nearby";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you forget every language you know";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you remember everything you have forgotten";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you have a flashback into the nearest person's past";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you glimpse into the future";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you relive your worst memory";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you experience your worst fear";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you are filled with overwhelming peace and joy";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you go blind";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you go deaf";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="your vision improves";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="your hearing improves";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you feel frightened";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="a pile of gold appears in front of you";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="gems and jewelry materialize near you";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="all nearby wood sprouts tree branches";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="cotton plants grow from all nearby cotton";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="the walls bleed around you";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="a ghostly figure walks slowly by";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="a king's feast appears in front of you";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="all items and clothing in the room disappear";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a catperson";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a dogperson";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a wolf anthro";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a lizardfolk";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you turn into a bird anthro";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become a centaur";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become a mouse anthro";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become a fire elemental";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become a water/ice elemental";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become an electric elemental";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become an air elemental";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become an earth (not plant) elemental";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you lose all elemental powers (and weaknesses), if any";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you die instantly";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become undead";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="spiders and centipedes crawl all over your body";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you grow a pair of white feathery wings";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you grow a pair of tiny useless faerie wings";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you grow a draconic, arrow-headed tail";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you grow a fluffy tail the color of your hair";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you grow a pair of black dragon wings";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become inexplicably aroused";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you have an incredible orgasm";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="everyone can read your mind";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you experience the worst memory of the nearest person";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you get a free wish";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you laugh maniacally";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become drunk";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you get the giggles";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become a plant elemental";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become a child";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="everyone in the room becomes a child";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become a teenager";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="everyone in the room becomes a teenager";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you become a ghost";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="you kiss the person closest to you on the lips";
        $aItemCodes[$iCounter++]=128;

        $aItemWords[$iCounter]="enlarge";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="shrink";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="begin glowing";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="burst into flames";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="feel icy cold";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="throb in pain";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="become stronger";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="become weak";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="fall out";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="grow another pair right next to them";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="begin attacking you";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="explode";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="scream";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="bleed";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="are healed of all wounds";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="grow flowers all over them";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="grow fur";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="bleed";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="become feline";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="become canine";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="wrinkle";
        $aItemCodes[$iCounter++]=256;

        $iCounter=0;


        //These are ways data can be formated.
        //The first array is what value the tagged items must contain;
        //The second array contains the text that follows (first), is after each word (the latter) and finishes the construct (final one)
        $aCheckArray[$iCounter] = array(1,16);
        $aCheckText[$iCounter++] = array(" ","","");
        $aCheckArray[$iCounter] = array(1,128,16);
        $aCheckText[$iCounter++] = array(" "," and then ","","");
        $aCheckArray[$iCounter] = array(8,16);
        $aCheckText[$iCounter++] = array(" ","","");
        $aCheckArray[$iCounter] = array(8,128,16);
        $aCheckText[$iCounter++] = array(" "," and then ","","");
        $aCheckArray[$iCounter] = array(32,64,128,16);
        $aCheckText[$iCounter++] = array(" "," "," and then ","","");
        $aCheckArray[$iCounter] = array(4,2,128,16);
        $aCheckText[$iCounter++] = array(" "," turn "," and then ","","");
        $aCheckArray[$iCounter] = array(4,256,16);
        $aCheckText[$iCounter++] = array(" "," ","","");
        $aCheckArray[$iCounter] = array(32,2,64,128);
        $aCheckText[$iCounter++] = array(" "," turns "," and ",", then ",".");
        $aCheckArray[$iCounter] = array(32,64,16);
        $aCheckText[$iCounter++] = array(" "," ","","");
        $aCheckArray[$iCounter] = array(32,64,16,32,64,16);
        $aCheckText[$iCounter++] = array(" "," ",""," "," ","","");
        $aCheckArray[$iCounter] = array(8,16,1,16);
        $aCheckText[$iCounter++] = array(" ",""," ","","");
        $aCheckArray[$iCounter] = array(1,128,128);
        $aCheckText[$iCounter++] = array(" ",", then ",", and finally ",".");
        $aCheckArray[$iCounter] = array(8,16,8,16);
        $aCheckText[$iCounter++] = array(" ",""," ","","");
        $aCheckArray[$iCounter] = array(8,128);
        $aCheckText[$iCounter++] = array(" "," and then ",".");
        $aCheckArray[$iCounter] = array(1,8);
        $aCheckText[$iCounter++] = array(" ",". ",".");

        $this->aCheckText=$aCheckText;
        $this->aCheckArray=$aCheckArray;
        $this->aItemWords=$aItemWords;
        $this->aItemCodes=$aItemCodes;

    }

    //Regular functions;

    protected function getNumber($aCurrArray, $intCheckNumber)
    {
        $intReturn; $intLooper;
        $bEnd=false;

        while ($bEnd==false)
        {
            $intReturn=rand(0,count($this->aItemCodes)-1);

            if (($this->aItemCodes[$intReturn]  &  $intCheckNumber)==$intCheckNumber)
            {
                $bEnd=true;
            }

            for ($intLooper=0;$intLooper<count($aCurrArray);$intLooper++)
            {
                if ($aCurrArray[$intLooper]==$intReturn)
                {
                    $bEnd=false;
                }
            }
        }

        return $intReturn;
    }



    public function generate()
    {
        $aUseNumber=array();
        $intArrayUse;
        $strReturn="";
        $strPass;
        $intNumber=-1;
        $intLooper;
        $bEnd = false;

        $intArrayUse=rand(0, count($this->aCheckArray)-1);

        for ($intLooper=0;$intLooper<count($this->aCheckArray[$intArrayUse]);$intLooper++)
        {
            $aUseNumber[$intLooper]=-1;
        }

        for ($intLooper=0;$intLooper<count($this->aCheckArray[$intArrayUse]);$intLooper++)
        {
                        $intNumber=$this->getNumber($aUseNumber,$this->aCheckArray[$intArrayUse][$intLooper]);
                        $aUseNumber[$intLooper]=$intNumber;
        }

        $strReturn = $this->aCheckText[$intArrayUse][0];

        for ($intLooper=0;$intLooper<count($aUseNumber);$intLooper++)
        {
            if ($aUseNumber[$intLooper]>-1)
            {
                $strReturn.= $this->aItemWords[$aUseNumber[$intLooper]];
                $strReturn.= $this->aCheckText[$intArrayUse][$intLooper+1];
            }
        }

        return $strReturn;
    }
}
