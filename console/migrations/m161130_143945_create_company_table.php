<?php

use yii\db\Migration;

/**
 * Handles the creation of table `company`.
 */
class m161130_143945_create_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'country' => $this->string()->notNull(),
            'info' => $this->string()->notNull(),
            'type' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'is_active' => $this->integer(1)->notNull(),
            'is_active_server' => $this->integer(1)
        ]);
        $created_at = $updated_at = date("Ymd");

        $this->batchInsert('{{%company}}', ['name', 'country', 'info', 'type', 'created_at', 'updated_at', 'is_active', 'is_active_server'], [//buer  (type 0)
                ['ASSAI INVESTMENT HOLDINGS LIMITED', 'United States', '1902 Wright Place\r\nCornerstone Corporate Center\r\n2nd Floor\r\nCarlsbad, California 92008-6583\r\n', 0, $created_at, $updated_at,1,1],
                ['STELS TRADE & INVEST LIMITED', 'Switzerland', 'The World Trade Center\r\nLeutschenbachstrasse 95\r\n8050 Zurich\r\n', 0, $created_at, $updated_at,1,1],
                ['BUILDING INVESTMENT LIMITED', 'United States', '400 East Pratt Street\r\n8th Floor\r\nBaltimore, Maryland 21202\r\n', 0, $created_at, $updated_at,1,1],
                ['SERVICES HOLDINGS LIMITED', 'Finland', 'Luna House\r\nMannerheimintie 12 B\r\nFIN-00100 Helsinki\r\n', 0, $created_at, $updated_at,1,1],
                ['FIRST NATIONAL CLUB SYSTEM ', 'Russian Federation', 'Novosibirsk, Dusi Kovalchuk st. 252', 0, $created_at, $updated_at,1,1],
                ['TORANT INVESTMENT HOLDINGS LIMITED', 'Spain', 'Puerta de las Naciones\r\nRibera del Loira 46\r\nCampo de las Naciones\r\nMadrid 28042\r\n', 0, $created_at, $updated_at,1,1],
                ['SANTA INVESTMENT LIMITED', 'Norway', 'Torgbygget\r\nNydalsveien 33\r\nPostboks 4814 Nydalen\r\n0484 Oslo\r\n', 0, $created_at, $updated_at,1,1],
                ['LEGAL INTERNATIONAL HOLDINGS ', 'United States', '871 Coronado Center Drive\r\nSuite 200\r\nHenderson, Nevada 89052\r\n', 0, $created_at, $updated_at,1,1],
                ['FINAN INVESTMENT LIMITED', 'United States', '9465 Counselors Row\r\nSuite 200\r\nIndianapolis, Indiana 46240\r\n', 0, $created_at, $updated_at,1,1],
                ['LABEL CONNECTION LIMITED', 'United States', '1831 E 71st Street\r\nTulsa, Oklahoma 74136\r\n', 0, $created_at, $updated_at,1,1],
                ['MILAT INVESTMENT HOLDINGS LIMITED', 'Belgium', '9, Boulevard de France, bât A\r\n1420 Braine-L\'Alleud\r\n', 0, $created_at, $updated_at,1,1],
                ['CERENT INVESTMENT HOLDINGS', 'Portugal', 'Quinta da Fonte\r\nRua dos Malhões\r\nEdifício D. Pedro I, Paço D\'Arcos\r\nLisbon 2770-071\r\n', 0, $created_at, $updated_at,1,1],
                ['PILAT INVESTMENT HOLDINGS', 'Philippines', '28th Floor, Tower 2\r\nThe Enterprise Centre\r\nCorner Paseo De Roxas and Ayala Avenue\r\nMakati City Metro Manila 1226\r\n', 0, $created_at, $updated_at,1,1],
                ['DALAT INVESTMENT LIMITED', 'United States', 'Columbia Tower\r\n701 Fifth Avenue\r\n42nd Floor\r\nSeattle, Washington 98104-5119\r\n', 0, $created_at, $updated_at,1,1],
                ['UNIFAL INVESTMENT HOLDINGS LIMITED', 'Netherlands', 'Laan van Kronenburg 2\r\n1183 AS Amstelveen\r\n', 0, $created_at, $updated_at,1,1],
                ['FLEAR INVESTMENT HOLDINGS', 'Vietnam', 'Level 6 & 7 Me Linh Point Tower\r\nNo 2, Ngo Duc Ke Street\r\nDistrict 1\r\nHo Chi Minh City \r\n', 0, $created_at, $updated_at,1,1],
                ['DFG HOLDINGS', 'Monaco', 'Monte Carlo Sun\r\n74 Boulevard d\'Italie\r\nBP 117\r\nMonaco 98000\r\n', 0, $created_at, $updated_at,1,1],
                ['TORON INVESTMENT LIMITED', 'United States', 'Columbia Tower\r\n701 Fifth Avenue\r\n42nd Floor\r\nSeattle, Washington 98104-5119\r\n', 0, $created_at, $updated_at,1,1],
                ['RAPUT INVESTMENT HOLDINGS LIMITED', 'Singapore', 'Centennial Tower\r\nLevels 21 & 34\r\n3 Temasek Avenue\r\nSingapore 039190\r\n', 0, $created_at, $updated_at,1,1],
                ['FABIEN INVESTMENT HOLDINGS', 'United States', '5601 Bridge St\r\nSuite 300\r\nFort Worth, Texas 76112\r\n', 0, $created_at, $updated_at,1,1],
            //end buer
            //saller  (type 1)
            ['JOISTEN INVESTMENT HOLDINGS', 'India', '2nd floor, ALTIUS\r\nOlympia Technology Park\r\n1 - SIDCO Industrial Estate, Guindy\r\nChennai 600 032\r\n', 1, $created_at, $updated_at,1,1],
                ['TOOF INVESTMENT HOLDINGS LIMITED', 'Hong Kong', 'G/F & 1/F Airport World Trade Centre\r\n1 Sky Plaza Road\r\nHong Kong International Airport\r\nHong Kong \r\n', 1, $created_at, $updated_at,1,1],
                ['FAWER TRADE & INVEST LIMITED KOVAP INVESTMENT HOLDINGS', 'United States', '5 Centerpointe Drive\r\nSuite 400\r\nLake Oswego, Oregon 97035\r\n', 1, $created_at, $updated_at,1,1],
                ['TRIND INVESTMENT HOLDINGS LIMITED', 'Israel', 'Ayalon House, 16th Floor\r\n12 Abba Hillel Street\r\nP.O.BOX 3306\r\nRamat-Gan 52136\r\n', 1, $created_at, $updated_at,1,1],
                ['BNS INVESTMENT HOLDINGS LIMITED', 'United States', '39555 Orchard Hill Place\r\nSuite 600\r\nNovi, Michigan 48375\r\n', 1, $created_at, $updated_at,1,1],
                ['ALFED INVESTMENT HOLDINGS LIMITED', 'United Arab Emirates', 'Al Odaid Office Tower, 10th floor\r\nAirport Road, Rashid Al Maktoum Street 2\r\nPO box 128 161\r\nAbu Dhabi \r\n', 1, $created_at, $updated_at,1,1],
                ['Akelea Investments Limited', 'Jordan', 'Al Husari Street\r\nShmeisani\r\nP.O.Box 940584\r\nAmman 11194\r\n', 1, $created_at, $updated_at,1,1],
                ['JUVE TRADE & INVEST LIMITED', 'United States', '80 S.W. 8th Street\r\nSuite 2000\r\nMiami, Florida 33130\r\n', 1, $created_at, $updated_at,1,1],
                ['VOLANTI INVESTMENT HOLDINGS LIMITED', 'Luxembourg', '15 Rue Edward Steichen\r\n2nd floor [southside)\r\n2540 Luxembourg\r\n', 1, $created_at, $updated_at,1,1],
                ['ALPA Consulting Limited', 'India', 'Level 2, Kalpataru Synergy Opposite Grand Hyatt, Opposite\r\nGrand Hyatt, Santacruz East, Mumbai - 400055', 1, $created_at, $updated_at,1,1],
                ['Tourist Center "Exotic"', 'Russia', 'Georgevsky lane 1, building 2, Moscow', 1, $created_at, $updated_at,1,1]

                // end saller
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%company}}');
    }
}
