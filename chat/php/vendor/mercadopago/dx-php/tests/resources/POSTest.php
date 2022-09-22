<?php 

use PHPUnit\Framework\TestCase;

/**
 * EntityTest Class Doc Comment
 *
 * @package MercadoPago
 */
class InstoreTest extends TestCase
{

    public static function setUpBeforeClass()
    {
        MercadoPago\SDK::cleanCredentials();
        
        if (file_exists(__DIR__ . '/../../.env')) {
            $dotenv = new Dotenv\Dotenv(__DIR__, '../../.env');
            $dotenv->load();
        }

        MercadoPago\SDK::setAccessToken(getenv('ACCESS_TOKEN'));
    }

    public function testCreatePos() {
        $pos = new MercadoPago\Entities\POS();
        $pos->name = "mypointofsale";
        $pos->fixed_amount =true; 
        $pos->external_id = "mypos" . rand(1, 10000);

        $pos->save();
        $this->assertEquals($pos->status, 'active');
        return $pos;
    }

    /**
     * @depends testCreatePos
     */
    public function testUpdatePos(MercadoPago\Entities\POS $created_pos) {
        $created_pos->name = "mypointofsalenewname";
        $created_pos->update();

        $pos = MercadoPago\Entities\POS::find_by_id($created_pos->id);

        $this->assertEquals($pos->name, 'mypointofsalenewname');
        
    }

    /**
     * @depends testCreatePos 
     */
    public function testSearchPos(MercadoPago\Entities\POS $pos) {
        $filters = array(
            "external_id" => $pos->external_id
        );
        $poss = MercadoPago\Entities\POS::search($filters);
        $poss = $poss->getArrayCopy();
        $poss = end($poss);

        $this->assertEquals($poss->external_id, $pos->external_id);
    }

    

    // public function testDeletePos(MercadoPago\Entities\POS $pos) {
    //     $pos = new MercadoPago\Entities\POS();

    // }

}

?>