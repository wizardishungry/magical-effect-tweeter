<?php
require_once('base.php');
class Outfit extends Base
{
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
        // 1 - Color
        // 2 - Joke
        // 4 - Neckline
        // 8 - Sleeves
        // 16 - Length
        // 32 - Fabric
        // 64 - Tightness
        // 128 - Pattern
        // 256 - .
        // 512 - embroidery
        // 1024 - monsters

        // {{{
        $aItemWords[$iCounter]="light red";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="scarlet";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="maroon";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="peach";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="pumpkin orange";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="dark cinnamon";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="vanilla";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="yellow";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="amber";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="lime green";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="forest green";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="dark green";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="sky blue";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="azure";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="navy blue";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="lavender";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="amethyst";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="dark purple";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="white";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="black";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="silver";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="gold";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="brown";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="beige";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="khaki";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="dark gray";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="pale gray";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="ruby";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="tangerine";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="cream";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="olive";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="steel blue";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="violet";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="dark brown";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="translucent";
        $aItemCodes[$iCounter++]=1;
        $aItemWords[$iCounter]="transparent";
        $aItemCodes[$iCounter++]=1;
;
        $aItemWords[$iCounter]="You're naked";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="You're in a thong and pasties";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="You're in a fursuit";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="You're wearing your underwear on your head";
        $aItemCodes[$iCounter++]=2;
        $aItemWords[$iCounter]="You're wearing a figleaf!";
        $aItemCodes[$iCounter++]=2;
;
        $aItemWords[$iCounter]="a polo collar";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="a v-neck";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="a low, wide neck";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="a halter neckline";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="a one-shoulder neckline";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="a keyhole neckline";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="a sweetheart neckline";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="a off-the-shoulder neckline";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="a one-shoulder neckline";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="a surplice neckline";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="a heart-shaped neckline";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="a round neck";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="a sailor collar";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="a halter neck";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="a Mandarin collar";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="an asymmetrical neckline";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="a turtleneck";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="a square neckline";
        $aItemCodes[$iCounter++]=4;
        $aItemWords[$iCounter]="a crossed neckline";
        $aItemCodes[$iCounter++]=4;
;
        $aItemWords[$iCounter]="no sleeves";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="spaghetti straps";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="long sleeves";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="short sleeves";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="elbow-length sleeves";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="short, poofy sleeves";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="long, flowing sleeves";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="off-the-shoulder straps";
        $aItemCodes[$iCounter++]=8;
        $aItemWords[$iCounter]="cut-off sleeves";
        $aItemCodes[$iCounter++]=8;
;
        $aItemWords[$iCounter]="barely butt-length";
        $aItemCodes[$iCounter++]=16;
        $aItemWords[$iCounter]="mid-thigh length";
        $aItemCodes[$iCounter++]=16;
        $aItemWords[$iCounter]="thigh-length";
        $aItemCodes[$iCounter++]=16;
        $aItemWords[$iCounter]="knee-length";
        $aItemCodes[$iCounter++]=16;
        $aItemWords[$iCounter]="calf-length";
        $aItemCodes[$iCounter++]=16;
        $aItemWords[$iCounter]="capri-length";
        $aItemCodes[$iCounter++]=16;
        $aItemWords[$iCounter]="full-length";
        $aItemCodes[$iCounter++]=16;
        $aItemWords[$iCounter]="floor-length";
        $aItemCodes[$iCounter++]=16;
        $aItemWords[$iCounter]="long and slitted";
        $aItemCodes[$iCounter++]=16;
;
        $aItemWords[$iCounter]="cotton";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="silk";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="satin";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="polyester";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="velour";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="nylon";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="denim";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="velvet";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="polysilk";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="rayon";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="leather";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="crushed velvet";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="tweed";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="spandex";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="wool";
        $aItemCodes[$iCounter++]=32;
        # more
        $aItemWords[$iCounter]="angora";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="acrylic";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="cashmere";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="cheesecloth";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="linen";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="hemp";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="gauze";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="haircloth";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="felt";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="corduroy";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="spider silk";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="felt";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="Gore-Tex";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="rayon";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="microfiber";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="mohair";
        $aItemCodes[$iCounter++]=32;
        $aItemWords[$iCounter]="kevlar";
        $aItemCodes[$iCounter++]=32;

;
        $aItemWords[$iCounter]="tight";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="uncomfortably tight";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="loose";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="baggy";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="skin-tight";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="well-fitted";
        $aItemCodes[$iCounter++]=64;
        $aItemWords[$iCounter]="form-fitting";
        $aItemCodes[$iCounter++]=64;
;
        $aItemWords[$iCounter]="houndstooth";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="pinstripes";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="broad, diagonal stripes";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="horizontal stripes";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="floral patterns";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="Chinese characters";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="art nouveau swirlies";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="trim";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="embroidery";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="sequins";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="polka-dots";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="lace trim";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="ribbons";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="plaid";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="patchwork";
        $aItemCodes[$iCounter++]=128;
        $aItemWords[$iCounter]="moire";
        $aItemCodes[$iCounter++]=128;
;
        $aItemWords[$iCounter]=".";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="!";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]=". Huh.";
        $aItemCodes[$iCounter++]=256;
        $aItemWords[$iCounter]="…";
        $aItemCodes[$iCounter++]=256;

        $aItemWords[$iCounter]= "embroidered";
        $aItemCodes[$iCounter++]=512;
        $aItemWords[$iCounter]= "silk-screened";
        $aItemCodes[$iCounter++]=512;
        $aItemWords[$iCounter]= "screen-printed";
        $aItemCodes[$iCounter++]=512;
        $aItemWords[$iCounter]= "embossed";
        $aItemCodes[$iCounter++]=512;
        $aItemWords[$iCounter]= "decorated";
        $aItemCodes[$iCounter++]=512;

        $iCounter=0;

        //These are ways data can be formated.;
        //The first array is what value the tagged items must contain;
        //The second array contains the text that follows (first), is after each word (the latter) and finishes the construct (final one);
        $aCheckArray[$iCounter] = array(64,1,4,16,32);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," dress, with ",". It is ",", and made of ",".");
        $aCheckArray[$iCounter] = array(64,1,4,512,1024,32);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," dress, with ",". It is "," with a ",", and made of ",".");
        $aCheckArray[$iCounter] = array(64,1,4,16,512,1024,32);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," dress, with ",". It is ",", "," with a ",", and made of ",".");

        $aCheckArray[$iCounter] = array(64,1,8,1,64);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," shirt, with ",", and ",", "," pants.");
        $aCheckArray[$iCounter] = array(16,1,4);
        $aCheckText[$iCounter++] = array("You are wearing a "," "," dress with ",".");
        $aCheckArray[$iCounter] = array(32,1,4);
        $aCheckText[$iCounter++] = array("You are wearing a "," "," dress with ",".");
        $aCheckArray[$iCounter] = array(64,1,8,16,32);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," dress, with ",". It is ",", and made of ",".");
        $aCheckArray[$iCounter] = array(64,1,8,16,512,1024,32);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," dress, with ",". It is ",", "," with a ",", and made of ",".");
        $aCheckArray[$iCounter] = array(64,1,4,1,64);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," shirt, with ",", and ",", "," pants.");
        $aCheckArray[$iCounter] = array(16,1,8);
        $aCheckText[$iCounter++] = array("You are wearing a "," "," dress with ",".");
        $aCheckArray[$iCounter] = array(16,1);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," dress.");
        $aCheckArray[$iCounter] = array(16,1,1,128);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," dress with "," ",".");
        $aCheckArray[$iCounter] = array(32,1,1,128);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," dress with "," ",".");
        $aCheckArray[$iCounter] = array(64,16,4,1,1,128);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," dress with ",". It is "," with "," ",".");
        $aCheckArray[$iCounter] = array(64,16,8,1,1,128);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," dress with ",". It is "," with "," ",".");
        $aCheckArray[$iCounter] = array(64,1,8,16,1);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," shirt, with ",", and a ",", "," skirt.");
        $aCheckArray[$iCounter] = array(64,1,8,16,1,1,128);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," shirt, with ",", and a ",", "," skirt with "," ",".");
        $aCheckArray[$iCounter] = array(32,1,64,1);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," shirt with ",", "," pants.");
        $aCheckArray[$iCounter] = array(32,16,1);
        $aCheckText[$iCounter++] = array("You are wearing a ",", ",", "," dress.");
        $aCheckArray[$iCounter] = array(16,32,64,1);
        $aCheckText[$iCounter++] = array("You are wearing a ",", ",", ",", "," dress.");
        $aCheckArray[$iCounter] = array(2,256);
        $aCheckText[$iCounter++] = array("","","");
        $aCheckArray[$iCounter] = array(2,256);
        $aCheckText[$iCounter++] = array("","","");
        $aCheckArray[$iCounter] = array(2,256);
        $aCheckText[$iCounter++] = array("","","");
        $aCheckArray[$iCounter] = array(64,32,1,1,128,64,32,16,1,1,128);
        $aCheckText[$iCounter++] = array("You are wearing a ",", ",", "," shirt with "," ",", and ",", ",", ",", "," pants with "," ",".");
        $aCheckArray[$iCounter] = array(64,1,4,32);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," dress, with ",". It is made of ",".");
        $aCheckArray[$iCounter] = array(64,1,8,32);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," dress, with ",". It is made of ",".");
        $aCheckArray[$iCounter] = array(64,1,4,16);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," dress, with ",". It is ",".");
        $aCheckArray[$iCounter] = array(64,1,8,16);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," dress, with ",". It is ",".");
        $aCheckArray[$iCounter] = array(32,1);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," shirt with matching pants.");
        $aCheckArray[$iCounter] = array(32,1);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," shirt with a matching skirt.");
        $aCheckArray[$iCounter] = array(32,1,512,1024);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," shirt with matching pants. It is "," with a ",".");
        $aCheckArray[$iCounter] = array(32,1,512,1024);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," shirt with a matching skirt. It is "," with a ",".");
        $aCheckArray[$iCounter] = array(1,1,128);
        $aCheckText[$iCounter++] = array("You are wearing a "," dress with "," ",".");
        $aCheckArray[$iCounter] = array(32,1);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," dress.");
        $aCheckArray[$iCounter] = array(1,1,128,512,1024);
        $aCheckText[$iCounter++] = array("You are wearing a "," dress with "," ",". It is "," with a ",".");
        $aCheckArray[$iCounter] = array(32,1,512,1024);
        $aCheckText[$iCounter++] = array("You are wearing a ",", "," dress. It is "," with a ",".");
        $aCheckArray[$iCounter] = array(1,1,1);
        $aCheckText[$iCounter++] = array("You are wearing a "," suit, a "," shirt, and a "," tie.");
        // }}}

        $this->aCheckText=$aCheckText;
        $this->aCheckArray=$aCheckArray;
        $this->aItemWords=$aItemWords;
        $this->aItemCodes=$aItemCodes;

        $colors = $this->moreColors(1);
        $this->moreMonsters(1024, $colors);
    }

}
