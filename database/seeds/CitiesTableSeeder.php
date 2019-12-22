<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	$cities = array(
	  array('name' => 'Comilla'),
	  array('name' => 'Feni'),
	  array('name' => 'Brahmanbaria'),
	  array('name' => 'Rangamati'),
	  array('name' => 'Noakhali'),
	  array('name' => 'Chandpur'),
	  array('name' => 'Lakshmipur'),
	  array('name' => 'Chattogram'),
	  array('name' => 'Coxsbazar'),
	  array('name' => 'Khagrachhari'),
	  array('name' => 'Bandarban'),
	  array('name' => 'Sirajganj'),
	  array('name' => 'Pabna'),
	  array('name' => 'Bogura'),
	  array('name' => 'Rajshahi'),
	  array('name' => 'Natore'),
	  array('name' => 'Joypurhat'),
	  array('name' => 'Chapainawabganj'),
	  array('name' => 'Naogaon'),
	  array('name' => 'Jashore'),
	  array('name' => 'Satkhira'),
	  array('name' => 'Meherpur'),
	  array('name' => 'Narail'),
	  array('name' => 'Chuadanga'),
	  array('name' => 'Kushtia'),
	  array('name' => 'Magura'),
	  array('name' => 'Khulna'),
	  array('name' => 'Bagerhat'),
	  array('name' => 'Jhenaidah'),
	  array('name' => 'Jhalakathi'),
	  array('name' => 'Patuakhali'),
	  array('name' => 'Pirojpur'),
	  array('name' => 'Barisal'),
	  array('name' => 'Bhola'),
	  array('name' => 'Barguna'),
	  array('name' => 'Sylhet'),
	  array('name' => 'Moulvibazar'),
	  array('name' => 'Habiganj'),
	  array('name' => 'Sunamganj'),
	  array('name' => 'Narsingdi'),
	  array('name' => 'Gazipur'),
	  array('name' => 'Shariatpur'),
	  array('name' => 'Narayanganj'),
	  array('name' => 'Tangail'),
	  array('name' => 'Kishoreganj'),
	  array('name' => 'Manikganj'),
	  array('name' => 'Dhaka'),
	  array('name' => 'Munshiganj'),
	  array('name' => 'Rajbari'),
	  array('name' => 'Madaripur'),
	  array('name' => 'Gopalganj'),
	  array('name' => 'Faridpur'),
	  array('name' => 'Panchagarh'),
	  array('name' => 'Dinajpur'),
	  array('name' => 'Lalmonirhat'),
	  array('name' => 'Nilphamari'),
	  array('name' => 'Gaibandha'),
	  array('name' => 'Thakurgaon'),
	  array('name' => 'Rangpur'),
	  array('name' => 'Kurigram'),
	  array('name' => 'Sherpur'),
	  array('name' => 'Mymensingh'),
	  array('name' => 'Jamalpur'),
	  array('name' => 'Netrokona')
	);
         
        DB::table('cities')->insert($cities);
    }
}
